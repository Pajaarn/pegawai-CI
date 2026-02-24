<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

//login 
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::process');
$routes->get('/logout', 'AuthController::logout');

//departments
$routes->get('departments', 'DepartmentController::index');
$routes->get('departments/create', 'DepartmentController::create');
$routes->post('departments/store', 'DepartmentController::store');
$routes->get('departments/edit/(:num)', 'DepartmentController::edit/$1');
$routes->post('departments/update/(:num)', 'DepartmentController::update/$1');
$routes->get('departments/delete/(:num)', 'DepartmentController::delete/$1');

//positions
$routes->get('positions', 'PositionController::index');
$routes->get('positions/create', 'PositionController::create');
$routes->post('positions/store', 'PositionController::store');
$routes->get('positions/edit/(:num)', 'PositionController::edit/$1');
$routes->post('positions/update/(:num)', 'PositionController::update/$1');
$routes->get('positions/delete/(:num)', 'PositionController::delete/$1');

//employees routes
$routes->get('employees', 'EmployeeController::index');
$routes->get('employees/create', 'EmployeeController::create');
$routes->post('employees/store', 'EmployeeController::store');
$routes->get('employees/edit/(:num)', 'EmployeeController::edit/$1');
$routes->post('employees/update/(:num)', 'EmployeeController::update/$1');
$routes->get('employees/delete/(:num)', 'EmployeeController::delete/$1');


//auth dashboard
$routes->get('dashboard', function() {
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    if (session()->get('role') === 'admin') {
        return redirect()->to('/employees');
    } 

    else {
        return redirect()->to('/profile');
    }
});

//profile
$routes->get('profile', 'ProfileController::index');
$routes->get('profile/edit', 'ProfileController::edit');
$routes->post('profile/update', 'ProfileController::update');

//api routes
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->resource('employees', ['controller' => 'EmployeeApiController']);
});