<?php

namespace sistema\Controlador\Admin;

use sistema\Controlador\Admin\AdminControlador;
use sistema\Modelo\CategoriasModelo;
use sistema\Modelo\PostsModelo;

class AdminPostsControlador extends AdminControlador{
    
    public function listar():void {
        $posts = (new PostsModelo);
        $resultados = $posts->lerId(null, "idPosts DESC"); 
        //$resultados = $posts->ler2()->ordem("idPosts DESC")->resultado2(true); //indica que é pra buscar todos os resultados
        $total = $posts->total();
        // $ativos = $posts->countEspecializado("status = 1");
        // $inativos = $posts->countEspecializado("status = 0");
        $ativos = $posts->ler2("status = 1")->total2();
        $inativos = $posts->ler2("status = 0")->total2();

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

          $post->titulo = $dadosForm['titulo'];
          $post->texto = $dadosForm['texto'];
          $post->status = $dadosForm['status'];
          $post->categorias_id = $dadosForm['categoria'];
          header("Location: /".URL_ADMIN."posts/listar"); // Altere o caminho para a URL correta

          if ($post->salvar()) {
            $this->mensagem->sucesso("post cadstrado com sucesso")->flash();
            header("Location: /".URL_ADMIN."posts/listar"); // Altere o caminho para a URL correta

          }
        } 
    
        // if(isset($dadosForm)) {
        //   $post = (new PostsModelo);
        //   $this->mensagem->sucesso("post cadstrado com sucesso")->flash();
        //   $post->inserir($dadosForm);
        //   header("Location: /".URL_ADMIN."posts/listar"); // Altere o caminho para a URL correta
        //   exit; // Certifique-se de sair após o redirecionamento
        // }
        
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

        // if(isset($dadosForm)) {
        //   $post = (new PostsModelo())->lerId2($id);

        //   $post->titulo = $dadosForm['titulo'];
        //   $post->texto = $dadosForm['texto'];
        //   $post->status = $dadosForm['status'];
        //   $post->categorias_id = $dadosForm['categoria'];

        //   if ($post->salvar()) {
        //     $this->mensagem->sucesso("post atualizado com sucesso")->flash();
        //     header("Location: /".URL_ADMIN."posts/listar"); // Altere o caminho para a URL correta

        //   }
        // } 
    
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

      if(is_int($id)) {
        $post = (new PostsModelo())->lerId2($id);

        if(!$post) {
          $this->mensagem->sucesso("Deu ruim")->flash();
        }

        else {
          $post->apagar2("idPosts = {$id}");
          $this->mensagem->sucesso("Deu bom")->flash();

          header("Location: /".URL_ADMIN."posts/listar"); // Altere o caminho para a URL correta
          exit; // Certifique-se de sair após o redirecionamento
        }
      }

      //$post = (new PostsModelo());
      //$post->apagar2("idPosts = {$id}");
      //$post->deletar($id);
      // header("Location: /".URL_ADMIN."posts/listar"); // Altere o caminho para a URL correta
      // exit; // Certifique-se de sair após o redirecionamento
  }

}

?>