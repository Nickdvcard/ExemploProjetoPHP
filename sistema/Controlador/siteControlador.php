<?php

namespace sistema\Controlador;

use sistema\nucleo\Controlador;

class siteControlador extends Controlador {

    public function __construct() {
        parent::__construct('templates/site/views');
    }

    public function index(): void {
        echo $this->template->renderizar('index.html', ['titulo' => 'teste de titulo']);
    }

    public function sobre(): void {
        echo "pagina sobre";
    }

    public function erro404(): void {
        header("HTTP/1.1 404 Not Found"); 
        echo $this->template->renderizar('404.html', ['titulo' => 'Página não encontrada']);
    }
}

?>