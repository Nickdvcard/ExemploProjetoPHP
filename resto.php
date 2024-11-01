<?php

//Arquivo que tem restos de outros arquivos

require 'sistema/configuracao.php';
include 'helpers.php';

// /*
echo 'oioioioi!!!';
echo "<h1>oioioioi!!!</h1>";
echo '<br>';
echo '<h1 style="color: blue">oioioioi!!!</h1>'; // */

$texto = 'texto para resumir 2';
$texto = 'O aaaaVsssaasaaaVVVVVVqq';

echo "acccccaaaac";

$total = mb_strlen($texto);
echo $total;

//var_dump($texto);

// /*
echo saudacao();
echo '<hr>'; // */
echo '<br>';
echo resumirTexto($texto, 15); 

////////////////////////////////////

$valor = 523;

// if ($valor != null) {
//     echo $valor;
// }

// else {
//     echo "0";
// }

echo ($valor > 750 ? $valor : 0);

echo "<br>";

echo "R$".formatarValor($valor);

////////////////////////////////////

$data = date('d/m/y H:i:s');
echo $data;

////////////////////////////////////////

$email = "email@icloud.com";
$cerErr = validarEmail($email);
var_dump($cerErr);

if ($cerErr) {
    echo "válido";
}

else {
    echo "inválido";
}

require 'vendor/autoload.php';

use sistema\nucleo\helpers;
use sistema\nucleo\mensagem;


$msg = new mensagem("Texto para ser estilizado", "color: red; background-color: green; border-style: solid; border-color: red;");
echo $msg;
echo $msg->style();


$helper = new helpers();
echo $helper->saudacao();

echo helpers::saudacao();

//////////////////////////////////////////////

try {

    echo helpers::validarCpfBasico("123.456.7ed89-10") ? "cpf válido" : "cpf inválido";
    
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    
    echo "<br> a cleide sem";
    
    
    // $b = true;
    // echo $b

////////////////////////implemnetação de select

use sistema\Modelo\PostsModelo;

$posts = (new PostsModelo());
$resultados = $posts->ler();

foreach($resultados as $post) {
    echo $post->titulo."   ".$post->texto."<br>";
}

echo "<hr>";

$resultadosCond = $posts->lerCond();

foreach($resultadosCond as $post) {
    echo $post->titulo."   ".$post->texto."<br>";
}

echo "<hr>";

$resultadosCond = $posts->lerId(2);

foreach($resultadosCond as $post) {
    echo $post->titulo."   ".$post->texto."<br>";
}

////////////////////////////////////////////sessao

session_start();
echo session_id()."<br>";
echo session_name();

echo "<hr>";

$_SESSION['nome'] = "Nicolas Cardoso";

if (isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] += 1;
} else {
    $_SESSION['visitas'] = 1;
}

echo "{$_SESSION["nome"]} visitou {$_SESSION["visitas"]} vezes"

?>