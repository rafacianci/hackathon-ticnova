<?php
require_once '../../config.php';
require_once '../../query.php';
if (isset($_GET['idQuestionario'])) {
    $tabela = 'questionario';
    $id = $_GET['idQuestionario'];
} else if (isset($_GET['idQuiz'])) {
    $id = $_GET['idQuiz'];
    $tabela = 'quiz';
}
$dados = Query::pegarRespostas($id, $_GET['idAula'], $tabela);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Respostas
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    Opções
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a class="ajax" href="#/aula/materiais/idAula/<?php echo $_GET['idAula']; ?>">Listar materiais</a></li>
                    <li><a class="ajax" href="#/aula/listar">Listar aulas</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Pergunta</th>
                        <th>Resposta do Aluno</th>
                        <th>Resposta Correta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($dados['respostas']) > 0) {
                        foreach ($dados['alunos'] as $aluno) {
                            foreach ($dados['respostas'] as $resposta) {
                                if ($resposta['idAluno'] == $aluno['idAluno']) {
                                    ?>
                                    <tr class="<?php echo ($resposta['aluno'] != $resposta['correta']) ? 'danger' : 'success'; ?>">
                                        <td><?php echo $aluno['nome']; ?></td>
                                        <td><?php echo $resposta['q_titulo']; ?></td>
                                        <td><?php echo $resposta['a_titulo']; ?></td>
                                        <td><?php echo $resposta['ac_titulo']; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">
                                Nenhum aluno respondeu ainda.
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
