<?php

namespace sistema\Modelo;

use sistema\nucleo\Conexao; 
use sistema\nucleo\Modelo;

class PostsModelo extends Modelo {

    public function __construct() {
        parent::__construct('Posts');
    }
     
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

    public function lerId (int $id = null, string $ordem = null): array {

        if ($id != null) {
            $where = "WHERE idPosts = {$id}";
        }

        else {
            $where = "";
        }

        if ($ordem != null) {
            $where2 = "ORDER BY {$ordem}";
        }

        else {
            $where2 = "";
        }

        // var_dump($where2);
        // var_dump($ordem);

        $query = "SELECT * FROM Posts {$where} {$where2}";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado;
    }

    public function countEspecializado(string $exp = null): int {

        if ($exp != null) {
            $comWhere = "WHERE ".$exp;
        }
        
        $query = "SELECT COUNT(*) FROM Posts ".$comWhere;
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchColumn();

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

    public function atualizar (array $dados, int $id):void {
        
        //echo $dados['titulo']; echo $dados['texto']; echo $dados['status'];
        $query = "UPDATE Posts SET titulo = ?, texto = ?, status = ?, categorias_id = ?
                  WHERE Posts.idPosts = ?" ; 
        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->execute([$dados['titulo'], $dados['texto'], $dados['status'], $dados['categoria'], $id]);
    }

    public function deletar (int $id):void {
        
        //echo $dados['titulo']; echo $dados['texto']; echo $dados['status'];
        $query = "DELETE FROM Posts WHERE `Posts`.`idPosts` = ?"; 
        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->execute([$id]);
    }

    public function total ():int {
        
        //echo $dados['titulo']; echo $dados['texto']; echo $dados['status'];
        $query = "SELECT COUNT(*) FROM Posts"; 
        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->execute();
        
        //var_dump($stmt->fetchColumn());

        return $stmt->fetchColumn();
    }
}

?>