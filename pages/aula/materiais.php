<?php
require_once '../../config.php';
require_once '../../query.php';

$materiais = Query::pegarMateriais($_GET['idAula']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Materiais
        <div class="col-lg-6 pull-right">
            <a href="#/aula/relacionar/cdTipo/1/idAula/<?php echo $_REQUEST['idAula']; ?>" class="ajax btn btn-default col-lg-3 col-lg-offset-1">+ Questionário</a>
            <a href="#/aula/relacionar/cdTipo/2/idAula/<?php echo $_REQUEST['idAula']; ?>" class="ajax btn btn-default col-lg-3 col-lg-offset-1">+ Slide</a>
            <a href="#/aula/relacionar/cdTipo/3/idAula/<?php echo $_REQUEST['idAula']; ?>" class="ajax btn btn-default col-lg-3 col-lg-offset-1">+ Vídeos</a>
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
                                <a data-msg="Você realmente deseja exluir este material?" href="#/aula/materiais/tipo/deletarRelacionamento/idAula/<?php echo $material['idAula']; ?>/idMaterial/<?php echo $material['idMaterial']; ?>/idTipo/<?php echo $material['tipo']; ?>" class="ajax-confirm"><i class="fa fa-unlink col-lg-1"></i></a>
                                <?php
                                if ($material['tipo'] == MATERIAL_QUESTIONARIO) {
                                    ?> 
                                    <a class="ajax" href="#/aula/respostas/idQuestionario/<?php echo$material['idMaterial'] ?>/idAula/<?php echo $material['idAula']; ?>"><i class="fa fa-list col-lg-1"></i></a> 
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