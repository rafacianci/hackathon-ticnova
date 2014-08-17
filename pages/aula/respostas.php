<?php
require_once '../../config.php';
require_once '../../query.php';

$dados = Query::pegarRespostas($_GET['idQuestionario'], $_GET['idAula']);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Respostas
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
                    foreach ($dados['alunos'] as $aluno) {
                        foreach ($dados['respostas'] as $resposta) {
                            if ($resposta['idAluno'] == $aluno['idAluno']) {
                                ?>
                                <tr>
                                    <td><?php echo $aluno['nome']; ?></td>
                                    <td><?php echo $resposta['q_titulo']; ?></td>
                                    <td><?php echo $resposta['a_titulo']; ?></td>
                                    <td><?php echo $resposta['ac_titulo']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
