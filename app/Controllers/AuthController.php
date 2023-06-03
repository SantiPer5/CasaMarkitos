<?php

namespace App\Controllers;

use App\Models\Usuarios_Model;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function __construct() // Constructor del controlador, se llama automaticamente cuando se crea una instancia del controlador
    {
        helper(['form', 'url', 'session']); // Se cargan los helpers form y url
    }
    
    public function singup()
    {
        $data['titulo'] = 'Registrarme';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('backend/usuario/singup');
        echo view('front/footer');
    }

    public function register()
    {
        //Validar el formulario de registro

        if($this->request->getMethod() === 'post') { // Si se envió el formulario
            $rules = [
                'nombre' => 'required|min_length[3]|max_length[50]',
                'apellido' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'telefono' => 'required|min_length[8]|max_length[20]',
                'password' => 'required|min_length[8]|max_length[255]|matches[password_confirm]',
                'password_confirm' => 'required'
            ];
    
            if($this->validate($rules)) {
                $userModel = new Usuarios_Model();

                $usuario = $this->request->getVar('email'); // Se obtiene el valor del campo usuario
            $existingUser = $userModel->where('email', $usuario)->first(); // Se verifica si existe el usuario


                $data = [
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido'),
                    'email' => $this->request->getPost('email'),
                    'telefono' => $this->request->getPost('telefono'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'perfil_id' => 2,
                    'estado' => 1
                ];
                
                $userModel->insert($data);

                //Mostrar mensaje exitoso
                return redirect()->to(base_url('/login'))->with('success', 'Usuario creado exitosamente');
            
            } else {
                //Mostrar errores de validación
                $data['validation'] = $this->validator;
            }
        }
        
        $data['titulo'] = 'Registro'; 
                echo view('front/header', $data);
                echo view('front/navbar');
                echo view('backend/usuario/singup');
                echo view('front/footer');
                session()->setFlashdata('warning', 'Ya existe nombre de usuario');
                return; 
    }

    public function login()
    {
        helper(['form', 'url']); // Se cargan los helpers form y url

        //Validar el formulario de login

        if($this->request->getMethod() === 'post') { // Si se envió el formulario
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email, password]'
            ];
    
            $errors = [
                'password' => [
                    'validateUser' => 'Email o contraseña incorrectos'
                ]
            ];
    
            if($this->validate($rules, $errors)) {
                $model = new Usuarios_Model();
                $user = $model->where('email', $this->request->getVar('email'))->first();
                $this->setUserSession($user);
                return redirect()->to('/dashboard');
            
            } else {
                //Mostrar errores de validación
                $data['validation'] = $this->validator;
            }
        }
        
        $data['titulo'] = 'Login'; 
                echo view('front/header', $data);
                echo view('front/navbar');
                echo view('backend/usuario/login');
                echo view('front/footer');
                return; 
    }
}