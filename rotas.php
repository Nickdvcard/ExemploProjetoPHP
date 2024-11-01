<?php

// Incluir o autoload do Composer para carregar classes automaticamente
require 'vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;
use sistema\Controlador\Admin\AdminDashboardControlador;
use sistema\Controlador\siteControlador;
use sistema\nucleo\helpers;

try {
    SimpleRouter::setDefaultNamespace('sistema\Controlador');

    // Defina suas rotas
    SimpleRouter::get(URL_SITE, 'siteControlador@index');
    SimpleRouter::get(URL_SITE."sobre", 'siteControlador@sobre');
    SimpleRouter::get(URL_SITE."post/{id}", 'siteControlador@post');
    SimpleRouter::get(URL_SITE."categoria/{id}", 'siteControlador@categoria');
    SimpleRouter::post(URL_SITE."buscar", 'siteControlador@buscar');
    
    SimpleRouter::get(URL_SITE."404", "siteControlador@erro404");

    SimpleRouter::group(['namespace' => 'Admin'], function () {
        SimpleRouter::get(URL_ADMIN."dashboard", 'AdminDashboardControlador@dashboard');

        SimpleRouter::get(URL_ADMIN."posts/listar", 'AdminPostsControlador@listar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN."posts/cadastrar", 'AdminPostsControlador@cadastrar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN."posts/editar/{id}", 'AdminPostsControlador@editar');
        SimpleRouter::get(URL_ADMIN."posts/deletar/{id}", 'AdminPostsControlador@deletar');


        SimpleRouter::get(URL_ADMIN."categorias/listar", 'AdminCategoriasControlador@listar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN."categorias/cadastrar", 'AdminCategoriasControlador@cadastrar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN."categorias/editar/{id}", 'AdminCategoriasControlador@editar');
        SimpleRouter::get(URL_ADMIN."categorias/deletar/{id}", 'AdminCategoriasControlador@deletar');


    });

    SimpleRouter::start();

} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
    $controller = new siteControlador();
    $controller->erro404(); // Chame o método que renderiza a página 404
}

?>
