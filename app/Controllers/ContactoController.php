<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MensajeModel;

class ContactoController extends Controller
{
    public function enviarMensaje()
    {
        // Obtener los datos enviados desde el formulario
        $nombre = $this->request->getPost('nombre');
        $correo = $this->request->getPost('correo');
        $asunto = $this->request->getPost('asunto');
        $mensaje = $this->request->getPost('mensaje');
        
        // Validar los datos si es necesario
        $validationRules = [
            'nombre' => 'required|min_length[3]|max_length[50]',
            'correo' => 'required|valid_email',
            'asunto' => 'required|min_length[3]|max_length[50]',
            'mensaje' => 'required|min_length[3]|max_length[500]'
        ];
        
        $input = $this->validate($validationRules); // Validar los datos

        if (!input) {
            $data['titulo'] = 'Contacto';
            
        }

        // Crear una instancia del modelo de Mensaje
        $mensajeModel = new MensajeModel();
        
        // Insertar los datos en la base de datos
        $data = [
            'nombre' => $nombre, 
            'correo' => $correo,
            'asunto' => $asunto,
            'mensaje' => $mensaje
        ];
        $mensajeModel->insert($data);
        
        // Redirigir a una página de éxito o mostrar un mensaje de confirmación
        return redirect()->to('/contacto')->with('success', '¡Mensaje enviado con éxito!');
    }
}
