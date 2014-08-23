<?php
require_once '../../config.php';
require_once '../../query.php';

    $relacionar = Query::pegarAulasRelacionadas($_GET['idGrupo'], $_SESSION['user']['id']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Relacionar Aulas
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
                    foreach ($relacionar as $aula) {
                        ?>
                        <tr>
                            <td><?php echo dateView($aula['data']); ?></td>
                            <td><?php echo $aula['titulo']; ?></td>
                            <td>
                                <a href="#/grupo/aulas/tipo/relacionarAulas/idGrupo/<?php echo $_REQUEST['idGrupo'];?>/idAula/<?php echo $aula['idAula'];?>" class="ajax-relacionar"><i class="fa fa-check col-lg-1"></i></a>
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