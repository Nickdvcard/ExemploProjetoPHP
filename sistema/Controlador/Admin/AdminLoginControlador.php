<?php

namespace sistema\Controlador\Admin;

use sistema\nucleo\Controlador;
use sistema\Modelo\UsuarioModelo;

class AdminLoginControlador extends Controlador {

    public function __construct() {
        parent::__construct('templates/admin/views'); //é as views dessa pasta que poderão ser manipuladas pelo controlador
    }

    public function login(): void {

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        var_dump($dados);

        if (isset($dados)) {
            if($this->checarDados($dados)) {
                $usuario = (new UsuarioModelo())->login($dados, 3);

                if($usuario) {
                    //header("Location: /".URL_ADMIN."login"); 
                    echo "deu bom";
                }
            }
        }

        echo $this->template->renderizar("login.html", []);
    }

    public function checarDados(array $dados): bool {
        if (empty($dados['email'])) {
            $this->mensagem->sucesso("E-mail é obrigatorio")->flash();
            return false;
        }

        if (empty($dados['senha'])) {
            $this->mensagem->sucesso("Senha é obrigatorio")->flash();
            return false;
        }

        return true;
    }
}

?>