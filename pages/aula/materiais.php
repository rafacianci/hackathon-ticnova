<?php
require_once '../../config.php';
require_once '../../query.php';

    $materiais = Query::pegarMateriais($_GET['idAula']);
        
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Materiais
        <div class="col-lg-6 pull-right">
            <a href="#" class="btn-default col-lg-4">+ Questionário</a>
            <a href="#" class="btn-default col-lg-4">+ Slide</a>
            <a href="#" class="btn-default col-lg-4">+ Vídeos</a>
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
                            <td><?php echo $material['m'.$material['tipo'].'_titulo']; ?></td>
                            <td><?php echo getTipoMaterial($material['tipo']); ?></td>
                            <td>
                                <a href="#/aula/materiais/idAula/<?php echo $aula['idAula'];?>" class="ajax-modal"><i class="fa fa-unlink col-lg-1"></i></a>
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