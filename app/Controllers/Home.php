<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('principal.html');
    }
    
    public function quienes_somos()
    {
        $data['titulo'] = 'Quienes Somos?';
        return view('componentes/encabezado', $data)
            ->include('componentes/navbar')
            ->include('contenidos/quienes_somos')
            ->include('componentes/footer');
    }
} 

