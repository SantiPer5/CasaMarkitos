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

    public function miPerfil(){
        
            //Obtenemos los datos desde la bdd
            $userModel = new Usuarios_Model();
            $id_usuario_logueado = intval(session()->id);

            //Obtén el usuario desde la base da datos utilizando el ID del usuario logueado
            $usuario = $userModel->find($id_usuario_logueado);

            //Pasa el usuario a la vista
            $data['usuario'] = $usuario;


            $data['titulo'] = 'Mi Perfil';
                echo view('front/header', $data);
                echo view('front/navbar');
                echo view('backend/usuario/perfil', $data);
                echo view('front/footer');
                return;
        }


            
        public function editarPerfil($id = null) {
            // Verificar que el usuario esté logueado antes de permitir el acceso a la función de edición del perfil.
            if (!intval(session()->id)) {
                return redirect()->to(base_url('/login'));
            }
        
            $userModel = new Usuarios_Model();
        
            // Validar el formulario de edición antes de realizar la actualización.
            if ($this->request->getMethod() === 'post') {
                $rules = [
                    'nombre' => 'required|min_length[3]|max_length[50]',
                    'apellido' => 'required|min_length[3]|max_length[50]',
                    'telefono' => 'required|min_length[8]|max_length[20]',
                    'rsocial' => 'min_length[3]|max_length[100]',
                    'domicilio' => 'min_length[5]|max_length[200]',
                    'provincia' => 'min_length[3]|max_length[50]',
                    'cpostal' => 'min_length[4]|max_length[10]',
                    'cuit' => 'min_length[10]|max_length[12]',
                    'condicioniva' => 'min_length[3]|max_length[100]',
                ];
        
                if ($this->validate($rules)) {
                    // Obtener el ID del usuario logueado desde la sesión.
                    $id_usuario_logueado = intval(session()->id);
        
                    // Actualizar los datos del perfil en la base de datos.
                    $data = [
                        'nombre' => $this->request->getPost('nombre'),
                        'apellido' => $this->request->getPost('apellido'),
                        'telefono' => $this->request->getPost('telefono'),
                        'rsocial' => $this->request->getPost('rsocial'),
                        'domicilio' => $this->request->getPost('domicilio'),
                        'provincia' => $this->request->getPost('provincia'),
                        'cpostal' => $this->request->getPost('cpostal'),
                        'cuit' => $this->request->getPost('cuit'),
                        'condicioniva' => $this->request->getPost('condicioniva')
                    ];
        
                    $userModel->update($id_usuario_logueado, $data);
        
                    // Mostrar mensaje de éxito.
                    session()->setFlashdata('success', 'Perfil actualizado correctamente');
                    return redirect()->to(base_url('/miperfil'));
                } else {
                    // Mostrar errores de validación.
                    $data['validation'] = $this->validator;
                }
            }
        
            // Obtener los datos del usuario para mostrar en el formulario de edición.
            $id_usuario_logueado = intval(session()->id);
            $usuario = $userModel->find($id_usuario_logueado);
        
            // Pasar el usuario a la vista.
            $data['usuario'] = $usuario;
        
            // Cargar la vista para editar el perfil.
            $data['titulo'] = 'Editar Perfil';
            echo view('front/header', $data);
            echo view('front/navbar');
            echo view('backend/usuario/perfil', $data); // Crea la vista editar_perfil.php con el formulario de edición
            echo view('front/footer');
        }
        
}