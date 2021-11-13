<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'PagesController::index');
$routes->get('/login', 'PagesController::login');
$routes->get('/register', 'PagesController::register');
$routes->get('/forgot', 'PagesController::forgotPassword');
$routes->get('/dashboard', 'PagesController::dashboard');

$routes->get('/manage/roles', 'RolesController::index');
$routes->get('/manage/accounts', 'AccountsController::index');
$routes->get('/manage/owners', 'OwnersController::index');
$routes->get('/manage/types', 'PetTypesController::index');
$routes->get('/manage/breeds', 'BreedsController::index');
$routes->get('/manage/pets', 'PetsController::index');
$routes->get('/manage/doctors', 'DoctorsController::index');
$routes->get('/manage/nurses', 'NursesController::index');
$routes->get('/manage/staffs', 'StaffsController::index');
$routes->get('/manage/medicines', 'MedicinesController::index');
$routes->get('/manage/tools', 'ToolsController::index');
$routes->get('/manage/diseases', 'DiseasesController::index');
$routes->get('/manage/rooms', 'RoomsController::index');

$routes->get('/transaction/registration', 'RegistrationController::index');


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
