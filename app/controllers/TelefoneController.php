<?php

class TelefoneController {
    
    public static function save($idcpf){
        
        $telefone = new Telefone();
        if( isset( $_POST["salvar"] ) ){
            
            $telefone->setRamal( Util::getParameter('ramal') );
            $telefone->setDdd( Util::separarDdd( Util::getParameter('telefone') )["ddd"] );
            $telefone->setTelefone( Util::separarDdd( Util::getParameter('telefone') )["telefone"] );
            $telefone->setIdtipotelefone("1");
            $telefone->setIdcpf($idcpf);
            $telefone->Insert();
   
            
            $telefone->setRamal( Util::getParameter('ramal') );
            $telefone->setDdd( Util::separarDdd( Util::getParameter('celular') )["ddd"] );
            $telefone->setTelefone( Util::separarDdd( Util::getParameter('celular') )["telefone"] );
            $telefone->setIdtipotelefone("2");
            $telefone->setIdcpf($idcpf);
            $telefone->Insert();
        } else if ( isset( $_POST["update"] ) ) {
            
            $telefone->setRamal( Util::getParameter('ramal') );
            $telefone->setDdd( Util::separarDdd( Util::getParameter('telefone') )["ddd"] );
            $telefone->setTelefone( Util::separarDdd( Util::getParameter('telefone') )["telefone"] );
            $telefone->setIdtipotelefone("1");
            $telefone->setIdcpf($idcpf);
            
            //Selecionar o ID do telefone para poder atualizá-lo
            //$idtelefone = $telefone->getOneTelefone( $telefone->getIdcpf() )->idtelefone;
            $idtelefone = $telefone->getOneTelefone( $idcpf )->idtelefone;
            //print_r( $telefone->getOneTelefone( $idcpf )->idtelefone ); exit;
            $telefone->Update($idtelefone);
            
            $telefone->setRamal( Util::getParameter('ramal') );
            $telefone->setDdd( Util::separarDdd( Util::getParameter('celular') )["ddd"] );
            $telefone->setTelefone( Util::separarDdd( Util::getParameter('celular') )["telefone"] );
            $telefone->setIdtipotelefone("2");
            $telefone->setIdcpf($idcpf);
            
            //Selecionar o ID do telefone para poder atualizá-lo
            $idtelefone = $telefone->getCelular( $telefone->getIdcpf() )->idtelefone;
            $telefone->Update($idtelefone);
            
        }
        
    }
    
}
