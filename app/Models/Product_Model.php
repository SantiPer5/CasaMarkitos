<?php

namespace App\Models;
use CodeIgniter\Model;

class Product_Model extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'producto_id';
    protected $allowedFields = ['nombre', 'descripcion', 'stock', 'precio', 'categoria_id', 'imagen', 'estado'];
}