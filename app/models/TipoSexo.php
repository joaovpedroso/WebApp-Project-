<?php
require_once "Model.php";

class TipoSexo extends Model{
    public $descricao;
    private $table = "tiposexo";

    public function getTable(){
        return $this->table;
    }
    
    //Selecionar dados de determinado registro
    public function getOne($dado){
        //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o SQL
        $sql        = "SELECT * FROM $this->table WHERE idtiposexo = ? LIMIT 1";
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
        $sql        = "INSERT INTO $this->table (idtiposexo, descricao) VALUES "
                . " (NULL, ?)";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->descricao );
        $consulta   ->execute();
        $last       = $pdo->lastInsertId();
            
    }
    
    //Alterar um Registro
    public function Update($idtiposexo){
        $pdo = Conecta::getPdo();
        
        try{
            //Inicia uma nova transação
            $pdo->beginTransaction();
            
            //Cria o sql passa os parametros e etc
            $sql        = "UPDATE $this->table SET descricao = ? WHERE idtiposexo = ? LIMIT 1";
            $consulta   = $pdo->prepare($sql);
            $consulta   ->bindValue(1, $this->descricao );
            $consulta   ->bindValue(2, $idtiposexo );
            $consulta   ->execute();
            
            //Conclui a transação
            return $pdo->commit();
        } catch (PDOException $ex) {
            //Mostra mensagem de erro com o erro
            print "Falha ao Cadastrar ".$ex->getMessage();
            //Interrompe a transação e dezfaz as alterações
            $pdo->rollBack();
        }
    }
    
}

