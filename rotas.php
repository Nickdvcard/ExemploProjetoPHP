<?php

// Incluir o autoload do Composer para carregar classes automaticamente
require 'vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;
use sistema\Controlador\siteControlador;
use sistema\nucleo\helpers;

try {
    SimpleRouter::setDefaultNamespace('sistema\Controlador');

    // Defina suas rotas
    SimpleRouter::get(URL_SITE, 'siteControlador@index');
    SimpleRouter::get(URL_SITE."sobre", 'siteControlador@sobre');
    SimpleRouter::get(URL_SITE."post/{id}", 'siteControlador@post');
    SimpleRouter::get(URL_SITE."categoria/{id}", 'siteControlador@categoria');
    
    SimpleRouter::get(URL_SITE."404", "siteControlador@erro404");

    SimpleRouter::start();

} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
    $controller = new siteControlador();
    $controller->erro404(); // Chame o método que renderiza a página 404
}

?>
