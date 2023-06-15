<?php

namespace App\Controllers;

use App\Models\Product_Model;
use App\Models\Categoria_Model;
use CodeIgniter\Controller;



class ProductController extends Controller{

public function __construct(){
    helper(['form', 'url', 'session']);
}

/* Motrar los productos en lista */
public function index(){
    $model = new Product_Model();
    $dato['productos'] = $model->orderBy('producto_id', 'DESC')->findAll();
    
    $data['titulo'] = 'Crud_Productos';
    echo view('front/header', $data);
    echo view('front/navbar');
    echo view('backend/productos/product_list', $dato);
    echo view('front/footer');
}


public function agregar_producto(){
    
    $data['titulo'] = 'Agregar Producto';
    echo view('front/header', $data);
    echo view('front/navbar');
    echo view('backend/productos/crear');
    echo view('front/footer');


}

public function guardar(){
    $input = $this->validate([
        'nombre_prod' => 'required|min_length[3]|max_length[255]',
        'precio' => 'required',
        'imagen' => 'mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png,image/webp,image/ico,image/jfif]|max_size[imagen,4096]',
    ]);

    $productModel = new Product_Model();

    if(!$input) {
        $data ['titulo'] = 'Agregar Producto';
        echo view('front/header', $data);
        echo view('front/navbar');
        echo view('backend/productos/crear', ['validation' => $this->validator]);
        echo view('front/footer');
    } else {

        if(!$this->request->getFile('imagen')->isValid()) {
            //el usuario no ha seleccionado un archivo de imagen valido
            session()->setFlashdata('msg', 'Error al cargar la imagen');
            return redirect()->to(base_url('/agregar_producto'));
        }

        $imagen = $this->request->getFile('imagen');
        $nombreAleatorio = $imagen->getRandomName();
        $imagen->move('./assets/uploads', $nombreAleatorio);

        $dato = [
            'nombre_prod' => $this->request->getVar('nombre_prod'),
            'categoria_id' => $this->request->getVar('categoria_id'),
            'precio' => $this->request->getVar('precio'),
            'descripcion' => $this->request->getVar('descripcion'),
            'stock' => $this->request->getVar('stock'),
            'imagen' => $nombreAleatorio,
            'estado' => $this->request->getVar('estado')
        ];
        
        $productModel->insert($dato);
        session()->setFlashdata('msg', 'Producto agregado correctamente');
        return $this->response->redirect(base_url('/agregar_producto'));

    }

}


public function borrar($id = null){
    $model = new Product_Model();
    $data['producto'] = $model->where('producto_id', $id)->first(); //Nos ubicamos en el registro a borrar

    $rutaImagen = './assets/uploads/'.$data['producto']['imagen']; //Obtenemos la ruta de la imagen
    unlink($rutaImagen);    //Eliminamos la imagen

    $model->where('producto_id', $id)->delete($id); //Eliminamos el registro de la base de datos
    session()->setFlashdata('msg', 'Producto eliminado correctamente');
    return $this->response->redirect(base_url('/crud_productos'));

}

public function editar($id = null){
    $model = new Product_Model();
    $data['producto'] = $model->where('producto_id', $id)->first();

    $data['titulo'] = 'Editar Producto';
    echo view('front/header', $data);
    echo view('front/navbar');
    echo view('backend/productos/editar', $data);
    echo view('front/footer');



}

public function actualizar($id = null){
    
    $productModel = new Product_Model();
    $datos = [
        'nombre_prod' => $this->request->getVar('nombre_prod'),
        'categoria_id' => $this->request->getVar('categoria_id'),
        'precio' => $this->request->getVar('precio'),
        'descripcion' => $this->request->getVar('descripcion'),
        'stock' => $this->request->getVar('stock'),
        'estado' => $this->request->getVar('estado')
    ];

    $id = $this->request->getVar('producto_id');


    $productModel->update($id, $datos);

    $validation =  $this->validate([
        'imagen' => 'uploaded[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png,image/webp,image/ico,image/jfif]|max_size[imagen,4096]',
    ]);
    
    if($validation){ //Si la imagen es valida, la actualizamos

        if($imagen = $this->request->getFile('imagen')){ //Si el usuario ha seleccionado una imagen
            $datosProducto = $productModel->where('producto_id', $id)->first(); //Obtenemos los datos del producto 

            $rutaImagen = './assets/uploads/'.$datosProducto['imagen']; //Obtenemos la ruta de la imagen
            unlink($rutaImagen); //Eliminamos la imagen

            $nuevoNombre = $imagen->getRandomName(); //Generamos un nombre aleatorio para la imagen
            $imagen->move('./assets/uploads', $nuevoNombre); //Movemos la imagen a la carpeta uploads

            $datos = [ 'imagen' => $nuevoNombre ]; //Actualizamos el campo imagen con el nuevo nombre
            $productModel->update($id, $datos); //Actualizamos el registro en la base de datos
        }
    } 

    session()->setFlashdata('msg', 'Producto actualizado correctamente');
    return $this->response->redirect(base_url('/crud_productos'));

}


public function catalogo()
{
    $categorias = new Categoria_Model();
    $productos = new Product_Model();

    $categorias = $categorias->findAll();
    $productos = $productos->findAll();
    

    $data['titulo'] = 'Catálogo';
    echo view('front/header', $data);
    echo view('front/navbar');
    echo view('front/catalogo', compact('categorias', 'productos'));
    echo view('front/footer');

}


}



