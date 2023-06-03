<?php

namespace App\Controllers;

use App\Models\Usuarios_Model;
use CodeIgniter\Controller;

class LoginController extends BaseController {

    public function __construct(){
        helper(['form', 'url', 'session']);
    }

    public function login(){
        $data['titulo'] = 'Iniciar Sesion';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('backend/usuario/login');
        echo view('front/footer');
    }

    public function auth(){
        $session = session(); // Se crea una instancia de la clase session
        $model = new Usuarios_Model(); // Se crea una instancia del modelo Usuarios_Model'

        /* Traemos los datos del formulario */
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        /* Buscamos el usuario en la base de datos */
        $data = $model->where('email', $email)->first();

        /* Si el usuario existe */
        if($data){
            /* Verificamos si la contraseña es correcta */
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);

            /* Si la contraseña es correcta */
            if($verify_pass){
                $ses_data = [
                    'id' => $data['id_persona'],
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'email' => $data['email'],
                    'telefono' => $data['telefono'],
                    'perfil_id' => $data['perfil_id'],
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data); // Se crea la sesion con los datos del usuario

              /*   switch (session ('perfil')) {
                    case 1:
                        return redirect()->to(base_url('/admin')); //
                        break;
                    case 2:
                        return redirect()->to(base_url('/'));
                        break;
                } */

                return redirect()->to(base_url('/'));  // Redireccionamos al dashboard
            } else {
                $session->setFlashdata('msg', 'Contraseña incorrecta');
                return redirect()->to(base_url('/login'));
            }
        } else {
            $session->setFlashdata('msg', 'El correo electrónico no existe');
            return redirect()->to(base_url('/login'));
        }
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}