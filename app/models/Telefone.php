<?php
require_once "Model.php";

class Telefone extends Model{
    
    private   $idcpf;
    protected $idtipotelefone;
    protected $ddd;
    protected $telefone;
    protected $ramal;
    private $table = "telefone";

    public function getTable(){
        return $this->table;
    }
    
    public function getIdcpf() {
        return $this->idcpf;
    }

    public function getIdtipotelefone() {
        return $this->idtipotelefone;
    }

    public function getDdd() {
        return $this->ddd;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getRamal() {
        return $this->ramal;
    }

    public function setIdcpf($idcpf) {
        $this->idcpf = $idcpf;
    }

    public function setIdtipotelefone($idtipotelefone) {
        $this->idtipotelefone = $idtipotelefone;
    }

    public function setDdd($ddd) {
        $this->ddd = $ddd;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setRamal($ramal) {
        $this->ramal = $ramal;
    }

    
    //Selecionar dados de determinado registro
    public function getOne($dado){
        //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o SQL
        $sql        = "SELECT * FROM $this->table WHERE idcpf = ? LIMIT 1";
        //Prepara o SQL
        $consulta   = $pdo->prepare($sql);
        //Atribui valor aos parametros descritos no SQL
        $consulta   ->bindValue(1, $dado);
        //Executa a consulta
        $consulta   ->execute();
        //Retorna o resultado da consulta
        return $consulta->fetch();
        
    }
    
    //Selecionar dados de determinado registro
    public function getOneTelefone($dado){
        //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o SQL
        $sql        = "SELECT * FROM $this->table WHERE idcpf = ? AND idtipotelefone = ? ";
        //Prepara o SQL
        $consulta   = $pdo->prepare($sql);
        //Atribui valor aos parametros descritos no SQL
        $consulta   ->bindValue(1, $dado);
        $consulta   ->bindValue(2, "1");
        //Executa a consulta
        $consulta   ->execute();
        //Retorna o resultado da consulta
        return $consulta->fetch();
        
    }
    
    //Selecionar dados de determinado registro
    public function getCelular($dado){
        //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o SQL
        $sql        = "SELECT * FROM $this->table WHERE idcpf = ? AND idtipotelefone = ?";
        //Prepara o SQL
        $consulta   = $pdo->prepare($sql);
        //Atribui valor aos parametros descritos no SQL
        $consulta   ->bindValue(1, $dado);
        $consulta   ->bindValue(2, "2");
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
        $sql        = "INSERT INTO $this->table (idtelefone, idcpf, idtipotelefone, ddd, telefone, ramal) VALUES "
                . " (NULL, ?, ?, ?, ?, ?)";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getIdcpf() );
        $consulta   ->bindValue(2, $this->getIdtipotelefone() );
        $consulta   ->bindValue(3, $this->getDdd() );
        $consulta   ->bindValue(4, $this->getTelefone() );
        $consulta   ->bindValue(5, $this->getRamal() );
        $consulta   ->execute();
        $last       = $pdo->lastInsertId();
            
    }
    
    //Alterar um Registro
    public function Update($idtelefone){
        $pdo = Conecta::getPdo();
        //Cria o sql passa os parametros e etc
        $sql        = "UPDATE $this->table SET idcpf = ?, idtipotelefone = ?, ddd = ?, telefone = ?, ramal = ? WHERE idtelefone = ? LIMIT 1";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getIdcpf() );
        $consulta   ->bindValue(2, $this->getIdtipotelefone() );
        $consulta   ->bindValue(3, $this->getDdd() );
        $consulta   ->bindValue(4, $this->getTelefone() );
        $consulta   ->bindValue(5, $this->getRamal() );
        $consulta   ->bindValue(6, $idtelefone );
        $consulta   ->execute();
    }


}
