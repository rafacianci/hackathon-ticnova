<?php
require_once '../../config.php';
require_once '../../query.php';

$aulas = Query::pegarAulas($_SESSION['user']['id']);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        Aulas
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Data</th>
                        <th>Título</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($aulas as $aula) {
                        ?>
                        <tr>
                            <td><?php echo $aula['idAula']; ?></td>
                            <td><?php echo dateView($aula['data']); ?></td>
                            <td><?php echo $aula['titulo']; ?></td>
                            <td>
                                <a href="#/aula/materiais/idAula/<?php echo $aula['idAula'];?>" class="ajax"><i class="fa fa-paperclip fa-1x col-lg-1"></i></a>
                                <a href="#/aula/editar/idAula/<?php echo $aula['idAula'];?>" class="ajax"><i class="fa fa-edit fa-1x col-lg-1"></i></a>
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
