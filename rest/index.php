<?php

header('Access-Control-Allow-Origin: *');

require_once '../config.php';
require_once '../db.php';

$retorno = array(
    'cd_error' => null,
    'msg_error' => null,
);

function retorno($retorno) {
    echo json_encode($retorno);
}

if (isset($_POST['act'])) {
    switch ($_POST['act']) {
        case 'test':
            $retorno['msg'] = 'Test OK';
            retorno($retorno);
            break;
        case 'cadastrarAluno':
            if ((isset($_POST['nome'])) && (isset($_POST['email'])) && (isset($_POST['senha']))) {
                $nome = (string) trim($_POST['nome']);
                $email = (string) trim($_POST['email']);
                $senha = (string) trim($_POST['senha']);

                if ($nome !== "" && $email !== "" && $senha !== "") {
                    $sql = "select * from aluno where email = '$email'";
                    $con = Database::getCon();
                    $query = mysqli_query($con, $sql);
                    $nRowsAluno = mysqli_num_rows($query);
                    if ($nRowsAluno == 0) {
                        $sqlInsert = "insert into aluno ( nome,email,senha) values('$nome','$email','$senha')";
                        $qRespostaInsert = mysqli_query($con, $sqlInsert);
                        $id = mysqli_insert_id($con);
                        retorno(array('idAluno' => $id));
                    } else {
                        $retorno['msg_error'] = 'Email já cadastrado';
                        retorno($retorno);
                    }
                }
            }

            break;
        case 'listarAulas':
            if ((isset($_POST['idGrupo']))) {
                $idGrupo = (string) trim($_POST['idGrupo']);
                if ($idGrupo !== "") {
                    $sql = "Select * from aula a inner join grupoaula ga on a.idAula = ga.idAula" .
                            " where ga.idGrupo = $idGrupo";
                    $con = Database::getCon();
                    $query = mysqli_query($con, $sql);
                    $retorno = array();
                    if (mysqli_num_rows($query)) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $retorno[] = $row;
                           
                        }
                         retorno($retorno);
                    }
                }
            }
            break;
        case 'listarGrupo':
            if ((isset($_POST['idAluno']))) {
                $idAluno = (string) trim($_POST['idAluno']);
                if ($idAluno !== "") {
                    $sql = "select g.idGrupo,g.titulo ,p.idProfessor,p.nome from grupo g " .
                            "inner join grupoaluno ga " .
                            "on g.idGrupo = ga.idGrupo " .
                            "inner join professor p " .
                            "on g.idProfessor = p.idProfessor " .
                            "where ga.idAluno = $idAluno";
                  
                    $con = Database::getCon();
                    $query = mysqli_query($con, $sql);
                    $retorno = array();
                    if (mysqli_num_rows($query)) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $retorno[] = $row;
                        }
                        retorno($retorno);
                    }
                }
            }
            break;
        case 'listarMaterial':
            if (isset($_POST['idAluno'])) {
                $idAluno = $_POST['idAluno'];
                $idAula = $_POST['idAula'];


                $queryRespAluno = "select q.idQuestao from resposta r "
                        . "left join alternativa a on (a.idAlternativa = r.idAlternativa) "
                        . "left join questao q on (q.idQuestao = a.idQuestao) "
                        . "where idAluno = '$idAluno'"
                ;

                $queryRespAlunoQuiz = "select q.idQuestaoquiz from respostaquiz r "
                        . "left join alternativaquiz a on (a.idAlternativaquiz = r.idAlternativaquiz) "
                        . "left join questaoquiz q on (q.idQuestaoquiz = a.idQuestaoquiz) "
                        . "where idAluno = '$idAluno'"
                ;

                $con = Database::getCon();
                $qRespAluno = mysqli_query($con, $queryRespAluno);
                $qRespAlunoQuiz = mysqli_query($con, $queryRespAlunoQuiz);

                $respondidas = array();
                if (mysqli_num_rows($qRespAluno)) {
                    while ($row = mysqli_fetch_assoc($qRespAluno)) {
                        $respondidas[] = $row['idQuestao'];
                    }
                    $respondidas = join(',', $respondidas);
                } else {
                    $respondidas = null;
                }
                
                $respondidasquiz = array();
                if (mysqli_num_rows($qRespAlunoQuiz)) {
                    while ($row = mysqli_fetch_assoc($qRespAlunoQuiz)) {
                        $respondidasquiz[] = $row['idQuestaoquiz'];
                    }
                    $respondidasquiz = join(',', $respondidasquiz);
                } else {
                    $respondidasquiz = null;
                }

               if (null !== $idAula) {
                    $query = "select ga.*, am.*, a.titulo a_titulo, a.data a_data from grupoaula ga "
                            . "left join aula a on (a.idAula = ga.idAula) "
                            . "left join aulamaterial am on (am.idAula = ga.idAula) "
                            . "where ga.idAula = '{$idAula}'"
                    ;
                    $q = mysqli_query($con, $query);

                    if (mysqli_num_rows($q)) {

                        $idAula = null;
                        $idSlide = null;
                        $idQuestionario = null;
                        $idQuiz = null;
                        $idQuestao = null;
                        $idQuestaoquiz = null;

                        while ($row = mysqli_fetch_assoc($q)) {
                            if ($idAula !== $row['idAula']) {
                                $idAula = $row['idAula'];
                                $retorno['idAula'] = $idAula;
                                $retorno['data'] = dateView($row['a_data']);
                                $retorno['titulo'] = $row['a_titulo'];
                                $retorno['idGrupo'] = $row['idGrupo'];
                                $retorno['material'] = array();
                            }

                            if (null !== $row['idMaterial']) {
                                $material = array();
                                switch ($row['tipo']) {
                                    case MATERIAL_QUESTIONARIO:
                                        $queryQuestionario = "select q.idQuestionario, q.titulo q_titulo"
                                                . " from questionario q "
                                                . "where (q.idQuestionario = {$row['idMaterial']})"
                                        ;

                                        $qQuestionario = mysqli_query($con, $queryQuestionario);

                                        if (mysqli_num_rows($qQuestionario)) {
                                            $material = array(
                                                'idMaterial' => $row['idMaterial'],
                                                'tipo' => $row['tipo'],
                                            );

                                            while ($rowQuestionario = mysqli_fetch_assoc($qQuestionario)) {
                                                if ($idQuestionario !== $rowQuestionario['idQuestionario']) {
                                                    $idQuestionario = $rowQuestionario['idQuestionario'];
                                                    $material['titulo'] = $rowQuestionario['q_titulo'];
                                                    $material['perguntas'] = array();
                                                }

                                                if ($idQuestionario == $rowQuestionario['idQuestionario']) {
                                                    $queryQuestao = "select q.idQuestao, q.titulo q_titulo, a.* from questao q "
                                                            . "left join alternativa a on (a.idQuestao = q.idQuestao) "
                                                            . "where (q.idQuestionario = {$idQuestionario}) "
                                                    ;
                                                    if (null !== $respondidas) {
                                                        $queryQuestao .= " and (q.idQuestao not in ({$respondidas}))";
                                                    }

                                                    $qQuestao = mysqli_query($con, $queryQuestao);

                                                    if (mysqli_num_rows($qQuestao)) {
                                                        $i = -1;
                                                        while ($rowQuestao = mysqli_fetch_assoc($qQuestao)) {
                                                            if ($idQuestao !== $rowQuestao['idQuestao']) {
                                                                $i++;
                                                                $idQuestao = $rowQuestao['idQuestao'];
                                                                $material['perguntas'][$i] = array(
                                                                    'titulo' => $rowQuestao['q_titulo'],
                                                                    'alternativas' => array(),
                                                                );
                                                            }

                                                            if ($idQuestao == $rowQuestao['idQuestao']) {
                                                                $material['perguntas'][$i]['alternativas'][] = array(
                                                                    'alternativa' => $rowQuestao['idAlternativa'],
                                                                    'titulo' => $rowQuestao['titulo'],
                                                                    'correta' => $rowQuestao['correta'],
                                                                );
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        break;
                                    case MATERIAL_QUIZ:
                                        $queryQuiz = "select q.idQuiz, q.titulo q_titulo, q.tempo q_tempo, q.tipo q_tipo"
                                                . " from quiz q "
                                                . "where (q.idQuiz = {$row['idMaterial']})"
                                        ;

                                        $qQuiz = mysqli_query($con, $queryQuiz);

                                        if (mysqli_num_rows($qQuiz)) {
                                            $material = array(
                                                'idMaterial' => $row['idMaterial'],
                                                'tipo' => $row['tipo'],
                                            );

                                            while ($rowQuiz = mysqli_fetch_assoc($qQuiz)) {
                                                if ($idQuiz !== $rowQuiz['idQuiz']) {
                                                    $idQuiz = $rowQuiz['idQuiz'];
                                                    $material['titulo'] = $rowQuiz['q_titulo'];
                                                    $material['perguntas'] = array();
                                                }

                                                if ($idQuiz == $rowQuiz['idQuiz']) {
                                                    $queryQuestaoquiz = "select q.idQuestaoquiz, q.titulo q_titulo, a.* from questaoquiz q "
                                                            . "left join alternativaquiz a on (a.idQuestaoquiz = q.idQuestaoquiz) "
                                                            . "where (q.idQuiz = {$idQuiz}) "
                                                    ;
                                                    if (null !== $respondidasquiz) {
                                                        $queryQuestaoquiz .= " and (q.idQuestaoquiz not in ({$respondidasquiz}))";
                                                    }

                                                    $qQuestaoquiz = mysqli_query($con, $queryQuestaoquiz);

                                                    if (mysqli_num_rows($qQuestaoquiz)) {
                                                        $i = -1;
                                                        while ($rowQuestaoquiz = mysqli_fetch_assoc($qQuestaoquiz)) {
                                                            if ($idQuestaoquiz !== $rowQuestaoquiz['idQuestaoquiz']) {
                                                                $i++;
                                                                $idQuestaoquiz = $rowQuestaoquiz['idQuestaoquiz'];
                                                                $material['perguntas'][$i] = array(
                                                                    'titulo' => $rowQuestaoquiz['q_titulo'],
                                                                    'alternativas' => array(),
                                                                );
                                                            }

                                                            if ($idQuestaoquiz == $rowQuestaoquiz['idQuestaoquiz']) {
                                                                $material['perguntas'][$i]['alternativas'][] = array(
                                                                    'alternativa' => $rowQuestaoquiz['idAlternativaquiz'],
                                                                    'titulo' => $rowQuestaoquiz['titulo'],
                                                                    'correta' => $rowQuestaoquiz['correta'],
                                                                );
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        break;
                                    case MATERIAL_SLIDE:
                                        $querySlide = "select s.*, si.* from slide s "
                                                . "left join slideimg si on (si.idSlide = s.idSlide) "
                                                . "where s.idSlide = {$row['idMaterial']} "
                                                . "order by si.ordem ASC"
                                        ;
                                        $qSlide = mysqli_query($con, $querySlide);

                                        if (mysqli_num_rows($qSlide)) {
                                            $material = array(
                                                'idMaterial' => $row['idMaterial'],
                                                'tipo' => $row['tipo'],
                                            );

                                            while ($rowSlide = mysqli_fetch_assoc($qSlide)) {
                                                if ($idSlide !== $row['idMaterial']) {
                                                    $idSlide = $row['idMaterial'];
                                                    $material['titulo'] = $rowSlide['titulo'];
                                                    $material['imgs'] = array();
                                                }

                                                $material['imgs'][] = array(
                                                    'img' => $rowSlide['idImg'],
                                                    'ordem' => $rowSlide['ordem'],
                                                    'url' => $rowSlide['url'],
                                                );
                                            }
                                        }
                                        break;
                                    case MATERIAL_VIDEO:
                                        $queryVideo = "select v.* from video v where idVideo = {$row['idMaterial']}";
                                        $qVideo = mysqli_query($con, $queryVideo);

                                        if (mysqli_num_rows($qVideo)) {
                                            $material = array(
                                                'idMaterial' => $row['idMaterial'],
                                                'tipo' => $row['tipo'],
                                            );
                                            $rowVideo = mysqli_fetch_assoc($qVideo);
                                            $material['url'] = $rowVideo['url'];
                                            $material['titulo'] = $rowVideo['titulo'];
                                        }
                                        break;

                                    default:
                                        break;
                                }

                                if (count($material) > 0) {
                                    $retorno['material'][] = $material;
                                }
                            }
                        }

                        retorno($retorno);
                    } else {
                        $retorno['msg_error'] = 'Aula invalida';
                        retorno($retorno);
                    }
               }
            } 
            break;
        case 'salvarResposta':

            if ((isset($_POST['idAluno'])) && (isset($_POST['id'])) && (isset($_POST['idGrupo']))) {

                $idAluno = $_POST['idAluno'];
                $id = $_POST['id'];
                $idGrupo = $_POST['idGrupo'];

                if ((null !== $idAluno) and ( null !== $id) and (null !== $idGrupo)) {
                    $con = Database::getCon();
                    $queryResposta = "insert into resposta (idAluno, idAlternativa, idGrupo) values({$idAluno}, {$id}, {$idGrupo})";
                    $qResposta = mysqli_query($con, $queryResposta);
                    print_r($qResposta);exit;
                    if (!$qResposta) {
                        $retorno['msg_error'] = 'Nao foi possivel gravar a resposta';
                    }
                } else if (null == $id) {
                    $retorno['msg_error'] = 'Informar uma resposta';
                } else {
                    $retorno['msg_error'] = 'Aluno nao identificado';
                }
            } else {
                $retorno['msg_error'] = 'Nao foi possivel gravar a resposta';
            }
            retorno($retorno);
            break;
        case 'verificaAluno':

            if ((isset($_POST['email'])) && (isset($_POST['senha']))) {

                $email = $_POST['email'];
                $senha = $_POST['senha'];

                if (null !== $email && null !== $senha) {
                    $sql = "select * from aluno where email = '$email' and senha = '$senha' ";
                }

                $con = Database::getCon();
                $q = mysqli_query($con, $sql);
                if (mysqli_num_rows($q)) {
                    while ($row = mysqli_fetch_assoc($q)) {
                        $retorno = array_merge($row, $retorno);
                        retorno($retorno);
                    }
                } else {
                    $retorno["msg_error"] = "Aluno nao encontrado";
                    retorno($retorno);
                }
            } else {
                $retorno["msg_error"] = "Informe email e senha";
                retorno($retorno);
            }
            break;
        default:
            break;
    }
}    