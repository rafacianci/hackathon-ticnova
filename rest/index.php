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
        case 'pegarAula':
            $params = null;
            if (isset($_POST['data'])) {
                if (is_string($_POST['data'])) {
                    $params = json_decode($_POST['data'], 1);
                } else {
                    $params = $_POST['data'];
                }
            }

            $chave = (isset($params['chave'])) ? (string) $params['chave'] : null;
            $idAluno = (isset($params['idAluno'])) ? (int) $params['idAluno'] : null;

            $queryRespAluno = "select q.idQuestao from resposta r "
                    . "left join alternativa a on (a.idAlternativa = r.idAlternativa) "
                    . "left join questao q on (q.idQuestao = a.idQuestao) "
                    . "where idAluno = {$idAluno}"
            ;
            $con = Database::getCon();
            $qRespAluno = mysqli_query($con, $queryRespAluno);

            $respondidas = array();
            if (mysqli_num_rows($qRespAluno)) {
                while ($row = mysqli_fetch_assoc($qRespAluno)) {
                    $respondidas[] = $row['idQuestao'];
                }
                $respondidas = join(',', $respondidas);
            } else {
                $respondidas = null;
            }

            if (null !== $chave) {
                $query = "select ga.*, am.*, a.titulo a_titulo, a.data a_data from grupoaula ga "
                        . "left join aula a on (a.idAula = ga.idAula) "
                        . "left join aulamaterial am on (am.idAula = ga.idAula) "
                        . "where ga.chave = '{$chave}'"
                ;

                $q = mysqli_query($con, $query);

                if (mysqli_num_rows($q)) {

                    $idAula = null;
                    $idSlide = null;
                    $idQuestionario = null;
                    $idQuestao = null;

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
            break;
        case 'verificaAluno':

            if ((isset($_POST['login'])) && (isset($_POST['senha']))) {

                $login = $_POST['login'];
                $senha = $_POST['senha'];


                if (null !== $login && null !== $senha) {
                    $sql = "select * from aluno where login = '$login' and senha = '$senha' ";
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
                $retorno["msg_error"] = "Informe login e senha";
                retorno($retorno);
            }
            break;
        case 'salvarResposta':
            $params = null;
            if (isset($_POST['data'])) {
                if (is_string($_POST['data'])) {
                    $params = json_decode($_POST['data'], 1);
                } else {
                    $params = $_POST['data'];
                }
            }

            $idAluno = (isset($params['idAluno'])) ? (int) $params['idAluno'] : null;
            $id = (isset($params['id'])) ? (int) $params['id'] : null;

            if ((null !== $idAluno) and ( null !== $id)) {
                $con = Database::getCon();
                $queryResposta = "insert into resposta (idAluno, idAlternativa, idGrupo) values({$idAluno}, {$id}, ("
                        . "select idGrupo from grupoaluno where idAluno = {$idAluno}))";
                $qResposta = mysqli_query($con, $queryResposta);

                if (!$qResposta) {
                    $retorno['msg_error'] = 'Nao foi possivel gravar a resposta';
                }
            } else if (null == $id) {
                $retorno['msg_error'] = 'Informar uma resposta';
            } else {
                $retorno['msg_error'] = 'Aluno nao identificado';
            }

            retorno($retorno);
            break;
        default:
            break;
    }
}