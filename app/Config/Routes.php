<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Registration
$routes->get('/', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register/save', 'Auth::registerSave');


// Create Password (After Payment)
$routes->get('/create-password/(:num)', 'Auth::createPasswordForm/$1');
$routes->post('/create-password/save/(:num)', 'Auth::createPasswordSave/$1');

// Login / Logout
$routes->get('/login', 'Auth::login');
$routes->post('/login/check', 'Auth::loginCheck');
$routes->get('/logout', 'Auth::logout');


// Dashboard
$routes->get('/dashboard', 'DashboardController::index');

// Items CRUD
$routes->get('/items', 'ItemsController::index');           // List
$routes->get('/items/create', 'ItemsController::create');   // Create form
$routes->post('/items/store', 'ItemsController::store');    // Save new
$routes->get('/items/edit/(:num)', 'ItemsController::edit/$1');    // Edit form
$routes->post('/items/update/(:num)', 'ItemsController::update/$1'); // Update
$routes->get('/items/delete/(:num)', 'ItemsController::delete/$1'); // Delete


//inventory
$routes->get('/inventory','inventorycontroller::index');
$routes->get('/inventory/create', 'inventorycontroller::create');
$routes->POST('/inventory/store','inventorycontroller::store');
$routes->get('/inventory/edit/(:num)','inventorycontroller::edit/$1');
$routes->POSt('/inventory/update/(:num)','inventorycontroller::update/$1');
$routes->get('/inventory/delete/(:num)', 'inventorycontroller::delete/$1');