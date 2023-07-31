<?php

namespace App\Controllers;
use App\Models\Consulta_Model;

class ContactoController extends BaseController {

    public function __construct() {
        helper(['url', 'form']);
        // $db = \Config\Database::connect();
    }

    public function principal() {
        $consultaModel = new Consulta_Model();
        $data['consulta'] = $consultaModel->orderBy('id_consulta', 'DESC')->findAll();

        $dato['titulo'] = 'Consultas';
        echo view('front/header', $dato);
        echo view('front/navbar');
        echo view('backend/usuario/consultas', $data);
        echo view('front/footer');
    }

    public function noLeidos() {
        $consultaModel = new Consulta_Model();
        $data['consulta'] = $consultaModel->orderBy('id_consulta', 'DESC')->findAll();

        $dato['titulo'] = 'Consultas';
        echo view('front/header', $dato);
        echo view('front/navbar');
        echo view('backend/usuario/consultas_no_leidas', $data);
        echo view('front/footer');
    }

    public function leido($idConsulta)
    {
        $consultaModel = new Consulta_Model();
    
        $data = [
            'leido' => 'SI'
        ];
    
        $consultaModel->update($idConsulta, $data);
        return redirect()->to('/consulta_contactos'); // Redirige a la página de consultas leídas después de marcar como leída
    }
    
    public function borrarConsulta($idConsulta)
    {
        $consultaModel = new Consulta_Model();
        $consultaModel->delete($idConsulta);
        return redirect()->to('/consulta_no_leidos')->with('msgc', 'Consulta borrada exitosamente');
    }



    public function registrar_consulta(){ // Registrar consulta
        $request = \Config\Services::request();
        if ($request->getMethod(true)) { // Si se envió el formulario
            $rules = [
                'nombre' => 'required|min_length[3]|max_length[50]',
                'correo' => 'required|valid_email',
                'asunto' => 'required|min_length[3]|max_length[50]',
                'mensaje' => 'required|min_length[3]|max_length[500]'
            ];

            $validations = $this->validate ($rules); // Validar los datos

            if ($validations) { // Si los datos son válidos, se insertan en la base de datos
                $data = [
                    'nombre' => $request->getPost('nombre'),
                    'correo' => $request->getPost('correo'),
                    'asunto' => $request->getPost('asunto'),
                    'mensaje' => $request->getPost('mensaje'),
                    'leido' => 'NO'
<<<<<<< HEAD
                    
=======
>>>>>>> f9be12a8ea27728f59d587471213e3a6d515924b
                ];

                $userConsulta = new Consulta_Model();
                $userConsulta->insert($data);
                return redirect()->to(base_url('/contacto'))->with('success', '¡Mensaje enviado con éxito!');

            } else { // Si los datos no son válidos, se muestran los errores
                
                $data['validation'] = $this->validator;
                //Se cargan las vistas con los errores
                $data['titulo'] = 'Contacto'; 
                echo view('front/header', $data);
                echo view('front/navbar');
                echo view('front/contacto');
                echo view('front/footer');
                return;
            }

            

        }
    }
}

