<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('principal.html');
    }
    public function contacto(){
        echo view('componentes//header.html');
        echo view("componentes//navbar.html");
        echo view("componentes//footer.html");
    }
    public function quienes_somos(){
        echo view('componentes//header.html');
        echo view("componentes//navbar.html");
        echo view("componentes//footer.html");
    }
    public function comercializacion(){
        echo view('componentes//header.html');
        echo view("componentes//navbar.html");
        echo view("componentes//footer.html");
    }
    public function term_usos(){
        echo view('componentes//header.html');
        echo view("componentes//navbar.html");
        echo view("componentes//footer.html");
    }
}

?>