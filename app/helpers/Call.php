<?php
//Chamar classe UTIL com as Funções
require_once "Util.php";
$validar = new Util();

//Verificar o Email
if( isset( $_POST["email"] ) ){
    $email = trim( $_POST["email"] );
    print $validar->validarEmail($email);
}

//Verificar a data
if( isset( $_POST["data"] ) ){
    $data = trim( $_POST["data"] );
    $validar->validarDataNascimento($data);
}

//Buscar os dados residenciais pelo cep
if( isset( $_POST["cep"] ) ){
    $cep = trim( $_POST["cep"] );
    print_r ( $validar->getCurl2($cep) );
    header('Content-Type: application/json');  
}

//Verificar se o CPF já esta cadastrado no banco
if( isset( $_POST["cpf"] ) ) {
    $cpf = trim( $_POST["cpf"] );
    //print_r( $validar->verificaCpf($cpf)->nome );
    print_r( $validar->verificaCpf($cpf) );
}