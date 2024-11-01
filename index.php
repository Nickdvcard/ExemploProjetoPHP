<?php

//Arquivo index responsável pela inicialização do sistema

// require 'sistema/configuracao.php';
//include 'sistema/nucleo/helpers.php';
// // include 'helpersMorto.php';
// include 'sistema/nucleo/mensagem.php';
// include 'sistema/nucleo/Controlador.php';

require 'vendor/autoload.php';
//require 'rotas.php';

use sistema\nucleo\helpers;
use sistema\nucleo\Conexao;
use sistema\Modelo\PostsModelo;

use sistema\nucleo\Sessao;
 
$con = Conexao::getInstancia();

$sessao = new Sessao;
$sessao->criar("usuario", ["id" => 10, "nome" => "Nicolas"]);

var_dump($sessao->carregar());
echo "<br>";
var_dump($sessao->carregar()->usuario);
echo "<br>";
var_dump($sessao->carregar()->usuario->nome);
echo "<br>";
var_dump($sessao->carregar()->visitas);

var_dump($sessao->checar('visitas'));

?>