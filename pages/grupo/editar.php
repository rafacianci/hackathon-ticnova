<?php
require_once '../../config.php';
require_once '../../query.php';

if ($_GET['idGrupo']) {
    $grupo = Query::pegarGrupo($_GET['idGrupo']);
}
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Editar Grupo
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form id="editarGrupo" method="POST">
            <input id="idGrupo" name="idGrupo" type="hidden" value="<?php echo $_REQUEST['idGrupo']; ?>" >
            <div class="form-group col-lg-10">
                <label>Título</label>
                <input id="titulo" name="titulo" class="form-control" type="text" value="<?php echo $grupo["titulo"]; ?>">
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-editar-grupo" class="btn btn-success" data-type="editarGrupo">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/grupo/grupo.js"></script>