<?php
require_once "Model.php";

class Estado extends Model{
    private $estado;
    private $iduf;
    private $table = "estado";

    public function getTable(){
        return $this->table;
    }
    
    public function getEstado() {
        return $this->estado;
    }

    public function getIduf() {
        return $this->iduf;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setIduf($iduf) {
        $this->iduf = $iduf;
    }

    //Selecionar dados de determinado registro
    public function getOne($dado){
        //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o SQL
        $sql        = "SELECT * FROM $this->table WHERE iduf = ? LIMIT 1";
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
        $sql        = "INSERT INTO $this->table (iduf, estado ) VALUES "
                . " (?, ?)";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getIduf() );
        $consulta   ->bindValue(2, $this->getEstado() );
        $consulta   ->execute();
        $last       = $pdo->lastInsertId();
    }
    
    //Alterar um Registro
    public function Update($iduf){
        $pdo = Conecta::getPdo();

        //Cria o sql passa os parametros e etc
        $sql        = "UPDATE $this->table SET estado = ? WHERE iduf = ? LIMIT 1";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getEstado() );
        $consulta   ->bindValue(2, $iduf );
        $consulta   ->execute();
    }
}
