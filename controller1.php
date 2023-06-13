<?php

namespace App\Controllers;

use App\Models\productos_modelo;
use App\Models\Venta_modelo;
use App\Models\DetalleVenta_modelo;
use App\Models\Categorias_modelo;

class Ventas_controller extends Basecontroller
{

    private $cart;
    private $productos_modelo;
    private $venta_modelo;
    private $detalleventa_modelo;


    public function __construct()
    {
        $this->cart = \Config\Services::cart();
        $this->productos_modelo = new Productos_modelo();
        $this->venta_modelo = new Venta_modelo();
        $this->detalleventa_modelo = new DetalleVenta_modelo();
    }

    public function guardar_venta()
    {
        $cartItems = $this->cart->contents();
        $venta_id = null;
        $total_venta = 0; // Inicializar la variable para la suma del total de la venta

        foreach ($cartItems as $item) {
            $producto = $this->productos_modelo->where('id', $item['id'])->first();
            if ($producto['stock'] < $item['qty']) {
                return redirect()->route('carrito');
            }


            // Guardar venta y obtener el ID solo una vez
            if (!$venta_id) {
                $data = [
                    'id_cliente' => session('id'),
                    'venta_fecha' => date('Y-m-d H:i:s'),
                    'total_venta'   => 0
                ];
                $venta_id = $this->venta_modelo->insert($data);
            }

            $detalle_venta = [
                'id_venta'         => $venta_id,
                'id_producto'      => $item['id'],
                'detalle_cantidad' => $item['qty'],
                'detalle_precio'   => $item['price'],
            ];

            $nuevoStock = $producto['stock'] - $item['qty'];
            $this->productos_modelo->update($item['id'], ['stock' => $nuevoStock]);

            $this->detalleventa_modelo->insert($detalle_venta);

            // Calcular la suma del total de la venta
            $total_venta += ($item['price'] * $item['qty']);
        }

        // Actualizar el campo 'total_venta' en la tabla de ventas
        $this->venta_modelo->update($venta_id, ['total_venta' => $total_venta]);

        $this->cart->destroy();
        return redirect()->route('productos');
    }
}











----------------------------------------------------------------------



$session = session();
        $cart = \Config\Services::cart();
        $venta = new Ventas_Model();
        $detalle = new DetalleVenta_Model();
        $productoModel = new Product_Model();
        
        $cart1 = $cart->contents();
            foreach ($cart1 as $item) {
                $producto = $productoModel->where('producto_id', $item['id'])->first();
                    if($producto['stock'] < $item['qty']){
                        $session->setFlashdata('error', 'No hay suficiente stock para realizar la venta');
                        return redirect()->to(base_url().'ver_carrito');
                    }
                }
            
            
            $data = array(
                'id_cliente' => session('id'),
                'fecha_venta' => date('Y-m-d'),
                'total_venta' => $cart->total(),
            );
            /* Ver que se inserta en el array data */
            
            

            $id_venta = $venta->insert($data);
            //cargar detalle de venta

            foreach ($cart1 as $item) {
                $producto = $producto->where('producto_id', $item['id'])->first();
                $data = array(
                    'id_venta' => $id_venta,
                    'precio' => $item['price'],
                    'cantidad' => $item['qty'],
                    'id_producto' => $item['id'],
                );
                print_r($data);
                $detalle->insert($data);
                $stock = $producto['stock'] - $item['qty'];
                $producto->update($item['id'], ['stock' => $stock]);
                
            }

            $cart->destroy();
            $session->setFlashdata('success', 'Venta realizada correctamente');
            return redirect()->to(base_url().'catalogo');