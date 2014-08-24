<?php
require_once '../../config.php';
require_once '../../query.php';

    $quiz = Query::pegarQuizes($_GET['idQuiz']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Editar Quiz
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form method="POST">
            <input id="idQuiz" name="idQuiz" type="hidden" value="<?php echo $_REQUEST['idQuiz']; ?>" >
            <div class="form-group col-lg-6">
                <label>Título</label>
                <input id="titulo" name="titulo" class="form-control" type="text" value="<?php echo $quiz['titulo']; ?>">
            </div>
            <div class="form-group col-lg-12">
                <label>Tipo</label>
                <select class="form-control" name="tipoQuiz" id="tipoQuiz" tabindex="2">
                    <option value="1" <?php echo ($quiz['tipo'] == 1) ? "selected" : ""; ?>><?php echo getTipoQuiz(1); ?></option>
                    <option value="2" <?php echo ($quiz['tipo'] == 2) ? "selected" : ""; ?>><?php echo getTipoQuiz(2); ?></option>
                    <option value="3" <?php echo ($quiz['tipo'] == 3) ? "selected" : ""; ?>><?php echo getTipoQuiz(3); ?></option>
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label>Tempo em segundos</label>
                <input id="tempo" tabindex="3" name="tempo" class="form-control" type="number" value="<?php echo $quiz['tempo']; ?>" required>
                <p class="help-block">Tempo mínimo para responder um quiz</p>
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-editar-quiz" data-type="editarQuiz" class="btn btn-success">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/quiz/quiz.js"></script>