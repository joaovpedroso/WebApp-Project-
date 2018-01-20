<?php
    include "Menu.php";
    require_once "../models/Situacao.php";
    require_once "../models/TipoEndereco.php";
    require_once "../models/TipoSexo.php";
    require_once "../controllers/PessoaController.php";

    
    //Instanciar os Objetos para realizar os Selects
    $situacao           = new Situacao();
    $tipoendereco       = new TipoEndereco();
    $tiposexo           = new TipoSexo();
?>
<div class="container">
    
    <form method="post" class="form" novalidate action="../controllers/PessoaController.php">
        
        <legend>Cadastro de Usuário</legend>
        
        <div class="control-group">
           <label class="control-label">Nome</label>
           <div class="controls">
               <input type="text" name="nome" class="form-control" placeholder="Informe Seu Nome" required
                   data-validation-required-message="Informe seu Nome">
           </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="control-group">
                    <label class="control-label">Email</label>
                    <div class="controls">
                        <input type="email" name="email" id="email" class="form-control" onblur="validarEmail(this.value)" placeholder="exemplo@exemplo.com" required
                               data-validation-email-message="Email Incorreto"
                               data-validation-required-message="Informe seu Email">
                    </div>
                </div>
            </div>    

            <div class="col-md-3">
                <div class="control-group">
                    <label class="control-label">Senha</label>
                    <div class="controls">
                        <input type="password" name="senha" id="senha" class="form-control" required 
                        maxlength="12"
                        data-validation-maxlength-message="Máximo 12 Caracteres" 
                        data-validation-required-message="Informe uma Senha">
                    </div>
                </div>
            </div>  

            <div class="col-md-3">
                <div class="control-group">
                    <label class="control-label">Re-Digite a Senha</label>
                    <div class="controls">
                        <input type="password" name="senha" class="form-control"  required
                               maxlength="12"
                               data-validation-maxlength-message="Máximo 12 Caracteres" 
                               data-validation-required-message="Informe uma Senha"
                               data-validation-match-match="senha"
                               data-validation-match-message="As senhas Digitadas São Diferentes">
                    </div>
                </div>
            </div>  

        </div><!-- Final ROW -->

        <div class="row">
            <div class="col-md-6">
                <div class="control-group">
                    <label class="control-label">CPF</label>
                    <div class="controls">
                        <input type="text" name="cpf" id="cpf" class="form-control" onblur="verificaCpf(this.value)" required
                               data-validation-required-message="Informe seu CPF" maxlength="14"
                               data-validation-maxlength-message="Informe no Máximo 11 Caracteres">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="control-group">
                    <label class="control-label">RG</label>
                    <div class="controls">
                        <input type="text" name="rg" class="form-control" required
                            data-validation-required-message="Informe seu RG">
                    </div>
                </div>
            </div>

        </div><!-- Final ROW -->

        <div class="row">
            <div class="col-md-3">
                <div class="control-group">
                    <label class="control-label">Data de Nascimento</label>
                    <div class="controls">
                        <input type="date" name="datadenascimento" id="datadenascimento" class="form-control" onblur="validarData(this.value)" required
                            data-validation-required-message="Informe sua Data de Nascimento">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="control-group">
                    <label class="control-label">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control" required
                            data-validation-required-message="Selecione">
                        <option value="">Selecione</option>
                        <?php
                            $dados = $tiposexo->getAll($tiposexo->getTable());
                            //SELECIONAR OPÇÔES DO BANCO DE DADOS
                            foreach( $dados as $dado){
                                echo "<option value=".$dado->idtiposexo.">$dado->descricao</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div><!-- Final ROW -->
        
        <div class="row">

            <div class="col-md-2">
                <div class="control-group">
                    <label class="control-label">CEP</label>
                    <div class="controls">
                        <input type="text" name="cep" id="cep" class="form-control" onblur="buscarCep(this.value)" required
                            data-validation-required-message="Informe seu CEP">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="control-group">
                    <label class="control-label">Endereço</label>
                    <div class="controls">
                        <input type="text" name="endereco" id="endereco" class="form-control" required
                            data-validation-required-message="Informe seu Endereço">
                    </div>
                </div>
            </div>
             
            <div class="col-md-2">
                <div class="control-group">
                    <label class="control-label">Tipo de Endereço</label>
                    <select name="id_tipoendereco" id="id_tipoendereco" class="form-control" required
                            data-validation-required-message="Selecione">
                        <option value="">Selecione</option>
                        <?php

                            //SELECIONAR OPÇÔES DO BANCO DE DADOS na função GetALL da classe MODEL
                            $dados = $tipoendereco->getAll($tipoendereco->getTable());
                            
                            foreach( $dados as $dado){
                                echo "<option value=".$dado->idtipoendereco.">$dado->descricao</option>";
                            }

                        ?>
                    </select>
                </div>
            </div>
            
            <div class="col-md-2">
                 <div class="control-group">
                    <label class="control-label">Numero</label>
                    <div class="controls">
                        <input type="text" name="numero" id="numero" class="form-control" required
                            data-validation-required-message="Informe o Numero">
                    </div>
                </div>
            </div>

        </div><!-- Final ROW -->

        <div class="row">
            <div class="col-md-3">
                <div class="control-group">
                    <label class="control-label">Bairro</label>
                    <div class="controls">
                        <input type="text" name="bairro" id="bairro" class="form-control" required
                            data-validation-required-message="Informe o Bairro" readonly>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="control-group">
                    <label class="control-label">Complemento</label>
                    <div class="controls">
                        <input type="text" name="complemento" id="complemento" class="form-control" placeholder="Ponto de Referencia">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="control-group">
                    <label class="control-label">Estado</label>
                    <input type="text" name="estado" id="estado" class="form-control" readonly>
                </div>
            </div>

            <div class="col-md-3">
                <div class="control-group">
                    <label class="control-label">Cidade</label>
                    <div class="controls">
                        <input type="text" name="cidade" id="cidade" class="form-control" readonly>
                        <input type="hidden" name="id_cidade" id="id_cidade" class="form-control">
                    </div>
                </div>
            </div>
        </div><!-- Final ROW -->

        <div class="row">

            <div class="col-md-2">
                <div class="control-group">
                    <label class="control-label">Telefone</label>
                    <div class="controls">
                        <input type="text" name="telefone" id="telefone" class="form-control" required 
                               data-validation-required-message="Informe seu Telefone">
                    </div>
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="control-group">
                    <label class="control-label">Ramal</label>
                    <div class="controls">
                        <input type="text" name="ramal" id="ramal" class="form-control" placeholder="Ramal">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="control-group">
                    <label class="control-label">Celular</label>
                    <div class="controls">
                        <input type="text" name="celular" id="celular" class="form-control" required 
                               data-validation-required-message="Informe seu Celular">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="control-group">
                    <label class="control-label">Status</label>
                    <select name="status" id="status" class="form-control" required
                            data-validation-required-message="Selecione">
                        <option value="">Selecione</option>
                        <?php

                            //SELECIONAR OPÇÔES DO BANCO DE DADOS e marcar a que retornar no JS
                            $status = $situacao->getAll( $situacao->getTable() );
                            foreach( $status as $st){
                                echo "<option value=".$st->idsituacao.">$st->descricao</option>";
                            }

                        ?>
                    </select>
                </div>
            </div>
        </div><!-- Final ROW -->
        <br>
        <button type="submit" name="salvar" class="  btn-warning pull-right">
            <i class="glyphicon glyphicon-floppy-save"></i>
                Salvar 
        </button>
        <button type="reset" class=" btn-danger pull-right">
            <i class="glyphicon glyphicon-erase"></i>
             Limpar
        </button>
    </form>
</div>
<script type="text/javascript">
    //Script q vai preencher os campos de SELECT quando for editar
    $("#sexo").val('');
    $("#uf").val('');
    $("#status").val('');
</script>