<?php

namespace sistema\nucleo;

use sistema\Suporte\Template;

class Controlador {

    protected Template $template;
    protected mensagem $mensagem;

    public function __construct(string $diretorio) {
        $this->template = new Template($diretorio);

        $this->mensagem = new mensagem();
    }
}

?>