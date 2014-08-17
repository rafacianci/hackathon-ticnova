<?php
require_once '../../config.php';
require_once '../../query.php';

if ($_GET['idSlide']) {
    $slide = Query::pegarSlide($_GET['idSlide']);
}
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Editar Vídeo
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form method="POST">
            <input id="idVideo" name="idVideo" type="hidden" value="<?php echo $_REQUEST['idVideo']; ?>" >
            <div class="form-group col-lg-6">
                <label>Título</label>
                <input id="titulo" name="titulo" class="form-control" type="text" value="<?php echo $video["titulo"]; ?>">
            </div>
            <div class="form-group col-lg-6">
                <label>Url</label>
                <input id="url" name="url" class="form-control" type="text" value="<?php echo $video["url"]; ?>">
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-editar-videos" data-type="editarVideos" class="btn btn-success">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/videos/videos.js"></script>