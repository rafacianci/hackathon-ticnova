<?php
require_once '../../config.php';
require_once '../../query.php';

$aulas = Query::pegarAulasGrupo($_GET['idGrupo'], $_SESSION['user']['id']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Aulas
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    Opções
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a class="ajax" href="#/grupo/relacionar/idGrupo/<?php echo $_REQUEST['idGrupo']; ?>">Add Aula</a>
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