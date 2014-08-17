<?php
require_once '../../config.php';
require_once '../../query.php';

    $quest = Query::pegarQuestionario($_GET['idQuestionario']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Editar Questionário
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form method="POST">
            <input id="idQuestionario" name="idQuestionario" type="hidden" value="<?php echo $_REQUEST['idQuestionario']; ?>" >
            <div class="form-group col-lg-6">
                <label>Título</label>
                <input id="titulo" name="titulo" class="form-control" type="text" value="<?php echo $quest[0]["titulo"]; ?>">
            </div>

        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-editar-questionario" data-type="editarQuestionario" class="btn btn-success">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/questionario/questionario.js"></script>