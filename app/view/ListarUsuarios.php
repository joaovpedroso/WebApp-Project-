<?php
    include "menu.php";
    require_once '../models/Model.php';
    $model = new Model();
?>

<div class="container">
    <div class="table-responsive ">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td class="text-center" width="10em">ID</td>
                    <td width="400em">Nome</td>
                    <td width="200em" class="text-center">Data de Nascimento</td>
                    <td>Email</td>
                    <td width="3em">Status</td>
                    <td class="text-center" width="280em">Ações</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach( $model->selectAllDados() as $dados => $value ){ 
                        //print $dados." - ".$value->idcpf; ?>
                    <tr>
                        <td><?= $value->idcpf;?></td>
                        <td><?= $value->nome;?></td>
                        <td class="text-center"><?= $value->datadenascimento;?></td>
                        <td><?= $value->email;?></td>
                        <td><?= $value->descricao;?></td>
                        <td>
                            <div class="col-md-4">
                                <form action="UpdateUsuario.php" method="POST">
                                    <input type="hidden" name="idcpf" value="<?=$value->idcpf;?>">
                                    <button type="submit" name="update" class="btn btn-primary" title="Editar" alt="Editar">
                                        <i class="glyphicon glyphicon-edit"></i> Editar 
                                    </button>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <form action="../controllers/PessoaController.php" method="POST">
                                    <input type="hidden" name="idcpf" value="<?=$value->idcpf;?>">
                                    <button type="submit" name="delete" class="btn btn-danger" title="Excluir" alt="Excluir">
                                        <i class="glyphicon glyphicon-erase"></i> Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php    
                    }
                ?>   
            </tbody>    
        </table>
    </div>
</div>