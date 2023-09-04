<?php

namespace App\Controllers;

use App\Models\Product_Model;
use App\Models\Categoria_Model;
use App\Models\Ventas_Model;
use App\Models\DetalleVenta_Model;
use App\Models\Usuarios_Model;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Option;
use Dompdf\Exception as DomException;
use Dompdf\Options;



class VentasController extends Controller{

    public function __construct(){
        helper(['form', 'url', 'session']);
    }

    public function registrar_venta(){
    
        $idSession = session();
        $cart = \Config\Services::cart();
        $productos = $cart->contents();
        $montoTotal = 0;

        $productModel = new Product_Model();
        $exceededStock = false;
        $nombreProducto = '';



        //Si no tiene completo los datos de facturacion al realizar la compra, solicitar primero datos de facturacion

        $userModel = new Usuarios_Model();
        $id_usuario_logueado = intval(session()->id);
        
        $datosUsuario = $userModel->find($id_usuario_logueado); // Obtengo los datos del cliente
        
        if (empty($datosUsuario['domicilio'])) {
            $mensaje = "Por favor complete los datos de facturación antes de realizar una compra";
            session()->setFlashdata('mensaje_data', $mensaje);
            // Redireccionar de vuelta al carrito o a la página correspondiente
            return redirect()->to('/miperfil');
        }
        
        

        foreach ($productos as $producto) {
            $productStock = $productModel->find($producto["id"]); // Obtener los detalles del producto
            $stock = $productStock["stock"]; // Obtener el stock del producto

            if ($stock < $producto["qty"]) {
                $exceededStock = true;
                $nombreProducto = $productStock["nombre_prod"]; // Suponiendo que el nombre del producto se encuentra en el campo "nombre".
                break; // Salir del bucle si se encuentra un producto con stock insuficiente
            }

            $montoTotal += $producto["price"] * $producto["qty"];
        }

        if ($exceededStock) {
            $mensaje = "La cantidad seleccionada para el producto '$nombreProducto' supera el stock disponible.";
            session()->setFlashdata('mensaje_stock', $mensaje);
            // Redireccionar de vuelta al carrito o a la página correspondiente
            return redirect()->to('ver_carrito');
        }

        $ventaCabecera = new Ventas_Model();
        $idSession = intval(session()->id);

        $fechaActual = date('Y-m-d'); // Obtener la fecha actual en el formato deseado

        $idCabecera = $ventaCabecera->insert([
            "total_venta" => $montoTotal,
            "id_cliente" => $idSession,
            "fecha_venta" => $fechaActual // Agregar la fecha actual al array de datos
        ]);

        $ventaDetalle = new DetalleVenta_Model();

        foreach ($productos as $producto) {
            // Actualizar el stock del producto
            $newStock = $productStock["stock"] - $producto["qty"];
            $productModel->update($producto["id"], ['stock' => $newStock]);

            // Insertar en la tabla de ventas detalle
            $ventaDetalle->insert([
                "id_venta" => $idCabecera,
                "id_producto" => $producto['id'],
                "cantidad" => $producto["qty"],
                "precio" => $producto["price"]
            ]);
        }

        $cart->destroy();
        session()->setFlashdata('succescompra', '¡Gracias por su compra!');
        // Redireccionar a la página de confirmación de compra
        return redirect()->route('ver_carrito');

    }

    
    public function factura($venta_id){

        $detalle_ventas = new DetalleVenta_Model();
        $data['ventaDetalle'] = $detalle_ventas->getDetalles($venta_id);

        $data['titulo'] = 'Factura';
            echo view('front/header', $data);
            echo view('front/navbar');
            echo view('backend/ventas/factura', $data);
            echo '<div style="display: flex; justify-content: center; margin: 20px">
            <a class="btn btn-primary" href="'. base_url("generarfactura/{$venta_id}") .'" style="margin: 0 auto; background-color: #c62828; border-color: #554b4b;">Generar Factura PDF</a>
          </div>';
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

        public function generarFactura($venta_id){
            
            //Obtengo el contenido HTML de la pagina
            $detalle_ventas = new DetalleVenta_Model();
            $data['ventaDetalle'] = $detalle_ventas->getDetalles($venta_id); 
            $filename = 'factura_CASAMARKITOS' . uniqid() . '.pdf';

            $contenidoHTML = view('backend/ventas/generarfactura', $data);

            //Creo el objeto dompdf
            $dompdf = new \Dompdf\Dompdf();

            $dompdf->setBasePath(base_url());

            // Configuración para permitir cargar imágenes externas
            /* $dompdf->getOptions()->set('isRemoteEnabled', true); */

            $dompdf->loadHtml($contenidoHTML);
            $dompdf->setPaper('A4', 'portrait');

            $dompdf->render();

            $dompdf->stream($filename, ['Attachment' => 1]);
        }


}