<?php

require_once '/config.php';
require_once '/db.php';

$con = Database::getCon();

if ($_POST) {
    if (isset($_POST['tipo'])) {
        switch ($_POST['tipo']) {
            case "cadastrarAula":
                $data = (isset($_POST['data'])) ? $_POST['data'] : null;
                $data = dateDb($data);
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idProf = $_SESSION['user']['id'];
                $q = mysqli_query($con, "INSERT INTO aula (data, titulo, idProfessor) values ('{$data}','{$titulo}','{$idProf}')");
                echo json_encode(array(
                    "redirect" => "#/aula/listar",
                ));
                break;
            case "cadastrarSlides":
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idProf = $_SESSION['user']['id'];
                $q = mysqli_query($con, "INSERT INTO slide (titulo, idProfessor) values ('{$titulo}','{$idProf}')");
                echo json_encode(array(
                    "redirect" => "#/slides/listar",
                ));
                break;
            case "cadastrarSlidesImg":
                $idSlide = (isset($_POST['idSlide'])) ? $_POST['idSlide'] : null;
                $url = (isset($_POST['url'])) ? $_POST['url'] : null;
                $q = mysqli_query($con, "INSERT INTO slideimg (url, ordem, idSlide) values ('{$url}',0,'{$idSlide}')");
                echo "INSERT INTO slideimg (url, ordem, idSlide) values ('{$url}',0,'{$idSlide}')";
                echo json_encode(array(
                    "redirect" => "#/slides/cadastrarImg/idSlide/".$idSlide,
                ));
                break;
            case "cadastrarVideos":
                $url = (isset($_POST['url'])) ? $_POST['url'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idProf = $_SESSION['user']['id'];
                $q = mysqli_query($con, "INSERT INTO video (titulo, url, idProfessor) values ('{$titulo}','{$url}','{$idProf}')");
                echo json_encode(array(
                    "redirect" => "#/videos/listar",
                ));
                break;
            case "cadastrarQuestao":
                $idQuest = (isset($_POST['idQuestionario'])) ? $_POST['idQuestionario'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idCorreta = (isset($_POST['correta'])) ? $_POST['correta'] : null;
                
                $q = mysqli_query($con, "INSERT INTO questao (titulo, idQuestionario) VALUES ('{$titulo}', {$idQuest})");
                $q = mysqli_insert_id($con);
                unset($_POST['idQuestionario'], $_POST['titulo'],$_POST['correta'],$_POST['tipo']);
                
                $i = 1;
                foreach ($_POST as $key => $value) {
                    $c = (int) ($i == $idCorreta);
                    mysqli_query($con, "INSERT INTO alternativa (titulo, correta, idQuestao) VALUES ('{$value}', '{$c}', '{$q}')");
                    $i++;
                }
                
                
                echo json_encode(array(
                    "redirect" => "#/questionario/questoes/idQuestionario/".$idQuest,
                ));
                break;
            case "cadastrarQuestionario":
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idProf = $_SESSION['user']['id'];
                $q = mysqli_query($con, "INSERT INTO questionario (titulo, idProfessor) values ('{$titulo}','{$idProf}')");
                echo json_encode(array(
                    "redirect" => "#/questionario/listar",
                ));
                break;
            case "deletarQuestao":
                $id = (isset($_POST['idQuestao'])) ? $_POST['idQuestao'] : null;
                $idProf = $_SESSION['user']['id'];
                $q = mysqli_query($con, "INSERT INTO questionario (titulo, idProfessor) values ('{$titulo}','{$idProf}')");
                echo json_encode(array(
                    "redirect" => "#/questionario/listar",
                ));
                break;
            case "deletarRelacionamento":
                $idAula = (isset($_POST['idAula'])) ? $_POST['idAula'] : null;
                $idMaterial = (isset($_POST['idMaterial'])) ? $_POST['idMaterial'] : null;
                $idTipo = (isset($_POST['idTipo'])) ? $_POST['idTipo'] : null;
                $q = mysqli_query($con, "DELETE FROM aulamaterial where idAula = {$idAula} and idMaterial = {$idMaterial} and tipo = {$idTipo}");
                
                echo json_encode(array(
                    "msg" => "Passou",
                    "redirect" => "#/aula/materiais/idAula/".$idAula,
                ));
                break; 
            case "editarAula":
                $id = (isset($_POST['idAula'])) ? $_POST['idAula'] : null;
                $data = (isset($_POST['data'])) ? $_POST['data'] : null;
                $data = dateDb($data);
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $q = mysqli_query($con, "UPDATE aula SET data = '{$data}', titulo = '{$titulo}' where idAula = {$id}");
                
                echo json_encode(array(
                    "redirect" => "#/aula/listar",
                ));
                break;
            case "editarQuestao":
                $idQuest = (isset($_POST['idQuestao'])) ? $_POST['idQuestao'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idCorreta = (isset($_POST['correta'])) ? $_POST['correta'] : null;
                
                $q = mysqli_query($con, "UPDATE questao SET titulo = '{$titulo}' where idQuestao = {$idQuest}");
                unset($_POST['idQuestao'], $_POST['titulo'],$_POST['correta'],$_POST['tipo']);
                foreach ($_POST as $key => $value) {
                    $c = (int) ($key == $idCorreta);
                    mysqli_query($con, "UPDATE alternativa SET titulo = '{$value}', correta = $c where idAlternativa = {$key}");
                }
                echo json_encode(array(
                    "redirect" => "#/questionario/edit-questao/idQuestao/".$idQuest,
                ));
                break;
            case "editarQuestionario":
                $idQuest = (isset($_POST['idQuestionario'])) ? $_POST['idQuestionario'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $q = mysqli_query($con, "UPDATE questionario SET titulo = '{$titulo}' where idQuestionario = {$idQuest}");
                
                echo json_encode(array(
                    "redirect" => "#/questionario/editar/idQuestionario/".$idQuest,
                ));
                break;
            case "editarVideos":
                $id = (isset($_POST['idVideo'])) ? $_POST['idVideo'] : null;
                $url = (isset($_POST['url'])) ? $_POST['url'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $q = mysqli_query($con, "UPDATE video SET url = '{$url}', titulo = '{$titulo}' where idVideo = {$id}");
                
                echo json_encode(array(
                    "redirect" => "#/videos/listar",
                ));
                break;
            case "excluirImg":
                $idImg = (isset($_POST['idImg'])) ? $_POST['idImg'] : null;
                $idSlide = (isset($_POST['idSlide'])) ? $_POST['idSlide'] : null;
                $q = mysqli_query($con, "DELETE FROM slideimg WHERE idImg = {$idImg}");
                echo json_encode(array(
                    "redirect" => "#/slides/cadastrarImg/idSlide/".$idSlide,
                ));
                break;
            case "login":
                $login = (isset($_POST['login'])) ? $_POST['login'] : null;
                $senha = (isset($_POST['senha'])) ? md5($_POST['senha']) : null;

                if ((null === $login) or ( null === $senha)) {
                    throw new Exception('Informe login e senha');
                }

                $q = mysqli_query($con, "select * from professor where email = '{$login}' and senha = '{$senha}'");

                if (mysqli_num_rows($q) > 0) {
                    $r = mysqli_fetch_array($q);
                    $_SESSION['user'] = array(
                        'id' => $r['idProfessor'],
                        'nome' => $r['nome'],
                    );
                    echo json_encode(array(
                        "redirect" => "#/main/home",
                    ));
                } else {
                    echo json_encode(array(
                        "redirect" => "",
                    ));
                }
                break;
            case "logout":
                session_unset();
                echo json_encode(array(
                    "redirect" => "#/auth/login",
                ));
                break;
            case "relacionarArquivo":
                $idAula = (isset($_POST['idAula'])) ? $_POST['idAula'] : null;
                $idMaterial = (isset($_POST['idMaterial'])) ? $_POST['idMaterial'] : null;
                $cdTipo = (isset($_POST['idTipo'])) ? $_POST['idTipo'] : null;
                $q = mysqli_query($con, "INSERT INTO aulamaterial (idAula, idMaterial, tipo) values ('{$idAula}','{$idMaterial}','{$cdTipo}')");
                echo json_encode(array(
                    "redirect" => "#/aula/relacionar/cdTipo/".$cdTipo."/idAula/".$idAula,
                ));
                break;
            case "verificaLogin":
                if (!isset($_SESSION['user']) and ( $_SERVER['REQUEST_URI'] !== URL_LOGIN)) {
                    echo json_encode(array(
                        "redirect" => URL_LOGIN
                    ));
                } else {
                    echo json_encode(array(
                        "redirect" => ""
                    ));
                }
                break;
            default:
                break;
        }
    }
}
