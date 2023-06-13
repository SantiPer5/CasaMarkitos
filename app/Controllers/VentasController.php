<?php

namespace App\Controllers;

use App\Models\Product_Model;
use App\Models\Categoria_Model;
use App\Models\Ventas_Model;
use App\Models\DetalleVenta_Model;
use CodeIgniter\Controller;



class VentasController extends Controller{

    public function __construct(){
        helper(['form', 'url', 'session']);


    }

    public function registrar_venta(){
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
        
    }







}