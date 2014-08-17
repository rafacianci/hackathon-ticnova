<?php
require_once '../../config.php';
require_once '../../query.php';

$slides = Query::pegarSlides($_SESSION['user']['id']);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        Slides
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
                    foreach ($slides as $slide) {
                        ?>
                        <tr>
                            <td><?php echo $slide['idSlide']; ?></td>
                            <td><?php echo $slide['titulo']; ?></td>
                            <td>
                                <a href="#/slides/editar/idSlide/<?php echo $slide['idSlide'];?>" class="ajax"><i class="fa fa-edit fa-1x col-lg-1"></i></a>
                                <a href="#/slides/cadastrarImg/idSlide/<?php echo $slide['idSlide'];?>" class="ajax"><i class="fa fa-image fa-1x col-lg-1"></i></a>
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
<script src="js/videos/videos.js"></script>