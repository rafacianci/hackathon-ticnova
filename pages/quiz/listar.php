<?php
require_once '../../config.php';
require_once '../../query.php';

$quiz = Query::pegarQuiz($_SESSION['user']['id']);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        Quiz
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Tempo limite</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($quiz as $q) {
                        ?>
                        <tr>
                            <td><?php echo $q['idQuiz']; ?></td>
                            <td><?php echo $q['titulo']; ?></td>
                            <td><?php echo getTipoQuiz($q['tipo']); ?></td>
                            <td><?php echo $q['tempo']; ?></td>
                            <td>
                                <a href="#/quiz/questoes/idQuiz/<?php echo $q['idQuiz'];?>" class="ajax"><i class="fa fa-plus-circle fa-1x col-lg-1"></i></a>
                                <a href="#/quiz/editar/idQuiz/<?php echo $q['idQuiz'];?>" class="ajax"><i class="fa fa-edit fa-1x col-lg-1"></i></a>
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
<script src="js/quiz/quiz.js"></script>