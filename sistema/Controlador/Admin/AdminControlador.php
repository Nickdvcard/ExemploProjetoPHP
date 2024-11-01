<?php

namespace sistema\Controlador\Admin;

use sistema\nucleo\Controlador;

class AdminControlador extends Controlador {

    public function __construct() {
        parent::__construct('templates/admin/views'); //é as views dessa pasta que poderão ser manipuladas pelo controlador
    }
}

?>