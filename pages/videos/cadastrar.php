<?php
require_once '../../config.php';
require_once '../../query.php';

?>
<div class="panel panel-default">
    <div class="panel-heading">
        Cadastrar Vídeo
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form method="POST">
            <div class="form-group col-lg-6">
                <label>Título</label>
                <input id="titulo" name="titulo" class="form-control" type="text" value="">
            </div>
            <div class="form-group col-lg-6">
                <label>Url</label>
                <input id="url" name="url" class="form-control" type="text" value="">
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-cadastrar-videos" data-type="cadastrarVideos" class="btn btn-success">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/videos/videos.js"></script>