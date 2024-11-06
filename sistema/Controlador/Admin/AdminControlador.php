<?php

namespace sistema\Controlador\Admin;

use sistema\nucleo\Controlador;

class AdminControlador extends Controlador {

    public function __construct() {
        parent::__construct('templates/admin/views'); //é as views dessa pasta que poderão ser manipuladas pelo controlador

        $usuario = false;

        if(!$usuario) {
            $this->mensagem->sucesso("Faça login para proceder")->flash();
        }

        header("Location: /".URL_ADMIN."login"); 
    }
}

?>