<?php
require_once '../../config.php';
require_once '../../query.php';

$alternativas = Query::pegarAlternativa($_GET['idQuestao']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Editar - Questão
        <div class="col-lg-6 pull-right">
            <a href="#/questionario/cad-questao/idQuestionario/<?php echo $_GET['idQuestionario']; ?>" class="ajax btn btn-default col-lg-3 pull-right">+ Questões</a>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <div class="panel-body">
                <form method="POST" id="editQuestao">
                    <input id="idQuestao" type="hidden" value="<?php echo $_GET['idQuestao']; ?>">
                    <div class="form-group col-lg-12">
                        <label>Questão</label>
                        <textarea id="titulo" class="form-control col-xs-12" tabindex="1"><?php echo $alternativas[0]['q_titulo']; ?></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="col-xs-11">Alternativas</label>
                        <label class="col-xs-1">Correta</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <span class="col-xs-11">
                            <input id="alternativa1" data-id="<?php echo $alternativas[0]['idAlternativa']; ?>" tabindex="2" name="correta" class="form-control" type="text" value="<?php echo $alternativas[0]['titulo']; ?>">
                        </span>
                        <label class="radio col-xs-1">
                            <input type="radio" name="correta" id="correta" tabindex="5" value="<?php echo $alternativas[0]['idAlternativa']; ?>" <?php if($alternativas[0]['correta']) echo "checked"; ?>>
                        </label>
                    </div>
                    <div class="form-group col-lg-12">
                        <span class="col-xs-11">
                            <input id="alternativa2" data-id="<?php echo $alternativas[1]['idAlternativa']; ?>" tabindex="3" name="incorreta2" class="form-control" type="text" value="<?php echo $alternativas[1]['titulo']; ?>">
                        </span>
                        <label class="radio col-xs-1">
                            <input type="radio" name="correta" id="correta" tabindex="6" value="<?php echo $alternativas[1]['idAlternativa']; ?>" <?php if($alternativas[1]['correta']) echo "checked"; ?>>
                        </label>
                    </div>
                    <div class="form-group col-lg-12">
                        <span class="col-xs-11">
                            <input id="alternativa3" data-id="<?php echo $alternativas[2]['idAlternativa']; ?>" tabindex="4" name="incorreta2" class="form-control" type="text" value="<?php echo $alternativas[2]['titulo']; ?>">
                        </span>
                        <label class="radio col-xs-1">
                            <input type="radio" name="correta" id="correta" tabindex="7" value="<?php echo $alternativas[2]['idAlternativa']; ?>" <?php if($alternativas[2]['correta']) echo "checked"; ?>>
                        </label>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <button type="submit" id="bt-editar-questao" data-type="editarQuestao" tabindex="8" class="btn btn-success">Salvar</button>
            </div>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
<!-- javascrtipt da Página -->
<script src="js/questionario/questionario.js"></script>