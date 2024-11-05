<?php

namespace sistema\nucleo;

use sistema\nucleo\Sessao;

class mensagem {

    private $texto;
    private $tamanho;
    private $css;
    private $estilizado;

    // public function __construct(string $texto, string $css) {
    //     $this->texto = $texto;
    //     $this->tamanho = strlen($texto);
    //     $this->css = $css;
    // }

    public function __toString() {
        return $this->renderizar();
    }

    public function sucesso(string $mensagem): mensagem {
        $this->css = "alert alert-success";
        $this->texto = $this->filtrar($mensagem);
        $this->estilizado = $this->renderizar();
        return $this;
    }

    public function renderizar(): string {
        return "<div style='{$this->css}'>{$this->texto}</div>";
    }

    private function filtrar(string $mensagem): string {
        return filter_var($mensagem, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function flash(): void {
        $sessao = new Sessao;
        $sessao->criar("flash", $this);
    }

}

?>