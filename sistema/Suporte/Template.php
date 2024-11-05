<?php

namespace sistema\Suporte;

use Twig\Lexer;
use sistema\nucleo\helpers;

class Template {

    private \Twig\Environment $twig;

    public function __construct(string $diretorio) {
        $loader = new \Twig\Loader\FilesystemLoader($diretorio);
        $this->twig = new \Twig\Environment($loader);
        $lexer = new Lexer($this->twig, array ($this->helpers()));
    }

    public function renderizar (string $view, array $dados) {
        return $this->twig->render($view, $dados); 
    }

    private function helpers(): void {

        array (
            $this->twig->addFunction(
                new \Twig\TwigFunction('url', function (string $url = null) {
                    return helpers::url($url);
                })
            ),

            $this->twig->addFunction(
                new \Twig\TwigFunction('saudacao', function () {
                    return helpers::saudacao();
                })
            ),

            $this->twig->addFunction(
                new \Twig\TwigFunction('resumirTexto', function (string $texto, int $limite, string $continue = "...") {
                    return helpers::resumirTexto($texto, $limite, $continue);
                })
            ),


            $this->twig->addFunction(
                new \Twig\TwigFunction('flash', function () {
                    return helpers::flash();
                })
            )
        );
    }
}

?>