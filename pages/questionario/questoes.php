<?php
require_once '../../config.php';
require_once '../../query.php';

$questoes = Query::pegarQuestoes($_GET['idQuestionario']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Questionário - Questões
        <div class="col-lg-6 pull-right">
            <a href="#/questionario/cad-questao" class="ajax btn btn-default col-lg-3 pull-right">+ Questões</a>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover imgTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($questoes as $questao) {
                        ?>
                        <tr>
                            <td><?php echo $questao['idQuestao']; ?></td>
                            <td><?php echo $questao['titulo']; ?></td>
                            <td>
                                <a href="#/questionario/edit-questao/idQuestao/<?php echo $questao['idQuestao'];?>" class="ajax"><i class="fa fa-edit fa-1x col-lg-1"></i></a>
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
<script src="js/questionario/questionario.js"></script>