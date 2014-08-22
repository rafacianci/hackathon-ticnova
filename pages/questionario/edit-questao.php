<?php
require_once '../../config.php';
require_once '../../query.php';

$alternativas = Query::pegarAlternativa($_GET['idQuestao']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Editar - Questão
        <div class="col-lg-6 pull-right">
            <a href="#/questionario/cad-questao" class="ajax btn btn-default col-lg-3 pull-right">+ Questões</a>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <div class="panel-body">
                <form method="POST">
                    <input id="idQuestao" type="hidden" value="<?php echo $_GET['idQuestao']; ?>">
                    <div class="form-group col-lg-12">
                        <label>Questão</label>
                        <input id="titulo" name="titulo" class="form-control" type="text" value="<?php echo $alternativas[0]['q_titulo']; ?>">
                    </div>
                    <div class="form-group col-lg-12">
                        <label>Resposta Correta</label>
                        <input id="alternativa-correta" data-id="<?php echo $alternativas[0]['idAlternativa']; ?>" name="correta" class="form-control" type="text" value="<?php echo $alternativas[0]['titulo']; ?>">
                    </div>
                    <div class="form-group col-lg-12">
                        <label>Alternativa</label>
                        <input id="alternativa-incorreta1" data-id="<?php echo $alternativas[1]['idAlternativa']; ?>" name="incorreta1" class="form-control" type="text" value="<?php echo $alternativas[1]['titulo']; ?>">
                    </div>
                    <div class="form-group col-lg-12">
                        <label>Alternativa</label>
                        <input id="alternativa-incorreta2" data-id="<?php echo $alternativas[2]['idAlternativa']; ?>" name="incorreta2" class="form-control" type="text" value="<?php echo $alternativas[2]['titulo']; ?>">
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <button type="submit" id="bt-editar-questao" data-type="editarQuestao" class="btn btn-success">Salvar</button>
            </div>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
<!-- javascrtipt da Página -->
<script src="js/questionario/questionario.js"></script>