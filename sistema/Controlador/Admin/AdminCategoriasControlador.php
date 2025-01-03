<?php

namespace sistema\Controlador\Admin;

use sistema\Controlador\Admin\AdminControlador;
use sistema\Modelo\CategoriasModelo;
use sistema\nucleo\Conexao;

class AdminCategoriasControlador extends AdminControlador{
    
    public function listar():void {

        $categorias = (new CategoriasModelo);
        $resultados = $categorias->ler();
        $total = $categorias->total();
        $ativos = $categorias->countEspecializado("status = 1");
        $inativos = $categorias->countEspecializado("status = 0");

      echo $this->template->renderizar('categorias/listar.html', [
        "categorias" => $resultados,
        "total" => [
          'total' => $total,
          'ativos' => $ativos,
          'inativos' => $inativos
        ]
      ]);
    }

    public function cadastrar():void {

    $dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //var_dump($dadosForm);

    if(isset($dadosForm)) {
      $cat = (new CategoriasModelo);
      $cat->inserir($dadosForm);
      header("Location: /".URL_ADMIN."categorias/listar"); // Altere o caminho para a URL correta
      exit; // Certifique-se de sair após o redirecionamento
    }
    
    echo $this->template->renderizar('categorias/formulario.html', []);
  }

  public function editar(int $id):void {
    $cat = (new CategoriasModelo())->lerId($id);
    $resulatdo = $cat[0];

    //var_dump($resulatdo);

    $dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    var_dump($dadosForm);

    if(isset($dadosForm)) {
      $cat = (new CategoriasModelo); 
      $cat->atualizar($dadosForm, $id);
      header("Location: /".URL_ADMIN."categorias/listar"); // Altere o caminho para a URL correta
      exit; // Certifique-se de sair após o redirecionamento
    }

    echo $this->template->renderizar('categorias/formulario.html', [
      "categoria" => $resulatdo
    ]);
  }

  public function deletar(int $id):void {
    $cat = (new CategoriasModelo());
    $cat->deletar($id);
    header("Location: /".URL_ADMIN."categorias/listar"); // Altere o caminho para a URL correta
    exit; // Certifique-se de sair após o redirecionamento
  }

  
}

?>