<?php

namespace App\Controllers;

use App\Models\Usuarios_Model;
use CodeIgniter\Controller;

class Usuario_controller extends Controller
{
    public function __construct() // Constructor del controlador
    {
        helper(['form', 'url']); // Se cargan los helpers form y url
    }

    public function create() // Método para crear un usuario
    {
        $data['titulo'] = 'Registro'; 
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('backend/usuario/singup');
        echo view('front/footer');
    }

    public function formValidation() // Método para validar el formulario de registro
    {
        $validation =  \Config\Services::validation();
        $request = \Config\Services::request();
    
        $validation->setRules([ // Se establecen las reglas de validación
            'nombre' => 'required|min_length[3]|max_length[50]',
            'apellido' => 'required|min_length[3]|max_length[50]',
            'correo' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'password' => 'required|min_length[8]|max_length[255]',
            'password_confirm' => 'required|matches[password]',
        ],
            [ "nombre" => [
                "required" => "El nombre es requerido",
                "min_length" => "El nombre debe tener al menos 3 caracteres",
                "max_length" => "El nombre no debe tener más de 50 caracteres"
            ], "apellido" => [
                "required" => "El apellido es requerido",
                "min_length" => "El apellido debe tener al menos 3 caracteres",
                "max_length" => "El apellido no debe tener más de 50 caracteres"
            ], "correo" => [
                "required" => "El correo es requerido",
                "valid_email" => "El correo debe ser válido",
                "is_unique" => "El correo ya está registrado",
            ], "password" => [
                "required" => "La contraseña es requerida",
                "min_length" => "La contraseña debe tener al menos 8 caracteres",
                "max_length" => "La contraseña no debe tener más de 255 caracteres"
            ], "password_confirm" => [
                "required" => "La confirmación de contraseña es requerida",
                "matches" => "La confirmación de contraseña debe coincidir con la contraseña"
            ]
            ]
            );
    
        if ($validation->withRequest($this->request)->run()){ // Si la validación es correcta, se crea el usuario
            $data = [
                'persona_nombre' => $request->getVar('nombre'),
                'persona_apellido' => $request->getVar('apellido'),
                'persona_correo' => $request->getVar('correo'),
                'persona_telefono' => $request->getPost('telefono'),
                'persona_password' => password_hash($request->getVar('password'), PASSWORD_BCRYPT),
                'perfil_id' => 2,
                'persona_estado' => 1
            ];
    
            $userRegister = new Usuarios_Model();
            $userRegister->insert($data);
            return redirect()->to(base_url('/singup')->with('success', '¡Usuario registrado con éxito!');
        } else {
            $data['errors'] = $validation->getErrors();
            
            $data['titulo'] = 'Registro';
            echo view('front/header', $data);
            echo view('front/navbar');
            echo view('backend/usuario/singup');
            echo view('front/footer');
            return;
        }
    }

/* 
    $validation =  \Config\Services::validation();
    $request = \Config\Services::request();

    $validation->setRules([
        'nombre' => 'required|min_length[3]|max_length[50]',
        'apellido' => 'required|min_length[3]|max_length[50]',
        'correo' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
        'password' => 'required|min_length[8]|max_length[255]',
        'password_confirm' => 'required|matches[password]',
    ],
        [ "nombre" => [
            "required" => "El nombre es requerido",
            "min_length" => "El nombre debe tener al menos 3 caracteres",
            "max_length" => "El nombre no debe tener más de 50 caracteres"
        ], "apellido" => [
            "required" => "El apellido es requerido",
            "min_length" => "El apellido debe tener al menos 3 caracteres",
            "max_length" => "El apellido no debe tener más de 50 caracteres"
        ], "correo" => [
            "required" => "El correo es requerido",
            "valid_email" => "El correo debe ser válido",
            "is_unique" => "El correo ya está registrado",
        ], "password" => [
            "required" => "La contraseña es requerida",
            "min_length" => "La contraseña debe tener al menos 8 caracteres",
            "max_length" => "La contraseña no debe tener más de 255 caracteres"
        ], "password_confirm" => [
            "required" => "La confirmación de contraseña es requerida",
            "matches" => "La confirmación de contraseña debe coincidir con la contraseña"
        ]
        ]
        );

    if ($validation->withRequest($this->request)->run()){
        $data = [
            'persona_nombre' => $request->getPost('nombre'),
            'persona_apellido' => $request->getPost('apellido'),
            'persona_correo' => $request->getPost('correo'),
            'persona_telefono' => $request->getPost('telefono'),
            'persona_password' => password_hash($request->getPost('password'), PASSWORD_BCRYPT),
            'perfil_id' => 2,
            'persona_estado' => 1
        ];

        $userRegister = new Usuarios_Model();
        $userRegister->insert($data);
        return redirect()->to(base_url('/login'))->with('success', '¡Usuario registrado con éxito!');
    } else {
        $data['errors'] = $validation->getErrors();
        
        $data['titulo'] = 'Registro';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('front/registro');
        echo view('front/footer');
        return;
    }
             */
}