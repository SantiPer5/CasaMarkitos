<?php

namespace App\Models;
use CodeIgniter\Model;

class DetalleVenta_Model extends Model
{
    protected $table = 'detalle_venta'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Nombre de la clave primaria
    protected $allowedFields = ['id_venta', 'precio', 'cantidad', 'id_producto']; // Campos permitidos para inserción
    
    // Otras configuraciones y métodos según tus necesidades
}
