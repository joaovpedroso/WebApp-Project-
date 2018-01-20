<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Aplicação Web</title>
        
        <link href="../../public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../public/assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../../public/assets/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../../public/assets/css/apprise.min.css" rel="stylesheet">
        <link href="../../public/assets/css/style.css" rel="stylesheet">
        
        <script src="../../public/assets/bootstrap/js/jquery.min.js"></script>
        <sriptt src="../../public/assets/bootstrap/js/bootstrap.min.js"></sriptt>
        <script src="../../public/assets/js/jquery.dataTables.min.js"></script>
        <script src="../../public/assets/js/jquery.maskedinput.js"></script>
        <script src="../../public/assets/js/apprise.min.js"></script>
        <script src="../../public/assets/js/jqBootstrapValidation.js"></script>
    </head>
</html>

<script type="text/javascript">
    //Apricar função javascript que verifica se os campos estao preenchidos
    $(function () { 
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
    });
    
    //Validar se email está no formato correto
    function validarEmail(email){
        if( email == null || email == "" ) {
            apprise('Informe um Email', {animated:true});
        } else {
            $.ajax({
                type: 'post',
                url: "../helpers/Call.php",
                data: {email : email}
            }).done(function(msg){
                
                if( msg !== "" ){
                    apprise(msg, {animated:true});
                    $("#email").val("");
                }
                
            });
        }
        
    };
    
    //Validar Data de Nascimento
    function validarData(data){
        if( data == null || data == ""){
            apprise('Informe uma Data Válida', {animated:true});
            $("#datadenascimento").val("");
        } else {
            //console.log('Data Informada '+data);
            $.ajax({
                type: 'post',
                url: "../helpers/Call.php",
                data: {data : data}
            }).done(function(msg){
                
                if( msg !== "" ){
                    apprise(msg, {animated:true});
                    $("#datadenascimento").val("");
                    //console.log('Limpar data nascimento');
                }
                
            });
        }
    }
    
    function buscarCep(cep){
        if( cep == null || cep == "" || cep == "_____-___"){
            apprise('Informe um Cep', {animated:true});
            $("#cep").val("");
        } else {
            //console.log('Cep Informado '+cep);
            $.ajax({
                type: 'post',
                url: "../helpers/Call.php",
                data: {cep : cep}
            }).done(function(msg){
                
                if( msg == "{}" || msg == ""){
                    apprise('Cep Não Encontrado', {animated:true});
                    $("#cep").val("");
                } else {
                    var uf          = msg.estado;
                    if( uf == null ) {
                        apprise('Cep Não Encontrado', {animated:true});
                        $("#cep").val("");                        
                    } else {
                        var estado      = msg.estado;
                        var id_cidade   = msg.ibge;
                        var cidade      = msg.cidade;
                        var bairro      = msg.bairro;
                        var logradouro  = msg.logradouro;

                        $('#estado').val(estado);
                        $('#id_cidade').val(id_cidade);
                        $('#cidade').val(cidade);
                        $('#bairro').val(bairro);
                        $('#endereco').val(logradouro);
                        //apprise(msg.cidade, {animated:true});
                    }
                }
                
            });
        }
    }
    
    function verificaCpf(cpf){
        //Verifica se o valor passado é vazio ou contem somente a mascara
        if( cpf == null | cpf == "___.___.___-__" ){
            //Mostra mensagem
            apprise('Informe um CPF', {animated:true} );
            //Limpa o campo ID cpf
            $("#cpf").val('');
        //Caso nao seja vazio 
        } else {
            //Chama função ajax, passando atributo por post, chamando a pagina, com os atributos {nome do campo:valor}
            $.ajax({
                type: 'post',
                url: "../helpers/Call.php",
                data: {cpf:cpf}
            //Caso de certo a função
            }).done (function(msg){
                //Verifica se o retorno não foi vazio
                if( msg !== "" ){
                    //Caso tenha algo mostra mensagem de cpf em uso e mostra o nome do usuário que foi
                    //retornado da função verificaCpf na classe UTIL
                    apprise('CPF em uso pelo usuário: '+msg);
                    //Limpa o campo para que seja informado novo CPF
                    $("#cpf").val('');
                }
                
                
            })
            
        }
    };
    
    function loadModal(idtiposexo, descricao){
        $('#idtiposexo_modal').val(idtiposexo);
        $('#descricao_modal').val(descricao);
    }
    
    $(document).ready(function(){        
        //Aplicar Mascaras ao carregar a página
        $("#cep").mask('99999-999');
        $("#telefone").mask('(99) 9999-9999');
        $("#celular").mask('(99) 9999-9999?9');
        $("#cpf").mask('999.999.999-99');
    })
</script>