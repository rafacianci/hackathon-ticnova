<?php
require_once '../../config.php';
require_once '../../query.php';

$slides = Query::pegarSlideImg($_GET['idSlide']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Slides - Imagens
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="form-control imgForm">
            <div class="panel-heading">
                <h4> Cadastrar Slide </h4>
            </div>
            <form method="POST">
                <div class="form-group">
                    <label>Url</label>
                    <input id="url" class="form-control" type="text" name="url">
                </div>
                <button type="submit" data-id="<?php echo $_GET['idSlide']; ?>" id="bt-cadastrar-imagens" data-type="cadastrarSlidesImg" class="btn btn-success ">Cadastrar</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table  table-bordered table-hover imgTable">
                <tbody>
                    <?php
                    foreach ($slides as $slide) {
                        ?>
                        <tr class="col-lg-3">
                            <td class="col-lg-12"><img src="<?php echo $slide['url']; ?>" /></td>
                            <td>
                                <a data-msg="Você realmente quer deletar esta foto?" href="#/slides/cadastrarImg/idImg/<?php echo $slide['idImg']; ?>/tipo/excluirImg/idSlide/<?php echo $_GET['idSlide']; ?>" class="ajax-confirm"><i class="fa fa-trash-o fa-1x col-lg-1"></i></a>
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
<script src="js/slides/slides.js"></script>