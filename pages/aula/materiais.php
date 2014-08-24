<?php
require_once '../../config.php';
require_once '../../query.php';

$materiais = Query::pegarMateriais($_GET['idAula']);
//print_r($materiais);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Materiais
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    Opções
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a class="ajax" href="#/aula/relacionar/cdTipo/1/idAula/<?php echo $_REQUEST['idAula']; ?>">Add Questionário</a>
                    </li>
                    <li><a class="ajax" href="#/aula/relacionar/cdTipo/2/idAula/<?php echo $_REQUEST['idAula']; ?>">Add Slide</a>
                    </li>
                    <li><a class="ajax" href="#/aula/relacionar/cdTipo/3/idAula/<?php echo $_REQUEST['idAula']; ?>">Add Vídeo</a>
                    </li>
                    <li><a class="ajax" href="#/aula/relacionar/cdTipo/4/idAula/<?php echo $_REQUEST['idAula']; ?>">Add Quiz</a>
                    </li>
                    <li class="divider"></li>
                    <li><a class="ajax" href="#/aula/listar">Listar aulas</a>
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
                        <th>Título</th>
                        <th>Tipo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($materiais as $material) {
                        ?>
                        <tr>
                            <td><?php echo $material['m' . $material['tipo'] . '_titulo']; ?></td>
                            <td><?php echo getTipoMaterial($material['tipo']); ?></td>
                            <td>
                                <a href="#/aula/materiais/tipo/ativarMaterial/idAula/<?php echo $material['idAula']; ?>/idMaterial/<?php echo $material['idMaterial'];?>/idTipo/<?php echo $material['tipo']; ?>/status/<?php echo $material['a_status'];?>"
                                   class="ajax-relacionar" title="<?php echo ($material['a_status']) ? 'Clique para bloquear' : 'Clique para desbloquear'; ?>">
                                    <i class="fa <?php echo ($material['a_status']) ? 'fa-unlock' : 'fa-lock'; ?>  col-lg-1"></i>
                                </a>
                                <a data-msg="Você realmente deseja exluir este material?" href="#/aula/materiais/tipo/deletarRelacionamento/idAula/<?php echo $material['idAula']; ?>/idMaterial/<?php echo $material['idMaterial']; ?>/idTipo/<?php echo $material['tipo']; ?>" class="ajax-confirm"><i class="fa fa-unlink col-lg-1"></i></a>
                                <?php
                                if ($material['tipo'] == MATERIAL_QUESTIONARIO) {
                                    ?> 
                                    <a class="ajax" href="#/aula/respostas/idQuestionario/<?php echo $material['idMaterial'] ?>/idAula/<?php echo $material['idAula']; ?>"><i class="fa fa-list col-lg-1"></i></a> 
                                        <?php
                                    }
                                ?>
                                <?php
                                if ($material['tipo'] == MATERIAL_QUIZ) {
                                    ?> 
                                    <a class="ajax" href="#/aula/respostas/idQuiz/<?php echo $material['idMaterial'] ?>/idAula/<?php echo $material['idAula']; ?>"><i class="fa fa-question-circle col-lg-1"></i></a> 
                                        <?php
                                    }
                                ?>
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
<script src="js/aula/aula.js"></script>