<?php

namespace App\Controllers;

use App\Models\Product_Model;
use App\Models\Categoria_Model;

class CartController extends BaseController {


    public function __construct() // Constructor del controlador, se llama automaticamente cuando se crea una instancia del controlador
    {
        helper(['form', 'url', 'session']); // Se cargan los helpers form y url
    
        $session=session();
        $cart = \Config\Services::cart(); // Se carga la libreria cart
        $cart->contents();
    }

    public function catalogo()
{
    $categorias = new Categoria_Model();
    $productos = new Product_Model();

    $categorias = $categorias->findAll();
    $productos = $productos->findAll();
    

    $data['titulo'] = 'Catálogo';
    echo view('front/header', $data);
    echo view('front/navbar');
    echo view('front/catalogo', compact('categorias', 'productos'));
    echo view('front/footer');

}

    public function ver_carrito(){
        $session = session();
        $cart = \Config\Services::cart();
        $cart = $cart->contents();

        $data['titulo'] = 'Carrito de compras';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('backend/productos/cart_view');
        echo view('front/footer');
    }

    public function add(){
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();
        

        $cart->insert(array(
            'id'      => request()->getPost('producto_id'),
            'qty'     => 1,
            'price'   => request()->getPost('precio'),
            'name'    => request()->getPost('nombre'),
        ));
        
        session()->setFlashdata('success', 'Producto agregado al carrito');
        return redirect()->back()->withInput(); 
        
    }

    public function remove($rowid) {
    
        $cart = \Config\Services::Cart();
        $request = \Config\Services::request();
       //Si $rowid es "all" destruye el carrito
        if ($rowid==="all") {
            $cart->destroy();
        }
        else { //Sino destruye sola fila seleccionada 
            $cart->remove($rowid);
        }
         // Redirige a la misma página que se encuentra
        return redirect()->back()->withInput();
    }

    public function actualiza_carrito(){
        $cart = \Config\Services::cart(); // Se carga la libreria cart
        
        $request = \Config\Services::request(); // Se carga la libreria request
        $cart->update(array(
            'id' => $request->getPost('producto_id'),
            'name' => $request->getPost('nombre'),
            'qty' => 1,
            'price' => $request->getPost('precio'),
            
        ));

        return redirect()->back()->whitInput();
    }

    


}

















