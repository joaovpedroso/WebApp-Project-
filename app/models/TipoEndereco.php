<?php
require_once "Model.php";

class TipoEndereco extends Model{
    private $descricao;
    private $table = "tipoendereco";

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    public function getTable(){
        return $this->table;
    }
    
    
    //Selecionar dados de determinado registro
    public function getOne($dado){
        //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o SQL
        $sql        = "SELECT * FROM $this->table WHERE idtipoendereco = ? LIMIT 1";
        //Prepara o SQL
        $consulta   = $pdo->prepare($sql);
        //Atribui valor aos parametros descritos no SQL
        $consulta   ->bindValue(1, $dado);
        //Executa a consulta
        $consulta   ->execute();
        //Retorna o resultado da consulta
        return $consulta->fetch();
        
    }
        
    //Inserir novo registro no banco de dados
    public function Insert(){
        //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o sql passa os parametros e etc
        $sql        = "INSERT INTO $this->table (idtipoendereco, descricao) VALUES "
                . " (NULL, ?)";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getDescricao() );
        return $consulta   ->execute();
        
    }
    
    //Alterar um Registro
    public function Update($idtipoendereco){
        $pdo = Conecta::getPdo();
        //Cria o sql passa os parametros e etc
        $sql        = "UPDATE $this->table SET descricao = ? WHERE idtipoendereco = ? LIMIT 1";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getDescricao() );
        $consulta   ->bindValue(2, $idtipoendereco );
        return $consulta   ->execute();
    }

}
