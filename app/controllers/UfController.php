<?php

class UfController {
    
    public static function save(){
        
        $uf = new Uf();
        
        if( isset( $_POST["salvar"] ) ){
            
            $uf->setUf( Util::getParameter('estado') );
            if( empty( $uf->getOne( $uf->getUf() )->iduf ) ){
                $uf->Insert();
                return $iduf = $uf->getOne( $uf->getUf() )->iduf;
            } else {
                return $iduf = $uf->getOne( $uf->getUf() )->iduf;
            }
            
        } else if( isset( $_POST["update"] ) ){
            
            $uf->setUf( Util::getParameter('estado') );
            
            if( empty( $uf->getOne( $uf->getUf() )->iduf ) ){
                
                $uf->Insert();
                return $iduf = $uf->getOne( $uf->getUf() )->iduf;
                
            } else {
                
                return $uf->Update( $uf->getOne( $uf->getUf() )->iduf );
                
            }
        }
        
    }
    
}
