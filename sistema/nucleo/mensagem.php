<?php

namespace sistema\nucleo;

class mensagem {

    private $texto;
    private $tamanho;
    private $css;

    public function __construct(string $texto, string $css) {
        $this->texto = $texto;
        $this->tamanho = strlen($texto);
        $this->css = $css;
    }

    public function style() {
        return "<div style='{$this->css}'>{$this->texto}</div>";
    }

    public function __toString() {
        return "Texto: ".$this->texto." tamanho: ".$this->tamanho." css: ".$this->css;
    }

}

?>