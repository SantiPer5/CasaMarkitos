<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuarios_Model extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_persona';
    protected $allowedFields = ['nombre', 'apellido', 'email', 'telefono', 'password', 'perfil_id', 'estado', 'rsocial', 'domicilio', 'provincia', 'cpostal', 'cuit', 'condicioniva'];
}