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
            $params = (isset($_POST['data'])) ? json_decode($_POST['data'], 1) : null;
            $chave = (isset($params['chave'])) ? (string) $params['chave'] : null;

            if (null !== $chave) {
                $query = "select ga.*, am.*, a.titulo a_titulo, a.data a_data from grupoaula ga "
                        . "left join aula a on (a.idAula = ga.idAula) "
                        . "left join aulamaterial am on (am.idAula = ga.idAula) "
                        . "where ga.chave = '{$chave}'"
                ;

                $con = Database::getCon();
                $q = mysqli_query($con, $query);

                $r = array();
                $idAula = null;
                $idSlide = null;

                while ($row = mysqli_fetch_assoc($q)) {
                    if ($idAula !== $row['idAula']) {
                        $idAula = $row['idAula'];
                        $r['idAula'] = $idAula;
                        $r['data'] = dateView($row['a_data']);
                        $r['titulo'] = $row['a_titulo'];
                        $r['idGrupo'] = $row['idGrupo'];
                        $r['material'] = array();
                    }

                    if (null !== $row['idMaterial']) {
                        $material = array(
                            'idMaterial' => $row['idMaterial'],
                            'tipo' => $row['tipo'],
                        );

                        switch ($row['tipo']) {
                            case MATERIAL_QUESTIONARIO:
//                                $queryQuestionario = "select q.* from questionario s "
//                                        . "left join slideimg si on (si.idSlide = s.idSlide) "
//                                        . "where s.idSlide = {$row['idMaterial']} "
//                                        . "order by si.ordem ASC"
//                                ;
                                break;
                            case MATERIAL_SLIDE:
                                $querySlide = "select s.*, si.* from slide s "
                                        . "left join slideimg si on (si.idSlide = s.idSlide) "
                                        . "where s.idSlide = {$row['idMaterial']} "
                                        . "order by si.ordem ASC"
                                ;
                                $qSlide = mysqli_query($con, $querySlide);

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
                                break;
                            case MATERIAL_VIDEO:
                                $queryVideo = "select v.* from video v where idVideo = {$row['idMaterial']}";
                                $qVideo = mysqli_query($con, $queryVideo);
                                $rowVideo = mysqli_fetch_assoc($qVideo);
                                $material['url'] = $rowVideo['url'];
                                break;

                            default:
                                break;
                        }

                        $r['material'][] = $material;
                    }
                }

                retorno($r);
            }
            break;

        default:
            break;
    }
}