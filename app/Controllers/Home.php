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
} 

