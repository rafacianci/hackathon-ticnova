<?php
require_once '../../config.php';
require_once '../../query.php';

if ($_GET['idSlide']) {
    $slide = Query::pegarSlide($_GET['idSlide']);
}
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Editar Slides
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form method="POST">
            <input id="idSlide" name="idSlide" type="hidden" value="<?php echo $_REQUEST['idSlide']; ?>" >
            <div class="form-group col-lg-12">
                <label>Título</label>
                <input id="titulo" name="titulo" class="form-control" type="text" value="<?php echo $slide["titulo"]; ?>">
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-editar-slides" data-type="editarSlides" class="btn btn-success">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/slides/slides.js"></script>