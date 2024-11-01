<?php

namespace sistema\Controlador\Admin;

use sistema\Controlador\Admin\AdminControlador;
use sistema\Modelo\PostsModelo;

class AdminDashboardControlador extends AdminControlador{
    
    public function dashboard():void {

        echo $this->template->renderizar('dashboard.html', [

        ]);
    }
}

?>