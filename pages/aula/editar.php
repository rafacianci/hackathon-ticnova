<?php
require_once '../../config.php';
require_once '../../query.php';

if ($_POST) {
    $idAula = (isset($_POST['idAula'])) ? $_POST['idAula'] : null;

    $aula = array(
        'titulo' => (isset($_POST['titulo'])) ? $_POST['titulo'] : null,
        'data' => (isset($_POST['data'])) ? $_POST['data'] : null,
    );

    Query::salvarAula($idAula, $aula);
}

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
        <form id="editarAula" method="POST">
            <input name="idAula" type="hidden" value="<?php echo $_REQUEST['idAula']; ?>" >
            <div class="form-group col-lg-2">
                <label>Data</label>
                <input name="data" class="form-control" type="text" value="<?php echo dateView($aula["data"]); ?>">
            </div>
            <div class="form-group col-lg-10">
                <label>Título</label>
                <input name="titulo" class="form-control" type="text" value="<?php echo $aula["titulo"]; ?>">
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button type="submit" id="bt-editar-aula" form="editarAula" class="btn btn-success">Salvar</button>
    </div>
</div>
<!-- javascrtipt da Página -->
<script src="js/aula/aula.js"></script>