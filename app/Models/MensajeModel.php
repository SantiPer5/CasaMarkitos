<?php

namespace App\Models;

use CodeIgniter\Model;

class MensajeModel extends Model
{
    protected $table = 'mensajes'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Nombre de la clave primaria
    protected $allowedFields = ['nombre', 'correo', 'asunto', 'mensaje']; // Campos permitidos para inserción
    protected $useAutoIncrement = true; //si mi id es autoincremental
    
    // Otras configuraciones y métodos según tus necesidades
}
