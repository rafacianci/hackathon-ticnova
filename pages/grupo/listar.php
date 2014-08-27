<?php
require_once '../../config.php';
require_once '../../query.php';

$grupos = Query::pegarGrupos($_SESSION['user']['id']);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        Grupos
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
                    foreach ($grupos as $grupo) {
                        ?>
                        <tr>
                            <td><?php echo $grupo['idGrupo']; ?></td>
                            <td><?php echo $grupo['titulo']; ?></td>
                            <td>
                                <a href="#/grupo/alunos/idGrupo/<?php echo $grupo['idGrupo'];?>" title="Alunos" class="ajax"><i class="fa fa-group fa-1x col-lg-1"></i></a>
                                <a href="#/grupo/aulas/idGrupo/<?php echo $grupo['idGrupo'];?>" title="Aulas" class="ajax"><i class="fa fa-book fa-1x col-lg-1"></i></a>
                                <a href="#/grupo/editar/idGrupo/<?php echo $grupo['idGrupo'];?>" title="Editar" class="ajax"><i class="fa fa-edit fa-1x col-lg-1"></i></a>
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
<script src="js/grupo/grupo.js"></script>