<?php
namespace App\Models;

use CodeIgniter\Model;

class DetalleVenta_Model extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_venta', 'id_producto', 'cantidad', 'precio'];

    public function getDetalles($id = null, $id_usuario = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('detalle_venta'); // Crear una instancia de QueryBuilder
    
        $builder->select('*');
        $builder->join('venta', 'venta.id = detalle_venta.id_venta');
        $builder->join('producto', 'producto.producto_id = detalle_venta.id_producto');
        $builder->join('users', 'users.id_persona = venta.id_cliente');
    
        if ($id !== null) {
            $builder->where('venta.id', $id);
        }
    
        $query = $builder->get();
        return $query->getResultArray();
    }
}


