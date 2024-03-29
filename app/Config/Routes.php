<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/quienessomos', 'Home::quienes_somos');
$routes->get('/comercializacion', 'Home::comercializacion'); 
$routes->get('/contacto', 'Home::contacto');
$routes->get('/terminos', 'Home::terminos');



/* Consultas */
$routes->post('/consulta', 'contactoController::registrar_consulta');
$routes->get('/consulta_contactos', 'contactoController::principal');
$routes->get('/consulta_no_leidos', 'contactoController::noLeidos');
$routes->get('/borrarconsulta/(:num)', 'contactoController::borrarConsulta/$1');
$routes->get('/consulta_leido/(:num)', 'contactoController::leido/$1');

/* Rutas de registro de usuario */
$routes->get('/singup', 'authController::singup'); 
$routes->post('/enviar-form', 'authController::register');
/* Editar usuario */
$routes->get('/miperfil', 'authController::miPerfil');
$routes->post('/editarPerfil', 'authController::editarPerfil');


/* Rutas de login */
$routes->get('/login', 'loginController::login');
$routes->post('/authLogin', 'loginController::auth');
$routes->get('/logout', 'loginController::logout');
$routes->get('/loginCatalogo', 'loginController::loginCatalogo');

/* Rutas Productos */
$routes->get('/crud_productos', 'productController::index'); //Listado de productos
$routes->get('/agregar_producto', 'productController::agregar_producto'); //Formulario de registro de productos
$routes->post('/guardar', 'productController::guardar'); //Guardar productos
$routes->get('/borrar/(:num)', 'productController::borrar/$1'); //Borrar productos
$routes->get('/editar/(:num)', 'productController::editar/$1'); //Formulario de edicion de productos
$routes->post('/actualizar', 'productController::actualizar'); //Actualizar productos
/* Disponibilidad de productos */
$routes->get('disponible/(:num)', 'productController::disponible/$1'); //Disponible productos
$routes->get('no_disponible/(:num)', 'productController::no_disponible/$1'); //No disponible productos
/* Editar Categorias */
$routes->get('/crud_categorias', 'ProductController::editar_categorias'); //Listado de categorias
$routes->post('/guardar_categoria', 'ProductController::guardar_categoria'); //Guardar categorias
$routes->get('/borrar_categoria/(:num)', 'ProductController::borrar_categoria/$1'); //Borrar categorias

/* Mostrar productos en el Catalogo */
$routes->get('/catalogo', 'cartController::catalogo');


/* Carrito */
$routes->get('/ver_carrito', 'cartController::ver_carrito');
$routes->post('/agregar_carrito', 'cartController::add');
$routes->get('carrito_elimina/(:any)','cartController::remove/$1'); // Elimina un ptoducto con id
$routes->get('/borrar','cartController::borrar_carrito'); //Elimina toda el carrito
//muestra las compras una vez que realizamos la misma
$routes->get('/carrito-comprar', 'ventasController::registrar_venta'); //Compra/Registra el carrito
//actualizar carrito con cantidad de productos
$routes->post('/actualizar_carrito', 'CartController::actualiza_carrito'); //Actualiza el carrito


//Rutas ventas
$routes->get('/ventas', 'ventasController::ventas');
$routes->get('/factura/(:num)', 'ventasController::factura/$1');
$routes->get('/generarfactura/(:num)', 'ventasController::generarFactura/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
