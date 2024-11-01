<?php

namespace sistema\Modelo;

use sistema\nucleo\Conexao; 

class PostsModelo {
     
    public function ler (): array {
        
        $query = "SELECT * FROM Posts";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado;
    }

         
    public function lerCond (): array {
        
        $query = "SELECT * FROM Posts WHERE idPosts >= 2 AND status = 0";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado;
    }   

    public function lerId (int $id = null): array {

        if ($id != null) {
            $where = "WHERE idPosts = {$id}";
        }

        else {
            $where = "";
        }

        $query = "SELECT * FROM Posts {$where}";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado;
    }

    public function pesquisa (string $busca): array {
        
        $query = "SELECT * FROM Posts WHERE titulo LIKE '%{$busca}%'";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado;
    }

    public function inserir (array $dados):void {
        
        //echo $dados['titulo']; echo $dados['texto']; echo $dados['status'];
        $query = "INSERT INTO `Posts` (`titulo`, `texto`, `status`, `categorias_id`) VALUES (?, ?, ?, ?)";       
        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->execute([$dados['titulo'], $dados['texto'], $dados['status'], $dados['categoria']]);
      }

}

?>