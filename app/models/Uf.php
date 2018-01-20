<?php
require_once "Model.php";

class Uf extends Model{
    private $uf;
    private $table = "uf";

    public function getUf() {
        return $this->uf;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }
    
    public function getTable(){
        return $this->table;
    }

    //Selecionar dados de determinado registro
    public function getOne($dado){
        //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o SQL
        $sql        = "SELECT * FROM $this->table WHERE uf = ? LIMIT 1";
        //Prepara o SQL
        $consulta   = $pdo->prepare($sql);
        //Atribui valor aos parametros descritos no SQL
        $consulta   ->bindValue(1, $dado);
        //Executa a consulta
        $consulta   ->execute();
        //Retorna o resultado da consulta
        return $consulta->fetch();
        
    }
        
    public function getAllUf($table){
        //Selecionar todos os registros da tabela do banco
        $pdo = Conecta::getPdo();
        $sql = "SELECT uf.iduf, uf.uf, e.estado FROM ".$table." uf "
             . "INNER JOIN estado e ON e.iduf = uf.iduf";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }
    
    //Inserir novo registro no banco de dados
    public function Insert(){
            $pdo = Conecta::getPdo();
            //Cria o sql passa os parametros e etc
            $sql        = "INSERT INTO $this->table (iduf, uf) VALUES "
                    . " (NULL, ?)";
            $consulta   = $pdo->prepare($sql);
            $consulta   ->bindValue(1, $this->uf );
            $consulta   ->execute();
            $last       = $pdo->lastInsertId();
            
    }
    
    //Alterar um Registro
    public function Update($iduf){
        $pdo = Conecta::getPdo();

        //Cria o sql passa os parametros e etc
        $sql        = "UPDATE $this->table SET uf = ? WHERE iduf = ? LIMIT 1";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->uf );
        $consulta   ->bindValue(2, $iduf );
        $consulta   ->execute();
         
    }
    
}