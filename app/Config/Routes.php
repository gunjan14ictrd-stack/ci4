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
// $routes->get('/dashboard/Categories', 'CategoriesController::index');
$routes->get('/dashboard/categories', 'CategoriesController::index');
$routes->get('/dashboard/categories/list', 'CategoriesController::list');
$routes->get('/dashboard/categories/get/(:num)', 'CategoriesController::get/$1');
$routes->post('/dashboard/categories/store', 'CategoriesController::store');
$routes->post('/dashboard/categories/update', 'CategoriesController::update');
$routes->post('/dashboard/categories/delete/(:num)', 'CategoriesController::delete/$1');

// Items CRUD
$routes->get('/items', 'ItemsController::index');           // List
$routes->get('/items/create', 'ItemsController::create');   // Create form
$routes->post('/items/store', 'ItemsController::store');    // Save new
$routes->get('/items/edit/(:num)', 'ItemsController::edit/$1');    // Edit form
$routes->post('/items/update/(:num)', 'ItemsController::update/$1'); // Update
$routes->get('/items/delete/(:num)', 'ItemsController::delete/$1'); // Delete
