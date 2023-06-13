<?php

namespace App\Models;
use CodeIgniter\Model;

class Ventas_Model extends Model
{
    protected $table = 'venta'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Nombre de la clave primaria
    protected $allowedFields = ['id_cliente', 'fecha_venta', 'total_venta']; // Campos permitidos para inserción
    
    // Otras configuraciones y métodos según tus necesidades
}
