<?php

namespace sistema\Controlador;

use sistema\nucleo\Controlador;
use sistema\Modelo\PostsModelo;
use sistema\Modelo\CategoriasModelo;

class siteControlador extends Controlador {

    public function __construct() {
        parent::__construct('templates/site/views');
    }

    public function index(): void {
        $posts = (new PostsModelo());
        $resultadosSelect = $posts->ler();
                
        $categorias = (new CategoriasModelo());
        $resultadosSelect2 = $categorias->ler();

        echo $this->template->renderizar('index.html', [
            "posts" => $resultadosSelect,
            "categorias" => $resultadosSelect2
        ]);
    }

    public function post(int $id): void {
        $posts = (new PostsModelo());
        $resultadosSelect = $posts->lerId($id);

        if(!$resultadosSelect) {
            $this->erro404();
        }

        $categorias = (new CategoriasModelo());
        $resultadosSelect2 = $categorias->ler();

        //var_dump($resultadosSelect);

        echo $this->template->renderizar('post.html', [
            "posts" => $resultadosSelect,
            "categorias" => $resultadosSelect2
        ]);
    }

    public function categoria(int $id): void {

        $posts = (new CategoriasModelo());
        $resultadosSelect = $posts->posts($id);

        $categorias = (new CategoriasModelo());
        $resultadosSelect2 = $categorias->ler();

        if(!$resultadosSelect) {
            $this->erro404();
        }

        else {

            echo $this->template->renderizar('categoria.html', [
                "posts" => $resultadosSelect,
                "categorias" => $resultadosSelect2
            ]);

        }
    }

    public function buscar(): void {
        $busca = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($busca)) { //checa pra ver se $busca possui algo dentro de si
            $posts = (new PostsModelo);
            $resultadosSelect = $posts->pesquisa($busca['busca']);

            //var_dump($resultadosSelect);
        }

        $categorias = (new CategoriasModelo());
        $resultadosSelect2 = $categorias->ler();

        echo $this->template->renderizar('busca.html', [
            "posts" => $resultadosSelect,
            "categorias" => $resultadosSelect2
        ]);
    }

    public function sobre(): void {
        echo "pagina sobre";
    }

    public function erro404(): void {
        header("HTTP/1.1 404 Not Found"); 
        echo $this->template->renderizar('404.html', ['titulo' => 'Página não encontrada']);
    }
}

?>