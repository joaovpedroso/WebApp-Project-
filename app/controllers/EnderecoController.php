<?php

class EnderecoController {
    
    public static function save($idcpf){
        
        $endereco   = new Endereco();
        $uf         = new Uf();
        
        if( isset( $_POST["salvar"] ) ){
            
            $endereco->setIdcpf($idcpf);
            $endereco->setCep( Util::getParameter('cep') );
            $endereco->setComplemento( Util::getParameter('complemento') );
            $endereco->setEndereco( Util::getParameter('endereco') );
            $endereco->setNumero( Util::getParameter('numero') );
            $endereco->setIdcidade( Util::getParameter('id_cidade') );
            $endereco->setIdtipoendereco( Util::getParameter('id_tipoendereco') );
            $endereco->setIduf( $uf->getOne( Util::getParameter('estado') )->iduf );
            $endereco->setBairro( Util::getParameter('bairro') );
            
            $endereco->Insert();
            
        } else if( isset( $_POST["update"] ) ) {
            
            $endereco->setIdcpf($idcpf);
            $endereco->setCep( Util::getParameter('cep') );
            $endereco->setComplemento( Util::getParameter('complemento') );
            $endereco->setEndereco( Util::getParameter('endereco') );
            $endereco->setNumero( Util::getParameter('numero') );
            $endereco->setIdcidade( Util::getParameter('id_cidade') );
            $endereco->setIdtipoendereco( Util::getParameter('id_tipoendereco') );
            $endereco->setIduf( $uf->getOne( Util::getParameter('estado') )->iduf );
            $endereco->setBairro( Util::getParameter('bairro') );
            
            
            //Selecionar o ID do endereco com CPF da pessoa
            $idendereco = $endereco->getOne( $idcpf )->idendereco;
            //Realizar o UPDATE no endereco
            $endereco->Update($idendereco);
            
        }
        
    }
    
}
