<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group("api", function ($routes) {
    $routes->post("register", "Register::index", ['filter' => 'authFilter']);
    $routes->post("login", "Login::index");
    $routes->get("users", "User::index", ['filter' => 'authFilter']);
    
    $routes->get("pacientes", "Paciente::index");
    $routes->get("paciente/(:num)", "Paciente::pacienteBy/$1");
    $routes->post("paciente", "Paciente::crearPaciente", ['filter' => 'authFilter']);
    $routes->put("paciente/editar/(:num)", "Paciente::modificarPaciente/$1", ['filter' => 'authFilter']);
    
});