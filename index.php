<?php

//Arquivo index responsável pela inicialização do sistema

// require 'sistema/configuracao.php';
//include 'sistema/nucleo/helpers.php';
// // include 'helpersMorto.php';
// include 'sistema/nucleo/mensagem.php';
// include 'sistema/nucleo/Controlador.php';

require 'vendor/autoload.php';
require 'rotas.php';

use sistema\nucleo\helpers;
use sistema\nucleo\Conexao;
use sistema\Modelo\PostsModelo;
 
$con = Conexao::getInstancia();


?>