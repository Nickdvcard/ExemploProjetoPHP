<?php

namespace sistema\nucleo;

use sistema\nucleo\mensagem;

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

    public function limpar(string $chave): Sessao {
        unset($_SESSION[$chave]);
        return $this;
    }

    public function carregar(): object {
         return (object) $_SESSION;
    }

    public function checar(string $chave) {
        return isset($_SESSION[$chave]);
    }

    public function deletar(): Sessao {
        session_destroy();
        return $this;
    }

    public function __get($attr)
    {
        if (!empty($_SESSION[$attr])) {
            return $_SESSION[$attr];
        }
    }

    public function flash(): ?mensagem {
        if ($this->checar('flash')) {
            $flash = $this->flash;
            $this->limpar('flash');
            return $flash;
        }

        return null;
    }
}

?>