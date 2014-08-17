<?php
require_once '../../config.php';
require_once '../../query.php';

if ($_GET['idAula']) {
    $aula = Query::pegarAula($_GET['idAula']);
}
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Editar Aula
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form method="POST">
            <input id="idAula" name="idAula" type="hidden" value="<?php echo $_REQUEST['idAula']; ?>" >
            <div class="form-group col-lg-2">
                <label>Data</label>
                <input id="data" name="data" class="form-control" type="text" value="<?php echo dateView($aula["data"]); ?>">
            </div>
            <div class="form-group col-lg-10">
                <label>Título</label>
                <input id="titulo" name="titulo" class="form-control" type="text" value="<?php echo $aula["titulo"]; ?>">
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-editar-aula" data-type="editarAula" class="btn btn-success">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/aula/aula.js"></script>