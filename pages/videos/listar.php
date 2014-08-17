<?php
require_once '../../config.php';
require_once '../../query.php';

$videos = Query::pegarVideos($_SESSION['user']['id']);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        Vídeos
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>URL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($videos as $video) {
                        ?>
                        <tr>
                            <td><?php echo $video['idVideo']; ?></td>
                            <td><?php echo $video['titulo']; ?></td>
                            <td><?php echo $video['url']; ?></td>
                            <td>
                                <a href="#/videos/editar/idVideo/<?php echo $video['idVideo'];?>" class="ajax"><i class="fa fa-edit fa-1x col-lg-1"></i></a>
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