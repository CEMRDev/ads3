<?php

$routes->group('manager', ['namespace' => 'App\Controllers\Manager'], function ($routes){
    $routes->get('/', 'ManagerController::index', ['as' => 'manager']);

    $routes->group('categorias', function($routes){
        $routes->get('/', 'CategoriaController::index', ['as' => 'categorias']);
        $routes->get('get-all', 'CategoriaController::getAllCategorias', ['as' => 'categorias.get.all']);
        $routes->get('get-info', 'CategoriaController::getCategoriasInfo', ['as' => 'categorias.get.info']);

        $routes->post('create', 'CategoriaController::create', ['as' => 'categorias.create']);
        $routes->put('update', 'CategoriaController::update', ['as' => 'categorias.update']);
    });
});