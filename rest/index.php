<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=utf-8');

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

            if (null !== $chave) {
                $query = "select ga.*, am.*, a.titulo a_titulo, a.data a_data from grupoaula ga "
                        . "left join aula a on (a.idAula = ga.idAula) "
                        . "left join aulamaterial am on (am.idAula = ga.idAula) "
                        . "where ga.chave = '{$chave}'"
                ;

                $con = Database::getCon();
                $q = mysqli_query($con, $query);

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
                                $queryQuestionario = "select q.idQuestionario, q.titulo q_titulo, q2.idQuestao, q2.titulo q2_titulo from questionario q "
                                        . "left join questao q2 on (q.idQuestionario = q2.idQuestionario) "
                                        . "where (q.idQuestionario = {$row['idMaterial']}) "
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
                                            $material['titulo'] = "Questionario " . $idQuestionario;
                                            $material['pergunta'] = $rowQuestionario['q_titulo'];
                                        }

                                        if ($idQuestionario == $rowQuestionario['idQuestionario']) {
                                            $queryQuestao = "select q.idQuestao, q.titulo q_titulo, a.* from questao q "
                                                    . "left join alternativa a on (a.idQuestao = q.idQuestao) "
                                                    . "where (q.idQuestionario = {$idQuestionario}) "
                                            ;
                                            $qQuestao = mysqli_query($con, $queryQuestao);

                                            if (mysqli_num_rows($qQuestao)) {
                                                while ($rowQuestao = mysqli_fetch_assoc($qQuestao)) {
                                                    if ($idQuestao !== $rowQuestao['idQuestao']) {
                                                        $idQuestao = $rowQuestao['idQuestao'];
                                                        $material['pergunta'] = $rowQuestao['q_titulo'];
                                                        $material['alternativas'] = array();
                                                    }

                                                    $material['alternativas'][] = array(
                                                        'alternativa' => $rowQuestao['idAlternativa'],
                                                        'titulo' => $rowQuestao['titulo'],
                                                        'correta' => $rowQuestao['correta'],
                                                    );
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
            }
            break;
        case 'verificaAluno':
            $params = null;
            if (isset($_POST['data'])) {
                if (is_string($_POST['data'])) {
                    $params = json_decode($_POST['data'], 1);
                } else {
                    $params = $_POST['data'];
                }


                $login = (isset($params['login'])) ? (string) $params['login'] : null;
                $senha = (isset($params['senha'])) ? (string) $params['senha'] : null;


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
                    retorno($retorno["msg_error"] = "Aluno nao encontrado");
                }
            }
            break;
        default:
            break;
    }
}