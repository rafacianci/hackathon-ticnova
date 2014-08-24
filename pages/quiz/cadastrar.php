<?php
require_once '../../config.php';
require_once '../../query.php';
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Cadastrar Quiz
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form method="POST">
            <div class="form-group col-lg-12">
                <label>Título</label>
                <input id="titulo" name="titulo" class="form-control" type="text" value="" tabindex="1">
            </div>
            <div class="form-group col-lg-12">
                <label>Tipo</label>
                <select class="form-control" name="tipoQuiz" id="tipoQuiz" tabindex="2">
                    <option value="1"><?php echo getTipoQuiz(1); ?></option>
                    <option value="2"><?php echo getTipoQuiz(2); ?></option>
                    <option value="3"><?php echo getTipoQuiz(3); ?></option>
                </select>
            </div>
            <div class="form-group col-lg-12">
                <label>Tempo em segundos</label>
                <input id="tempo" tabindex="3" name="tempo" class="form-control" type="number" value="" required>
                <p class="help-block">Tempo mínimo para responder um quiz</p>
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-cadastrar-quiz" data-type="cadastrarQuiz" class="btn btn-success" tabindex="4">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/quiz/quiz.js"></script>