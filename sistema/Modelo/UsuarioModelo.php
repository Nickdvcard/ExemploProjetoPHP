<?php

namespace sistema\Modelo;

use sistema\nucleo\Modelo;
use sistema\nucleo\Conexao;

class UsuarioModelo extends Modelo {

    public function __construct() {
        parent::__construct('Usuarios');
    }

    public function ler (): array {
        
        $query = "SELECT * FROM Usuarios";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado;
    }

         
    public function lerCond (): array {
        
        $query = "SELECT * FROM Usuarios WHERE idUsuarios >= 2 AND status = 0";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetch();

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

        $query = "SELECT * FROM Usuarios {$where}";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        //var_dump($resultado);

        return $resultado; //retorna arry de objetos
    }

    public function countEspecializado(string $exp = null): int {

        if ($exp != null) {
            $comWhere = "WHERE ".$exp;
        }
        
        $query = "SELECT COUNT(*) FROM Usuarios ".$comWhere;
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchColumn();

        //var_dump($resultado);

        return $resultado;
    }   


    // Atualizar, deletar e inserir usuários novos vai ser feito em ou
    
    // public function inserir (array $dados):void {
        
    //     //echo $dados['titulo']; echo $dados['texto']; echo $dados['status'];
    //     $query = "INSERT INTO `Usuarios` (`level`, `nome`, `email`, `senha`, `status`, `ultimoLogin`, `cadastradoEm`, `atualizadoEm`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";       
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute([$dados['level'], $dados['nome'], $dados['email'], $dados['senha'], $dados['status'], $dados['ultimoL'], $dados['email']]);
    // }

    // public function atualizar (array $dados, int $id):void {
        
    //     //echo $dados['titulo']; echo $dados['texto']; echo $dados['status'];
    //     $query = "UPDATE Categorias SET titulo = ?, texto = ?, status = ? 
    //               WHERE Categorias.idCategorias = ?"; 
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute([$dados['titulo'], $dados['texto'], $dados['status'], $id]);
    // }

    // public function deletar (int $id):void {
        
    //     //echo $dados['titulo']; echo $dados['texto']; echo $dados['status'];
    //     $query = "DELETE FROM Categorias WHERE `Categorias`.`idCategorias` = ?"; 
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute([$id]);
    // }

    // public function total ():int {
        
    //     //echo $dados['titulo']; echo $dados['texto']; echo $dados['status'];
    //     $query = "SELECT COUNT(*) FROM Categorias"; 
    //     $stmt = Conexao::getInstancia()->prepare($query);
    //     $stmt->execute();
        
    //     //var_dump($stmt->fetchColumn());

    //     return $stmt->fetchColumn();
    // }

    public function lerEmail (string $email): ?array {
    
        $query = "SELECT * FROM Usuarios WHERE email = ?";       
        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->execute([$email]);
        
        $resultado = $stmt->fetch();

        return $resultado ? (array) $resultado : null;

    }

    public function login (array $dados, int $level = 1) {

        var_dump($dados);
        $usuario = $this->lerEmail($dados['email']); //pega o usuario correspondente a esse email passado
        var_dump($usuario);
        $nome = $usuario['nome'];

        if (!$usuario) {
            $this->mensagem->sucesso("Dados incorretos")->flash();
            return true;
        }

        $this->mensagem->sucesso("Olá, {$nome}, seja bem vindo!")->flash();
        return true;
    }
}

?>