<?php


class EstadoController {
    
    public static function save(){
        
        $estado = new Estado();
        $uf     = new Uf();
        if( isset( $_POST["salvar"] ) ){
            
            $estado->setEstado( $uf->getOne( Util::getParameter('estado') )->uf );
            $estado->setIduf(  $uf->getOne( Util::getParameter('estado') )->iduf );
            
            if( empty( $estado->getOne( $estado->getIduf() )->iduf ) ){
                return $estado->Insert();
            }
            
        } else if( isset( $_POST["update"] ) ){
            
            $estado->setEstado( $uf->getOne( Util::getParameter('estado') )->uf );
            $estado->setIduf(  $uf->getOne( Util::getParameter('estado') )->iduf );
            
            if( empty( $estado->getOne( $estado->getIduf() )->iduf ) ){
                return $estado->Insert();
            }else {
                return $estado->Update( $estado->getIduf() );
            }
            
        }
        
    }
    
}
