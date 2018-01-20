<?php
require_once 'Pessoa.php';

class Usuario extends Pessoa{
    private $email;
    private $senha;
    private $idsituacao;
    private $idcpf;
    public  $created;
    public  $updated;
    private $table = "usuario";

    public function __construct() {
        parent::__construct();
    }


    public function getTable(){
        return $this->table;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getIdsituacao() {
        return $this->idsituacao;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $senha          = md5( $senha );
        $this->senha    = $senha;
    }

    public function setIdsituacao($idsituacao) {
        $this->idsituacao = $idsituacao;
    }
    
    public function getIdCpf(){
       return $this->idcpf;
    }

    public function setIdCpf($cpf){
        $util = new Util();
        $cpf = $util->retirarHifen($cpf);
        $cpf = $util->retirarPonto($cpf);
        $this->idcpf = $cpf;
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
        $pdo = Conecta::getPdo();
        //Cria o sql passa os parametros e etc
        $sql        = "INSERT INTO $this->table (idcpf, email, senha, idsituacao, created, updated) VALUES "
                . " (?,?,?,?,?,NULL)";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getIdCpf() );
        $consulta   ->bindValue(2, $this->getEmail() );
        $consulta   ->bindValue(3, $this->getSenha() );
        $consulta   ->bindValue(4, $this->getIdsituacao() );
        $consulta   ->bindValue(5, $this->created );
        $consulta   ->execute();
        $last       = $pdo->lastInsertId();
    }
    
    //Alterar um Registro
    public function Update($idcpf){
        $pdo = Conecta::getPdo();
        //Cria o sql passa os parametros e etc
        $sql        = "UPDATE $this->table SET email = ?, senha = ?, idsituacao = ?, updated = ? WHERE idcpf = ? LIMIT 1";
        $consulta   = $pdo->prepare($sql);
        $consulta   ->bindValue(1, $this->getEmail() );
        $consulta   ->bindValue(2, $this->getSenha() );
        $consulta   ->bindValue(3, $this->getIdsituacao() );
        $consulta   ->bindValue(4, $this->updated );
        $consulta   ->bindValue(5, $idcpf);
        $consulta   ->execute();
    }
    
    public function Delete(){
        $pdo        = Conecta::getPdo();
        $sql        = "UPDATE $this->table SET idsituacao = ?, updated = ? WHERE idcpf = ? LIMIT 1";
        $consulta   = $pdo->prepare( $sql );
        $consulta   ->bindValue(1, "2" );
        $consulta   ->bindValue(2, Util::dataNowAmerican() );
        $consulta   ->bindValue(3, $this->getIdCpf() );
        $consulta   ->execute();
    }

}