<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('principal.html');
        echo view('plantillas/quienes');
    }
    public function contacto(){

    }
}


