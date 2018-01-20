<?php
    include "../view/Menu.php";
    require_once "../models/TipoEndereco.php";

class TipoEnderecoController {
    
    public function __construct() {
        TipoEnderecoController::save();
    }
    
    public static function save(){
        
        $tipoendereco = new TipoEndereco();
        
        //Verificar se foi enviado dados do formulario
        if( isset( $_POST["salvar"] ) ){
            $pdo            = Conecta::getPdo();
            
            try{
                $pdo->beginTransaction();
                //Receber do formulario ID caso seja passado
                $idtipoendereco = Util::getParameter('idtipoendereco');
                $tipoendereco->setDescricao( Util::getParameter('descricao') );
                
                if( empty( $idtipoendereco ) ){
                    $tipoendereco->Insert();
                } else {
                    $tipoendereco->Update($idtipoendereco);
                }
                
                if( $pdo->commit() ){
                    echo '<script>apprise("Dados Salvos"); location.href="../view/CadastrarTipoEndereco.php"</script>';
                }
            } catch (PDOException $ex) {
                print("ERRO ao salvar dados. ".$ex->getMessage()." - Linha: ".$ex->getLine() );
                $pdo->rollBack();
            }
            
        }
    }
    
}
$tipoendereco = new TipoEnderecoController();
