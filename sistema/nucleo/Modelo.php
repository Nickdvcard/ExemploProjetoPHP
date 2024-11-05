<?php

namespace sistema\nucleo;

use PDOException;
use sistema\nucleo\Conexao;
use sistema\nucleo\mensagem;

class modelo {

    protected $dados;
    protected $query;
    protected $erro;
    protected $parametros;
    protected $tabela;
    protected $ordem;
    protected $limite;
    protected $offset;
    protected $mensagem;

    public function __construct(string $tabela) {
        $this->tabela = $tabela;

        $this->mensagem = new mensagem;
    }

    public function ordem(string $ordem) {
        $this->ordem = " ORDER BY {$ordem}";
        return $this;
    }

    public function limite(string $limite) {
        $this->limite = " LIMIT {$limite}";
        return $this;
    }

    public function offset(string $offset) {
        $this->offset = " OFFSET {$offset}";
        return $this;
    }

    public function error() {
        return $this->erro;
    } 

    public function mensagem() {
        return $this->mensagem;
    } 

    public function dados() {
        return $this->dados;
    }

    public function __set($nome, $valor) {

        if(empty($this->dados)) {
            $this->dados = new \stdClass;
        }

        $this->dados->$nome = $valor;
    }

    public function __isset($nome)
    {
        return isset($this->dados->$nome);
    }

    public function __get($nome) {
        return $this->dados->$nome ?? null;
    }

    public function ler2 (string $termos = null, ?string $parametros = null, string $colunas = "*") {
        if ($termos) {
            $this->query = "SELECT {$colunas} FROM ".$this->tabela." WHERE {$termos}";
            parse_str($parametros, $this->parametros);
            return $this;
        } 

        else {
            $this->query = "SELECT {$colunas} FROM ".$this->tabela;
            return $this;   
        }
    }

    public function resultado2 (bool $todos = false) {

        // var_dump($todos);
        // echo $this->query;
        // echo $this->parametros;

        try {
            $stmt = Conexao::getInstancia()->prepare($this->query.$this->ordem);
            $stmt->execute($this->parametros);

            if (!$stmt->fetchColumn()) {
                return null;
            }

            if ($todos) {
                $resultados = $stmt->fetchAll();
                var_dump($resultados);
                return $resultados;
            }

            else {
                return $stmt->fetchObject(static::class);
            }

        } catch (\PDOException $ex) {
            $this->erro = $ex;
            echo "Erro: " . $this->erro;
        }
    }

    protected function cadastrar2(array $dados) {
        try {

            $colunas = implode(",", array_keys($dados));
            $valores = ":".implode(",:", array_keys($dados));

            $query = "INSERT INTO ".$this->tabela." ({$colunas}) VALUES ({$valores})";

            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute($this->filtrar($dados));

            return Conexao::getInstancia()->lastInsertId();

        } catch (\PDOException $ex) {
            $this->erro = $ex;
            echo "Erro: " . $this->erro;
        }
    }

    protected function atualizar2(array $dados, string $termos) {
        try {

            $set = [];
            foreach($dados as $chave => $valor) {
                $set[] = "{$chave} = :{$chave}";
            }

            $set = implode(',', $set);

            $query = "UPDATE ".$this->tabela." SET ({$set}) WHERE ({$termos})";

            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute($this->filtrar($dados));

            return ($stmt->rowCount() > 1 ? $stmt->rowCount() : 1);

        } catch (\PDOException $ex) {
            $this->erro = $ex;
        }
    }

    private function filtrar(array $dados) {

        $filtro = [];

        foreach ($dados as $chave => $valor) {
            if (is_null($valor)) {
                $filtro[$chave] = null;
            }

            else {
                $filtro[$chave] = filter_var($valor, FILTER_DEFAULT);
            }
        }

        return $filtro;
    }

    private function armazenar() {
       $dados = (array) $this->dados;
       
       return $dados; 
    }

    public function lerId2($id) {
        $busca = $this->ler2("idPosts = {$id}");
        return $busca->resultado2();
    }

    public function apagar2(string $termos) {
        try {

            $query = "DELETE FROM ".$this->tabela." WHERE ({$termos})";
            $stmt = Conexao::getInstancia()->prepare($query);
            $stmt->execute();

            return true;

        } catch (\PDOException $ex) {
            $this->erro = $ex;
        }
    }

    public function salvar() {

        //cadastrar
        if(empty($this->id)) {
            $id = $this->cadastrar2($this->armazenar());
            if($this->erro) {
                $this->mensagem->sucesso("erro ao cadastrar");
                return false;
            }
        }

        //atualizar
        if(empty($this->id)) {
            $id = $this->id;
            $this->atualizar2($this->armazenar(), "id = {$id}");
            if($this->erro) {
                $this->mensagem->sucesso("erro ao atualizar");
                return false;
            }
        }

        $this->dados = $this->lerId2($id)->dados();
        return true;
    }

    public function total2():int {
        
        $stmt = Conexao::getInstancia()->prepare($this->query);
        $stmt->execute();
        
        //var_dump($stmt->fetchColumn());

        return $stmt->fetchColumn();
    }


}


