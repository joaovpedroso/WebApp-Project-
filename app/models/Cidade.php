<?php

require_once "../config/Conecta.php";
require_once "Model.php";

class Cidade extends Model{
    private $idcidade;
    private $cidade;
    private $table = "cidade";

    public function getTable(){
        return $this->table;
    }
    
    public function setCidade($cidade){
        $this->cidade = $cidade;
    }

    public function setIdCidade($idcidade){
        $this->idcidade = $idcidade;
    }
    
    public function getCidade(){
        return $this->cidade;        
    }
    
    public function getIdCidade(){
        return $this->idcidade;        
    }
    
    //Selecionar dados de uma cidade
    public function getOne($dado){
        //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o SQL
        $sql        = "SELECT * FROM $this->table WHERE idcidade = ? LIMIT 1";
        //Prepara o SQL
        $consulta   = $pdo->prepare($sql);
        //Atribui valor aos parametros descritos no SQL
        $consulta   ->bindValue(1, $dado);
        //Executa a consulta
        $consulta   ->execute();
        //Retorna o resultado da consulta
        return $consulta->fetch();
        
    }
        
    //Inserir nova cidade no banco de dados
    public function Insert(){
        //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o sql passa os parametros e etc
        $sql        = "INSERT INTO $this->table (idcidade, cidade) VALUES (?, ?)";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getIdCidade());
        $consulta   ->bindValue(2, $this->getCidade());
        $consulta   ->execute();
        $last       = $pdo->lastInsertId();
    }
    
    //Alterar uma cidade
    public function Update($idcidade){
        $pdo = Conecta::getPdo();
        
        //Cria o sql passa os parametros e etc
        $sql        = "UPDATE $this->table SET cidade = ? WHERE idcidade = ? LIMIT 1";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getCidade() );
        $consulta   ->bindValue(2, $idcidade );
        $consulta   ->execute();
    }
    
    /*/*Excluir | Inativar uma cidade
    public function Delete($idcidade){
        $pdo = Conecta::getPdo();
        
        try{
            //Inicia uma nova transação
            $pdo->beginTransaction();
            
            //Cria o sql passa os parametros e etc
            
            
            //Conclui a transação
            $pdo->commit();
        } catch (PDOException $ex) {
            //Mostra mensagem de erro com o erro
            print "Falha ao Cadastrar ".$ex->getMessage();
            //Interrompe a transação e dezfaz as alterações
            $pdo->rollBack();
        }
    }
    */
    
}
//
//$cidade = new Cidade();
//$cidade->setCidade("lovat");
//$cidade->Insert();
//$cidade->Update('1');
//$tabela = $cidade->getTable();
//$cidade = $cidade->getAll($tabela);
//$cidade = $cidade->getOne('2');
//print_r( $cidade );
//print "<br>".$cidade->idcidade;
//print "<br>".$cidade->cidade;
//foreach( $cidade as $indice => $campo ) {
//   
//    print "<br>c - ".$indice;
//    print "val - ".$campo->cidade;
//    
//}
