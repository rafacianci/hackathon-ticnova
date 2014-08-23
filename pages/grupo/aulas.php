<?php
require_once '../../config.php';
require_once '../../query.php';

$aulas = Query::pegarAulasGrupo($_GET['idGrupo'], $_SESSION['user']['id']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Aulas
        <div class="col-lg-6 pull-right">
            <a href="#/grupo/relacionar/idGrupo/<?php echo $_REQUEST['idGrupo']; ?>" class="ajax btn btn-default col-lg-3 col-lg-offset-1">+ Aulas</a>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
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
                            <td><?php echo dateView($aula['data']); ?></td>
                            <td><?php echo $aula['titulo']; ?></td>
                            <td>
                                <a href="#/grupo/aulas/tipo/ativarAula/idGrupo/<?php echo $_REQUEST['idGrupo'];?>/idAula/<?php echo $aula['idAula'];?>/status/<?php echo $aula['status'];?>" class="ajax-relacionar"><i class="fa <?php echo ($aula['status']) ? 'fa-unlock' : 'fa-lock'; ?>  col-lg-1"></i></a>
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