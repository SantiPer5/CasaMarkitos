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



    public function registrar_consulta() {
        $request = \Config\Services::request();
    
        if ($request->getMethod(true)) { // Si se envió el formulario
            $rules = [
                'nombre' => 'required|min_length[3]|max_length[50]',
                'correo' => 'required|valid_email',
                'asunto' => 'required|min_length[3]|max_length[50]',
                'mensaje' => 'required|min_length[3]|max_length[500]'
            ];
    
            // Validar los datos
            if ($this->validate($rules)) {
                // Verificar el reCAPTCHA
                $recaptchaSecretKey = "6LdBBegnAAAAANHSAaU_iLks6JicF1gkfyehhNkI";
                $recaptchaResponse = $request->getPost('g-recaptcha-response');
    
                $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
                $recaptchaData = [
                    'secret' => $recaptchaSecretKey,
                    'response' => $recaptchaResponse
                ];
    
                $ch = curl_init($recaptchaUrl);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $recaptchaData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $recaptchaResponseData = curl_exec($ch);
                curl_close($ch);
    
                $recaptchaResponseData = json_decode($recaptchaResponseData);
    
                if ($recaptchaResponseData->success) {
                    // El reCAPTCHA se ha validado correctamente
                    $data = [
                        'nombre' => $request->getPost('nombre'),
                        'correo' => $request->getPost('correo'),
                        'asunto' => $request->getPost('asunto'),
                        'mensaje' => $request->getPost('mensaje'),
                        'leido' => 'NO'
                    ];
    
                    $userConsulta = new Consulta_Model();
                    $userConsulta->insert($data);
                    return redirect()->to(base_url('/contacto'))->with('success', '¡Mensaje enviado con éxito!');
                } else {
                    // El reCAPTCHA no se ha validado correctamente
                    return redirect()->to(base_url('/contacto'))->with('error', 'Error de reCAPTCHA. Inténtalo de nuevo.');
                }
            } else {
                // Los datos no son válidos, se muestran los errores
                $data['validation'] = $this->validator;
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

