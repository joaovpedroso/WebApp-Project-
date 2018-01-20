<?php
require_once "../Config/Conecta.php";
require_once '../models/Pessoa.php';
require_once '../models/Usuario.php';

class Util {
    
    public function dataAtual(){
        $data = new DateTime("now");
        return $data->format('d/m/Y');
    }
    
    static public function dataNowAmerican(){
        $data = new DateTime("now");
        return $data->format('Y/m/d');
    }
    
    public function formatarData($dataN){
        $date = new DateTime($dataN);
        return $date->format('d/m/Y');
    }
    
    public function retirarPonto($item){
        return str_replace(".", "", $item);
    }
    
    public function retirarHifen($item) {
         return str_replace("-", "", $item);
    }
    
    public function retirarVirgula($item) {
         return str_replace(",", "", $item);
    }
    
    public function formatarValor($valor){
        return number_format($valor, 2, ',','.');
    }
    
    public function md5Senha($senha){
        return $senha = md5($senha);
    }
    
    public function validarEmail($email){
        //Verifica se o formato de email está correto com o filtro do PHP FILTER_VALDATE_EMAIL
        if( filter_var($email, FILTER_VALIDATE_EMAIL ) ) {
            
            //Faz consulta no banco de dados para verificar se já esta cadastrado o email
            $pdo = Conecta::getPdo();
            //Inicializa a transação
            $pdo->beginTransaction();
            
            $sql        = "SELECT * FROM usuario WHERE email = ? LIMIT 1";
            $consulta   = $pdo->prepare($sql);
            $consulta   ->bindValue(1, $email);
            $consulta   ->execute();
            $resultado  = $consulta->rowCount();
            
            if( $resultado != 0 ) {
               //Se já houver email cadastrado
                return "Email Já Cadastrado";
            }else {
                 //Se Não existir Regristros retorna Vazio
                return "";
            }    
            
        } else {
            //Incorreto retorna Mensagem que será tratada no AJAX e printada com o Apprise
            return "Email Incorreto";
        }
    }
    
    public function validarDataNascimento($dataN){
        
        //Formatar a data de nascimento informada para Dia/Mes/Ano 
        $dataN  = new DateTime($dataN);
        $hoje   = new DateTime("now");
        $hoje   ->format('d/m/Y');
        
        //Criar um intervalo para verificar se nasceu a mais de 1 dia do atual
        $interval = $hoje->diff($dataN);
        //Retornar os dias de intervalo das datas
        $dias = $interval->format("%a");
        
        //Verifica se o intervalo é negativo ou == a 0
        if( $dias == 0 ){
            echo "Data Inválida";
        }else {
            if( $dataN > $hoje ) {
                echo "Dia Informado Maior que o Atual";
            }else {
                //Validar se o nascimento está a no minimo 130 anos atras
                $interval   = new DateInterval("P130Y");
                $hoje       ->sub($interval);
                //Se data informada for menor que 130 anos atras mostra mensagem
                if( $dataN < $hoje  ) {
                    echo 'Data Inválida, Período Não Aceito';
                    //Se não, tudo OK
                }else {
                    echo "";
                }
                
            }
        }
        
        
    }
    
    public function getCurl2(string $cep) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://viacep.com.br/ws/$cep/json/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $value = json_decode($result, true);

        if (!empty($value['erro'])) {
            return '{}';
        }

        $_value = [];
        $_value['bairro'] = $value['bairro'];
        $_value['cep'] = str_replace('-', '', $value['cep']);
        $_value['logradouro'] = $value['logradouro'];
        $_value['cidade'] = $value['localidade'];
        $_value['ibge'] = $value['ibge'];
        $_value['estado'] = $value['uf'];
        $_value['complemento'] = $value['complemento'];
        return json_encode($_value);
   }
    
   public function verificaCpf($cpf){
       //Concatena o cpf com o formato de iD do banoc
       $cpf = "1000$cpf";
       //Instancia novo obj da classe pessoa para utilizar o metod getOne - que selecionaraá os dados de uma unica pessoa
       $pessoa = new Pessoa();
       
       //Instancia novo obj da classe Usuario 
       $usuario = new Usuario;
       //Seta os dados na classe de Usuario passando o CPF formatado de acordo com o ID do Banco
       $usuario ->setIdCpf( $cpf );
       //Recebe na variavel CPF o valor do cpf formatado o qual foi setado na function setIdCpf
       $cpf     = $usuario->getIdCpf();
       
       //Atribui a variavel Consulta o resultado da pesquisa no metodo getOne da classe Pessoa
       $consulta = $pessoa->getOne($cpf);
       //Verifica se o retorno da consulta getOne foi vazio
       if( $consulta == null || $consulta == "" ) {         
            //Caso seja vazio retorna vazio para a Classe CALL, lembrando que o vazio vem do retorno do metodo getOne da classe PEssoa
            return "";
       } else {
            //Caso nao seja vazio retorna o nome do usuario ja cadastrado com o cpf informado
            return $pessoa->getOne($cpf)->nome;
       }
      
   }
   
    public static function removerEspaco($dado){
        return trim( $dado );
    }
    
    public static function idCpf($cpf){
        return "1000$cpf";
    }
    
    /*
     * Função responsavel por receber o conteudo do campo e remover seu espaço.
     *Para que isso ocorra a função precisa que um dado seja informado, o nome
     * do campo. Após isso ela chamara a funcao remover espaco que removera os
     * espaços iniciais antes do conteudo informado
     */
    public static function getParameter(string $campo){
        return Util::removerEspaco($_POST["$campo"]);
    }
    
    public static function separarDdd($telefone){
        
        $telefone = explode(")", $telefone);
        $dd = $telefone[0];
        
        $ddd = str_replace("(", "", $dd);

        $telefone = $telefone[1];
        $telefone = str_replace(")", "", $telefone);
        
        
        $tel = array(
            'ddd' =>$ddd,
            'telefone'=>$telefone
        );
        return $tel;
    }
    
}