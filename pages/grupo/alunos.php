<?php
require_once '../../config.php';
require_once '../../query.php';

$alunos = Query::pegarAlunos($_GET['idGrupo']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Alunos
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    Opções
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a class="ajax" href="#/grupo/relacionar-aluno/idGrupo/<?php echo $_REQUEST['idGrupo']; ?>">Add Aluno</a>
                    </li>
                    <li class="divider"></li>
                    <li><a class="ajax" href="#/grupo/listar">Listar grupos</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($alunos as $aluno) {
                        ?>
                        <tr>
                            <td><?php echo $aluno['nome']; ?></td>
                            <td><?php echo $aluno['email']; ?></td>
                            <td>
                                <a href="#/grupo/alunos/tipo/ativarAluno/idGrupo/<?php echo $_REQUEST['idGrupo'];?>/idAluno/<?php echo $aluno['idAluno'];?>/status/<?php echo $aluno['status'];?>" class="ajax-relacionar" title="<?php echo ($aula['status']) ? 'Clique para bloquear' : 'Clique para desbloquear'; ?>">
                                    <i class="fa <?php echo ($aluno['status']) ? 'fa-unlock' : 'fa-lock'; ?>  col-lg-1"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
<!-- javascrtipt da Página -->
<script src="js/grupo/grupo.js"></script>