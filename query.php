<?php

require_once '../../db.php';

class Query {

    public static function login($login, $senha) {
        if ((null === $login) or ( null === $senha)) {
            throw new Exception('Informe login e senha');
        }

        $con = Database::getCon();
        $q = mysqli_query($con, "select * from professor where email = '{$login}' and senha = '{$senha}'");
        $r = mysqli_fetch_array($q);

        if (null !== $r) {
            $_SESSION['user'] = array(
                'id' => $r['idProfessor'],
                'nome' => $r['nome'],
            );

            header('location: /index.php');
        }
    }

    public static function pegarAula($id) {
        $con = Database::getCon();
        $q = mysqli_query($con, "select * from aula where idAula = {$id}");
        $r = mysqli_fetch_assoc($q);

        return $r;
    }

    public static function pegarAulas($id) {
        $con = Database::getCon();
        $q = mysqli_query($con, "select * from aula where idProfessor = {$id} order by data desc");
        $r = array();

        if (null !== $q) {
            while ($row = mysqli_fetch_assoc($q)) {
                $r[] = $row;
            }
        }

        return $r;
    }

    public static function pegarMateriais($id) {
        $con = Database::getCon();
        $q = mysqli_query($con, "  SELECT a.*, v.*, v.titulo as m3_titulo, s.*,s.titulo m2_titulo, q.*, q.titulo m1_titulo  FROM aulamaterial a
                              LEFT JOIN video v on (v.idVideo = a.idMaterial) and (a.tipo = 3)
                              LEFT JOIN slide s on (s.idSlide = a.idMaterial) and (a.tipo = 2)
                              LEFT JOIN questionario q on  (q.idQuestionario = a.idMaterial) and (a.tipo = 1)
                                  WHERE a.idAula = {$id}
                              ORDER BY a.Tipo ASC");
        $r = array();

        if (null !== $q) {
            while ($row = mysqli_fetch_assoc($q)) {
                $r[] = $row;
            }
        }

        return $r;
    }

    public static function pegarRelacionados($idAula, $idTipo) {
        $con = Database::getCon();

        switch ($idTipo) {
            case MATERIAL_QUESTIONARIO:
                $sql = "SELECT q.*, q.idQuestionario id
                          FROM  questionario q 
                         WHERE q.idQuestionario not in (
                                                SELECT a.idMaterial from aulamaterial a
                                                 WHERE a.tipo = {$idTipo}
                                                   AND a.idAula = {$idAula}
                                                        )
                      ORDER BY q.idQuestionario DESC";
                break;
            case MATERIAL_SLIDE:
                $sql = "SELECT s.*, s.idSlide id
                          FROM slide s 
                         WHERE s.idSlide not in (
                                                SELECT a.idMaterial from aulamaterial a
                                                 WHERE a.tipo = {$idTipo}
                                                   AND a.idAula = {$idAula}
                                                        )
                      ORDER BY s.idSlide DESC";
                break;
            case MATERIAL_VIDEO:
                $sql = "SELECT v.*, v.idVideo id
                          FROM video v 
                         WHERE v.idVideo not in (
                                                SELECT a.idMaterial from aulamaterial a
                                                 WHERE a.tipo = {$idTipo}
                                                   AND a.idAula = {$idAula}
                                                        )
                      ORDER BY v.idVideo DESC";
                break;
            default:
                break;
        }

        $q = mysqli_query($con, $sql);
        $r = array();

        if (null !== $q) {
            while ($row = mysqli_fetch_assoc($q)) {
                $r[] = $row;
            }
        }

        return $r;
    }

    public static function pegarVideos($id) {
        $con = Database::getCon();
        $q = mysqli_query($con, "select * from video where idProfessor = {$id} order by idVideo desc");
        $r = array();

        if (null !== $q) {
            while ($row = mysqli_fetch_assoc($q)) {
                $r[] = $row;
            }
        }

        return $r;
    }

    public static function pegarVideo($id) {
        $con = Database::getCon();
        $q = mysqli_query($con, "select * from video where idVideo = {$id}");
        return mysqli_fetch_assoc($q);
    }

    public static function salvarAula($id = null, $aula) {
        $con = Database::getCon();

        if (null == $id) {
            $data = dateDb($aula['data']);
            $titulo = $aula['titulo'];
            $q = mysqli_query($con, "INSERT INTO aula (data, titulo) VALUES('{$data}', '{$titulo}' )");
//            header("");
        } else {
            $data = dateDb($aula['data']);
            $titulo = $aula['titulo'];
            $q = mysqli_query($con, "UPDATE aula SET (data = '{$data}', titulo = '{$titulo}') WHERE idAula = {$id}");
        }

        return $q;
    }

    public static function pegarRespostas($idQuestionario, $idAula) {
        $con = Database::getCon();

        $queryAluno = "select * from aluno";
        $qAluno = mysqli_query($con, $queryAluno);

        $alunos = array();
        if (mysqli_num_rows($qAluno)) {
            while ($row = mysqli_fetch_assoc($qAluno)) {
                $alunos[] = $row;
            }
        }

        $queryResposta = "select r.*, a.*, a.titulo a_titulo, q.*, q.titulo q_titulo, ac.titulo ac_titulo from resposta r "
                . "left join alternativa a on(a.idAlternativa = r.idAlternativa) "
                . "left join alternativa ac on(ac.idAlternativa = a.idAlternativa) and (ac.correta = 1)"
                . "left join questao q on(q.idQuestao = a.idQuestao)";
        $qResposta = mysqli_query($con, $queryResposta);

        $respostas = array();
        if (mysqli_num_rows($qResposta)) {
            while ($row = mysqli_fetch_assoc($qResposta)) {
                $respostas[] = $row;
            }
        }

        return array('alunos' => $alunos, 'respostas' => $respostas);
    }

}
