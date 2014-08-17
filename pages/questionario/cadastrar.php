<?php
require_once '../../config.php';
require_once '../../query.php';

?>
<div class="panel panel-default">
    <div class="panel-heading">
        Cadastrar Slide
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form method="POST">
            <div class="form-group col-lg-6">
                <label>Título</label>
                <input id="titulo" name="titulo" class="form-control" type="text" value="">
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-cadastrar-slides" data-type="cadastrarSlides" class="btn btn-success">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/slides/slides.js"></script>