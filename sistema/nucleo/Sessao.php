<?php

namespace sistema\nucleo;

class Sessao {

    public function __construct() {
        
        if (!session_id()) {
            session_start(); //se não exstir um id de sessão, abrir uma sessão
        }
    }

    public function criar(string $chave, mixed $valor): Sessao {
        
        if (is_array($valor)) {
            $valor = (object) $valor;
        }
        
        $_SESSION[$chave] = $valor;

        return $this;
    }

    public function limpar() {
        
    }

    public function carregar(): object {
         return (object) $_SESSION;
    }

    public function checar(string $chave) {
        return isset($_SESSION[$chave]);
    }

    public function deletar() {
        
    }
}

?>