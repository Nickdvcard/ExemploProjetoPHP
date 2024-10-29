<?php

//arquivo de funções

function slug (string $slug): string {
     
    return $slug;
}

function validarUrlComPhp(string $url): bool {
    return filter_var($url, FILTER_VALIDATE_URL);
}

function validarUrl(string $url): bool {
    
    if (mb_strlen($url) < 10) { //no minimo o https
        return false;
    }

    if (!str_contains($url, '.')) {
        return false;
    }

    if ( !str_contains($url, 'http://') AND !str_contains($url, 'https://')) {
        return false;
    }

    else {
        return true;
    }
}

function validarEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Retorna o tempo passado entre a data presente e outra data passada
 * @param string $data a data a ser omparada om o presente
 * @return string retorna uma aproximação do tempo passado entre essas duas datas
 */

function contarTempo(string $data) {

    echo $data."<hr>";

    $agora = strtotime(date('Y-m-d H:i:s')); //função que puxa a data atual em formato de string
    $data = strtotime($data);
    $diferenca = $agora - $data; //diferença de tempo transcorrido entre a data atual e a data passada

    $segundos = $diferenca;
    $minutos = round($diferenca/60);
    $horas = round($diferenca/3600);

    $dias = round($diferenca/86400); //um dia tem 86400 segundos
    $semanas = round($diferenca/604800); //uma semana tem 604800 segundos
    $meses = round($diferenca/2419200); //um mes tem 2419200 segundos
    $anos = round($diferenca/29030400); //um ano tem 29030400 segundos

    // var_dump($diferenca);
    // var_dump($anos);
    // var_dump(date('Y-m-d H:i:s'));

    if ($segundos <= 60) {
        return "agora";
    }

    else if ($minutos <= 60) {
        return $minutos == 1 ? "há 1 minuto" : "há ".$minutos." minutos";
    }

    else if ($horas <= 24) {
        return $horas == 1 ? "há 1 hora" : "há ".$horas." horas";
    }

    else if ($dias <= 7) {
        return $dias == 1 ? "há 1 dia" : "há ".$dias." dias";
    }

    else if ($semanas <= 4) {
        return $semanas == 1 ? "há 1 semana" : "há ".$semanas." semanas";
    }

    else if ($meses <= 12) {
        return $meses == 1 ? "há 1 mes" : "há ".$meses." meses";
    }

    else {
        return $anos == 1 ? "há 1 ano" : "há ".$anos." anos";
    }
}

/**
 * Formata um valor para duas casas decimais
 * @return string número formatado
 */

function formatarValor(float $valor = 0): string {

    return number_format(($valor > 50 ? $valor : 0), 2, ',', '.'); //valor no number format é definido pelo operador ternário ali
}

/**
 * Escreve uma saudação
 * @return string a sauação a ser mostrada
 */

function saudacao() {

    $hora = date('H');
    $saudacao = '';

    if ($hora >= 0 && $hora <= 5) {
        $saudacao = 'boa madrugada';
    }

    else if ($hora >= 6 && $hora <= 12) {
        $saudacao = 'bom dia';
    } 

    else if ($hora >= 13 && $hora <= 18) {
        $saudacao = 'boa tarde';
    } 

    else {
        $saudacao = 'boa noite';
    }

    return $saudacao;
}

/** 
 * Resume um texto
 * 
 * @param string $texto texto que será resumido
 * @param int $limite limite de caracteres que será considerado
 * @param string $continue (opcional) o que deves ser exibido ao final do resumo
 * @return string texto que passou pelo processo de ser resumido
*/

function resumirTexto(string $texto, int $limite, string $continue = "..."): string {

    $textoLimpo = trim(strip_tags($texto));

    if (mb_strlen($textoLimpo) <= $limite) { //se o texto sem espaço desnecessário já está dentro do limite passado, pode retornar assim mesmo
        return $textoLimpo;
    }

    $trechomax = mb_substr($textoLimpo, 0, $limite); //pega o máximo de trecho/caracteres que conseguir ate atingir o limite - gera uma str
    $maxAteEspaco = mb_strrpos($trechomax, ''); //achao indice da ultima posição dessa substr - retorna int

    $resumirTexto = mb_substr($textoLimpo, 0, $maxAteEspaco);

    return $resumirTexto.$continue;
} 



?>