<?php

namespace App\Controllers;
use App\Models\Product_Model;
use App\Models\Categoria_Model;
use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {
        $categorias = new Categoria_Model();
        $productos = new Product_Model();

        $categorias = $categorias->findAll();
        $productos = $productos->findAll();

        $data ['titulo'] = 'CasaMarkitos - Distribuidora de productos de bazar y librería en El Colorado, Formosa';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('front/main', compact('categorias', 'productos'));
        echo view('front/footer');
    }
    
    public function quienes_somos()
    {
        $data['titulo'] = 'Quienes Somos?';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('front/quienes_somos');
        echo view('front/footer');
    }

    public function comercializacion()
    {
        $data['titulo'] = 'Comercializacion';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('front/comercializacion');
        echo view('front/footer');
    }

    public function contacto()
    {
        $data['titulo'] = 'Contacto';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('front/contacto');
        echo view('front/footer');
    }

    public function terminos()
    {
        $data['titulo'] = 'Terminos y Condiciones';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('front/terminos');
        echo view('front/footer');
    }
    
/*    public function login()
    {
        $data['titulo'] = 'Iniciar Sesion';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('front/login');
        echo view('front/footer');
    }
     */
    /* public function singup()
    {
        $data['titulo'] = 'Registrarme';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('backend/usuario/singup');
        echo view('front/footer');
    } */

} 

