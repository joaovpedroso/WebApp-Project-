<?php
include "../view/Menu.php";
require_once "../models/Cidade.php";
require_once "../models/Endereco.php";
require_once "../models/Estado.php";
require_once "../models/Model.php";
require_once "../models/Situacao.php";
require_once "../models/Telefone.php";
require_once "../models/TipoEndereco.php";
require_once "../models/TipoSexo.php";
require_once "../models/TipoTelefone.php";
require_once "../models/Uf.php";
require_once "../models/Usuario.php";
require_once "../controllers/UsuarioController.php";
require_once "../controllers/UfController.php";
require_once "../controllers/EstadoController.php";
require_once "../controllers/CidadeController.php";
require_once "../controllers/EnderecoController.php";
require_once "../controllers/TelefoneController.php";

class PessoaController {
    
    public function __construct() {
        PessoaController::save();
    }
    
    public static function save(){
        //Instancia novo obj da classe PESSOA
        $pessoa         = new Pessoa();
        
        //Verificar se foi enviado dados do formulario
        if( isset( $_POST["salvar"] ) ){
            $pdo            = Conecta::getPdo();
        
            try{
                $pdo    ->beginTransaction();
                //Inserir Nova Pessoa
                $pessoa->setNome( Util::getParameter('nome') );
                //print Util::getParameter('nome');
                $pessoa->setCpf( Util::getParameter('cpf') );
                $pessoa->setDatadenascimento( Util::getParameter('datadenascimento') );
                $pessoa->setIdCpf( Util::idCpf( $pessoa->getCpf() ) );
                $pessoa->setIdsituacao( Util::getParameter('status') );
                $pessoa->setIdtiposexo( Util::getParameter('sexo') );
                $pessoa->setRg( Util::getParameter('rg') );
                $pessoa->Insert();

                /*Chamar o método SAVE da classe UsuarioController, onde realizara 
                 * atribuiçoes dos valores e inseção no banco de dados Usuario*/
                UsuarioController::save($pessoa);
                //Chamada dos metodos saves das Classes Controllers
                UfController::save();
                EstadoController::save();
                CidadeController::save();
                EnderecoController::save( $pessoa->getIdCpf() );
                TelefoneController::save( $pessoa->getIdCpf() );

                if( $pdo->commit() ){
                    print('<script>apprise("Salvo Com Sucesso");location.href="../view/ListarUsuarios.php";</script>');
                    
                }
            } catch (PDOException $e){
                print( "ERRO ao salvar dados". $e->getMessage() );
                $pdo->rollBack();

            }
            
        }else if( isset( $_POST["update"] ) ){
            $pdo            = Conecta::getPdo();
        
            try{
                $pdo    ->beginTransaction();
                //Inserir Nova Pessoa
                $pessoa->setNome( Util::getParameter('nome') );
                //print Util::getParameter('nome');
                $pessoa->setCpf( Util::getParameter('cpf') );
                $pessoa->setDatadenascimento( Util::getParameter('datadenascimento') );
                $pessoa->setIdCpf( Util::idCpf( $pessoa->getCpf() ) );
                $pessoa->setIdsituacao( Util::getParameter('status') );
                $pessoa->setIdtiposexo( Util::getParameter('sexo') );
                $pessoa->setRg( Util::getParameter('rg') );
                $pessoa->Update( $pessoa->getIdCpf() );
                
                /*Chamar o método SAVE da classe UsuarioController, onde realizara 
                 * atribuiçoes dos valores e inseção no banco de dados Usuario*/
                UsuarioController::save($pessoa);
                //Chamada dos metodos saves das Classes Controllers
                UfController::save();
                EstadoController::save();
                CidadeController::save();
                EnderecoController::save( $pessoa->getIdCpf() );
                TelefoneController::save( $pessoa->getIdCpf() );
                
               if( $pdo->commit() ){
                    print('<script>location.href="../view/ListarUsuarios.php";</script>');
               }
            } catch (PDOException $ex) {
                die( "ERRO ao salvar dados". $ex->getMessage() );
                $pdo->rollBack();
            }
        } else if( isset( $_POST["delete"] ) ){
            $pdo            = Conecta::getPdo();
            
            try{
                
                $pdo->beginTransaction();
                
                $pessoa->setIdCpf( Util::getParameter('idcpf') );
                $pessoa->Delete();
                
                UsuarioController::save($pessoa);
                
                if( $pdo->commit() ){
                    print('<script>location.href="../view/ListarUsuarios.php";</script>');
                }
                
            } catch (PDOException $ex) {
                
                die( "ERRO ao salvar dados". $e->getMessage() );
                $pdo->rollBack();
                
            }
        }
    }  
    
}
/*/*Chama o método estatico save da classe PessoaController - Onde realizará
 *     o recebimento das informações e fara as devidas atribuições aos atributos
 * das classes e inserções no banco de dados.
 */
$pessoaController = new PessoaController();