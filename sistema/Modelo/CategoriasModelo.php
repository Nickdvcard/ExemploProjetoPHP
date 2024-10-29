<?php

namespace sistema\Modelo;

use sistema\nucleo\Conexao; 

class CategoriasModelo {
     
    public function ler (): array {
        
        $query = "SELECT * FROM Categorias";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado;
    }

         
    public function lerCond (): array {
        
        $query = "SELECT * FROM Categorias WHERE idCategorias >= 2 AND status = 0";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado;
    }   

    public function lerId (int $id = null): array {

        if ($id != null) {
            $where = "WHERE idCategorias = {$id}";
        }

        else {
            $where = "";
        }

        $query = "SELECT * FROM Categorias {$where}";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado;
    }

    public function posts(int $id): array {
        
        $query = "SELECT * FROM Posts WHERE categorias_id = {$id} ORDER BY idPosts DESC";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado;
    }

}

?>