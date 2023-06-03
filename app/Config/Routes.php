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

/* Rutas de registro de usuario */
$routes->get('/singup', 'authController::singup'); 
$routes->post('/enviar-form', 'authController::register');

/* Rutas de login */
$routes->get('/login', 'loginController::login');
$routes->post('/authLogin', 'loginController::auth');
$routes->get('/logout', 'loginController::logout');

//$routes->post('/singup', 'Usuario_controller::singup');


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
