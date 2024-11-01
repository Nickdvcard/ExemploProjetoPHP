<?php

namespace sistema\Controlador\Admin;

use sistema\Controlador\Admin\AdminControlador;
use sistema\Modelo\CategoriasModelo;
use sistema\Modelo\PostsModelo;

class AdminPostsControlador extends AdminControlador{
    
    public function listar():void {

        $posts = (new PostsModelo);
        $resultados = $posts->ler();
        $total = $posts->total();
        $ativos = $posts->countEspecializado("status = 1");
        $inativos = $posts->countEspecializado("status = 0");

      echo $this->template->renderizar('posts/listar.html', [
        "posts" => $resultados,
        "total" => [
          'total' => $total,
          'ativos' => $ativos,
          'inativos' => $inativos
        ]
      ]);
    }

    public function cadastrar():void {

        $dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        var_dump($dadosForm);
    
        if(isset($dadosForm)) {
          $post = (new PostsModelo);
          $post->inserir($dadosForm);
          header("Location: /".URL_ADMIN."posts/listar"); // Altere o caminho para a URL correta
          exit; // Certifique-se de sair após o redirecionamento
        }
        
        echo $this->template->renderizar('posts/formulario.html', [
            "categorias" => (new CategoriasModelo)->ler()
        ]);
    }

    public function editar(int $id):void {
            
        $post = (new PostsModelo());
        $post = $post->lerId($id);
        $resultado = $post[0];


        $dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($dadosForm);
    
        if(isset($dadosForm)) {
          $post = (new PostsModelo);
          $post->atualizar($dadosForm, $id);
          header("Location: /".URL_ADMIN."posts/listar"); // Altere o caminho para a URL correta
          exit; // Certifique-se de sair após o redirecionamento
        }
        
        echo $this->template->renderizar('posts/formulario.html', [
            "post" => $resultado,
            "categorias" => (new CategoriasModelo)->ler()
        ]);
    }

    public function deletar(int $id):void {
      $post = (new PostsModelo());
      $post->deletar($id);
      header("Location: /".URL_ADMIN."posts/listar"); // Altere o caminho para a URL correta
      exit; // Certifique-se de sair após o redirecionamento
  }

}

?>