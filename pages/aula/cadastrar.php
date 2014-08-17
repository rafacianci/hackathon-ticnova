<?php
require_once '../../config.php';
require_once '../../query.php';

?>
<div class="panel panel-default">
    <div class="panel-heading">
        Cadastrar Aula
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form method="POST">
            <div class="form-group col-lg-2">
                <label>Data</label>
                <input id="data" name="data" class="form-control" type="text" value="">
                <p class="help-block">Exemplo 31/12/9999.</p>
            </div>
            <div class="form-group col-lg-10">
                <label>Título</label>
                <input id="titulo" name="titulo" class="form-control" type="text" value="">
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-cadastrar-aula" data-type="cadastrarAula" class="btn btn-success">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/aula/aula.js"></script>