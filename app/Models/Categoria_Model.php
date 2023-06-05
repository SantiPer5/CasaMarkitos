<?php

namespace App\Models;
use CodeIgniter\Model;

class Categoria_Model extends Model{
    protected $table = 'producto_categoria';
    protected $primaryKey = 'categoria_id';
    protected $allowedFields = ['categoria_desc'];
}