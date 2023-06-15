<?php

namespace App\Models;
use CodeIgniter\Model;

class Ventas_Model extends Model
{
    protected $table = 'venta'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Nombre de la clave primaria
    protected $allowedFields = ['id_cliente', 'fecha_venta', 'total_venta']; // Campos permitidos para inserción
    
    public function getDetalles($id = null, $id_usuario = null) { // Obtener los detalles de la venta
        $db = \Config\Database::connect(); // Conectarse a la base de datos
        $builder = $db->table('venta'); // Crear una instancia de QueryBuilder
    
        $builder->select('*'); 
        $builder->join('users', 'users.id_persona = venta.id_cliente');


        if ($id !== null) {
            $builder->where('venta.id', $id);
        }
    
        $query = $builder->get(); // Ejecutar la consulta
        return $query->getResultArray();
    }
}
