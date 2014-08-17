<?php
require_once '../../config.php';
require_once '../../query.php';

$questionario = Query::pegarQuestionarios($_SESSION['user']['id']);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        Questionários
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($questionario as $slide) {
                        ?>
                        <tr>
                            <td><?php echo $slide['idQuestionario']; ?></td>
                            <td><?php echo $slide['titulo']; ?></td>
                            <td>
                                <a href="#/questionario/editar/idQuestionario/<?php echo $slide['idQuestionario'];?>" class="ajax"><i class="fa fa-edit fa-1x col-lg-1"></i></a>
                                <!--<a href="#/questionario/cadastrarImg/idSlide/<?php echo $slide['idSlide'];?>" class="ajax-relacionar"><i class="fa fa-file-text-o fa-1x col-lg-1"></i></a>-->
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