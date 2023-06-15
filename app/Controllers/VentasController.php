<?php

namespace App\Controllers;

use App\Models\Product_Model;
use App\Models\Categoria_Model;
use App\Models\Ventas_Model;
use App\Models\DetalleVenta_Model;
use CodeIgniter\Controller;



class VentasController extends Controller{

    private $cart;
    private $productos_modelo;
    private $venta_modelo;
    private $detalleventa_modelo;

    public function __construct(){
        helper(['form', 'url', 'session']);
        $this->cart = \Config\Services::cart();
        $this->productos_modelo = new Product_Model();
        $this->venta_modelo = new Ventas_Model();
        $this->detalleventa_modelo = new DetalleVenta_Model();

    }

    public function registrar_venta(){
        $cartItems = $this->cart->contents();
        $venta_id = null;
        $total_venta = 0;

        foreach ($cartItems as $item) {
            $producto = $this->productos_modelo->where('producto_id', $item['id'])->first();
            if ($producto['stock'] < $item['qty']) {
                return redirect()->route('carrito');
            }


            // Guardar venta y obtener el ID solo una vez
            if (!$venta_id) {
                $data = [
                    'id_cliente' => session('id'),
                'fecha_venta' => date('Y-m-d'),
                'total_venta' => 0
                ];
                $venta_id = $this->venta_modelo->insert($data);
            }

            $detalle_venta = [
                'id_venta'         => $venta_id,
                'id_producto'      => $item['id'],
                'cantidad' => $item['qty'],
                'precio'   => $item['price'],
            ];

            $nuevoStock = $producto['stock'] - $item['qty'];
            $this->productos_modelo->update($item['id'], ['stock' => $nuevoStock]);

            $this->detalleventa_modelo->insert($detalle_venta);

            $total_venta += $item['subtotal'];
        }
        $this->venta_modelo->update($venta_id, ['total_venta' => $total_venta]);

        $this->cart->destroy();
        //mensaje de exito
        session()->setFlashdata('success', 'Compra realizada con éxito!!');
        return redirect()->route('catalogo');

    }
        
    public function factura($venta_id){

        $detalle_ventas = new DetalleVenta_Model();
        $data['ventaDetalle'] = $detalle_ventas->getDetalles($venta_id);

        $data['titulo'] = 'Factura';
            echo view('front/header', $data);
            echo view('front/navbar');
            echo view('backend/ventas/factura', $data);
            echo view('front/footer');
        }
    
    
        public function ventas(){
            $session = session();
            $id=$session->get('id');
            $perfil=$session->get('perfil_id');

            $ventasModel = new Ventas_Model();


            if ($perfil == '1') { // Si es administrador
                $data['ventaDetalle'] = $ventasModel->getDetalles(); // Obtener todas las ventas
            } else if ($perfil == '2') { // Si es cliente
                //Obtener las compras del cliente
                $data['ventaDetalle'] = $ventasModel->where('id_cliente', $id)->orderBy('id', 'DESC')->findAll();
            }

                $data['titulo'] = 'Ventas';
                echo view('front/header', $data);
                echo view('front/navbar');
                echo view('backend/ventas/listar_ventas', $data);
                echo view('front/footer');
            } 



}