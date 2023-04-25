<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data ['titulo'] = 'inicio';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('front/main');
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
} 

