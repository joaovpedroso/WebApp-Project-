<?php
require_once "Model.php";

class Endereco extends Model{
    private $cep;
    private $endereco;
    private $numero;
    private $complemento;
    private $idcpf;
    private $iduf;
    private $idcidade;
    private $idtipoendereco;
    private $bairro;
    private $table = "endereco";

    public function getTable(){
        return $this->table;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function getIdcpf() {
        return $this->idcpf;
    }

    public function getIduf() {
        return $this->iduf;
    }

    public function getIdcidade() {
        return $this->idcidade;
    }

    public function getIdtipoendereco() {
        return $this->idtipoendereco;
    }
    
    public function getBairro() {
        return $this->bairro;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function setIdcpf($idcpf) {
        $this->idcpf = $idcpf;
    }

    public function setIduf($iduf) {
        $this->iduf = $iduf;
    }

    public function setIdcidade($idcidade) {
        $this->idcidade = $idcidade;
    }

    public function setIdtipoendereco($idtipoendereco) {
        $this->idtipoendereco = $idtipoendereco;
    }
    
    public function setBairro($bairro) {
        $this->bairro = $bairro;
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
        
    //Inserir novo registro no banco de dados
    public function Insert(){
         //Instancia conexao com o PDO
        $pdo        = Conecta::getPdo();
        //Cria o sql passa os parametros e etc
        $sql        = "INSERT INTO $this->table (idendereco, idcpf, cep, endereco, numero, complemento, iduf, idcidade, idtipoendereco, bairro) VALUES "
                . " (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getIdcpf() );
        $consulta   ->bindValue(2, $this->getCep() );
        $consulta   ->bindValue(3, $this->getEndereco() );
        $consulta   ->bindValue(4, $this->getNumero() );
        $consulta   ->bindValue(5, $this->getComplemento() );
        $consulta   ->bindValue(6, $this->getIduf() );
        $consulta   ->bindValue(7, $this->getIdcidade() );
        $consulta   ->bindValue(8, $this->getIdtipoendereco() );
        $consulta   ->bindValue(9, $this->getBairro() );
        $consulta   ->execute();
        $last       = $pdo->lastInsertId();
    }
    
    //Alterar uma cidade
    public function Update($idendereco){
        $pdo = Conecta::getPdo();
        
        
        //Cria o sql passa os parametros e etc
        $sql        = "UPDATE $this->table SET idcpf = ? , cep = ? , endereco = ? , numero = ? , complemento = ? , iduf = ? , idcidade = ? , idtipoendereco = ?, bairro = ? WHERE idendereco = ? LIMIT 1";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getIdcpf() );
        $consulta   ->bindValue(2, $this->getCep() );
        $consulta   ->bindValue(3, $this->getEndereco() );
        $consulta   ->bindValue(4, $this->getNumero() );
        $consulta   ->bindValue(5, $this->getComplemento() );
        $consulta   ->bindValue(6, $this->getIduf() );
        $consulta   ->bindValue(7, $this->getIdcidade() );
        $consulta   ->bindValue(8, $this->getIdtipoendereco() );
        $consulta   ->bindValue(9, $this->getBairro() );
        $consulta   ->bindValue(10, $idendereco );
        $consulta   ->execute();            
    }
    
}
