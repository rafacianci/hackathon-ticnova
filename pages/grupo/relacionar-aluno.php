<?php
require_once '../../config.php';
require_once '../../query.php';

//    $relacionar = Query::pegarAulasRelacionadas($_GET['idGrupo'], $_SESSION['user']['id']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Adicionar Aluno
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <form id="buscarAluno" method="POST">
                <div class="form-group col-lg-12">
                    <label class="col-xs-11">Procurar Aluno</label>
                </div>
                <div class="form-group input-group">
                    <input type="hidden" name="idGrupo" value="<?php echo $_GET['idGrupo']; ?>">
                    <input type="text" name="nome" id="nome" class="form-control" required />
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Título</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="alunos-ajax">
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
<!-- javascrtipt da Página -->
<script src="js/grupo/grupo.js"></script>