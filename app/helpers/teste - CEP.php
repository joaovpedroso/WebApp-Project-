<label>CEP</label>
<input type="text" name="cep" id="cep" onchange="pesquisaCep(this.value)">

<label>Endereco</label>
<input type="text" name="endereco" id="logradouro">


<link href="../css/bootstrap.min.css" rel="stylesheet">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>


<script type="text/javascript">
    function pesquisaCep(cep){
        console.log('Cep -> '+cep);
        
    }
</script>