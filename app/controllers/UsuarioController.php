<?php

class UsuarioController {
    
    public static function save($pessoa){
        
        $usuario = new Usuario();
        
        if( isset( $_POST["salvar"] ) ){
            
            //Inserir Novo Usuário
            $usuario->setEmail( Util::getParameter('email') );
            $usuario->setSenha( Util::getParameter('senha') );
            $usuario->setIdsituacao( Util::getParameter('status') );
            $usuario->setIdCpf( $pessoa->getIdCpf() );
            return $usuario->Insert();
            
        }else if( isset( $_POST["update"] ) ){
            
            //Atualizar Usuário
            $usuario->setEmail( Util::getParameter('email') );
            if( empty( Util::getParameter('senha') ) ){
                 $usuario->setSenha( Util::getParameter('senha_a') );
            }else {
                $usuario->setSenha( Util::getParameter('senha') );
            }
            $usuario->setIdsituacao( Util::getParameter('status') );
            $usuario->setIdCpf( $pessoa->getIdCpf() );
            return $usuario->Update($usuario->getIdCpf() );
            
        }else if( isset( $_POST["delete"] ) ){
            
            $usuario->setIdCpf( $pessoa->getIdCpf() );
            return $usuario->Delete();
            
        }
        
    }
}
