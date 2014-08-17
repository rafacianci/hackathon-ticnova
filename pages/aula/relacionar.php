<?php
require_once '../../config.php';
require_once '../../query.php';

    $relacionar = Query::pegarRelacionados($_GET['idAula'], $_GET['cdTipo']);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        Relacionar <?php echo getTipoMaterial($_GET['cdTipo']); ?>
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($relacionar as $material) {
                        ?>
                        <tr>
                            <td><?php echo $material['titulo']; ?></td>
                            <td>
                                <a href="#/aula/materiais/tipo/relacionarArquivo/idAula/<?php echo $_REQUEST['idAula'];?>/idMaterial/<?php echo $material['id'];?>/idTipo/<?php echo $_REQUEST['cdTipo'];?>" class="ajax-relacionar"><i class="fa fa-check col-lg-1"></i></a>
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