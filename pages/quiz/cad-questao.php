<?php
require_once '../../config.php';
require_once '../../query.php';
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Cadastrar - Questão
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <div class="panel-body">
                <form method="POST" id="cadQuestaoquiz">
                    <input type="hidden" value="<?php echo $_GET['idQuiz']; ?>" name="idQuiz" />
                    <div class="form-group col-lg-12">
                        <label>Questão</label>
                        <textarea name="titulo" tabindex="1" class="form-control col-xs-12" required="required"></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-xs-11">Alternativas</label>
                        <label class="col-xs-1">Correta</label>
                        <div class="form-group col-lg-12">
                            <span class="col-xs-11">
                                <input id="alternativa1" data-id="1" tabindex="2" name="alternativa1" class="form-control" type="text" value="" required>
                            </span>
                            <label class="radio col-xs-1">
                                <input type="radio" name="correta" tabindex="5" id="correta" value="1" required>
                            </label>
                        </div>
                        <div class="form-group col-lg-12">
                            <span class="col-xs-11">
                                <input id="alternativa2" data-id="2" tabindex="3" name="alternativa2" class="form-control" type="text" value="" required>
                            </span>
                            <label class="radio col-xs-1">
                                <input type="radio" name="correta" tabindex="5" id="correta" value="2" required>
                            </label>
                        </div>
                        <div class="form-group col-lg-12">
                            <span class="col-xs-11">
                                <input id="alternativa3" data-id="3" tabindex="4" name="alternativa3" class="form-control" type="text" value="" required>
                            </span>
                            <label class="radio col-xs-1">
                                <input type="radio" name="correta" tabindex="5" id="correta" value="3" required>
                            </label>
                        </div>
                    </div>
                    <button type="submit" id="cadQuestaoquiz" tabindex="6" data-type="cadastrarQuestaquiz" class="btn btn-success">Salvar</button>
                </form>
            </div>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
<!-- javascrtipt da Página -->
<script src="js/quiz/quiz.js"></script>