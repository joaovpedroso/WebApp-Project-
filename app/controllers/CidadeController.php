<?php

//id_cidade

class CidadeController {
   
    public static function save(){
        $cidade = new Cidade();
        
        if( isset( $_POST["salvar"] ) ){
            
            $cidade->setCidade( Util::getParameter('cidade') );
            $cidade->setIdCidade( Util::getParameter('id_cidade') );
            
            //Verifiar se nao tem cidade cadastrada com o ID informado
            if( empty( $cidade->getOne( $cidade->getIdCidade() )->idcidade ) ) {
                //Caso nao tenha Insira Nova
                $cidade->Insert();
                //Atribui a Variavel IDCIDADE o valor que veio dos campos ID_CIDADE do formulário
                return $idcidade = $cidade->getIdCidade();
                
            } else {
                
                return $idcidade = $cidade->getIdCidade();
            }
            
        } else if( isset( $_POST["update"] ) ) {
            
            $cidade->setCidade( Util::getParameter('cidade') );
            $cidade->setIdCidade( Util::getParameter('id_cidade') );
            
            //Verifiar se nao tem cidade cadastrada com o ID informado
            if( empty( $cidade->getOne( $cidade->getIdCidade() )->idcidade ) ) {
                //Caso nao tenha Insira Nova
                $cidade->Insert();
                //Atribui a Variavel IDCIDADE o valor que veio dos campos ID_CIDADE do formulário
                return $idcidade = $cidade->getIdCidade();
                
            } else {
                //Caso tenha realize o Update da mesma
                return $cidade->Update( $cidade->getIdCidade() );
            }
            
        }
    }
    
}
