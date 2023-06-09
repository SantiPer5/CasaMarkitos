<?php

namespace App\Models;
use CodeIgniter\Model;

class Consulta_Model extends Model
{
    protected $table = 'contacto-mensajes'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_consulta'; // Nombre de la clave primaria
    protected $allowedFields = ['nombre', 'correo', 'asunto', 'mensaje', 'leido']; // Campos permitidos para inserción
    
    // Otras configuraciones y métodos según tus necesidades
}
