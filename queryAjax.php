<?php

require_once './config.php';
require_once './db.php';

$con = Database::getCon();

if ($_POST) {
    if (isset($_POST['tipo'])) {
        switch ($_POST['tipo']) {
            case "addAluno":
                $idAluno = (isset($_POST['idAluno'])) ? $_POST['idAluno'] : null;
                $idGrupo = (isset($_POST['idGrupo'])) ? $_POST['idGrupo'] : null;
                $q = mysqli_query($con, "INSERT INTO grupoaluno (idAluno, idGrupo) values ('{$idAluno}','{$idGrupo}')");
                echo json_encode(array(
                    "redirect" => "#/grupo/alunos/idGrupo/" . $idGrupo,
                ));
                break;
            case "ativarAula":
                $idAula = (isset($_POST['idAula'])) ? $_POST['idAula'] : null;
                $idGrupo = (isset($_POST['idGrupo'])) ? $_POST['idGrupo'] : null;
                $status = (isset($_POST['status'])) ? $_POST['status'] : null;
                $status = ($status) ? 0 : 1;
                $q = mysqli_query($con, "UPDATE grupoaula SET status = {$status} WHERE idGrupo = {$idGrupo} and idAula = {$idAula}");
                echo json_encode(array(
                    "redirect" => "#/grupo/aulas/idGrupo/" . $idGrupo,
                ));
                break;
            case "ativarMaterial":
                $idAula = (isset($_POST['idAula'])) ? $_POST['idAula'] : null;
                $idMaterial = (isset($_POST['idMaterial'])) ? $_POST['idMaterial'] : null;
                $idTipo = (isset($_POST['idTipo'])) ? $_POST['idTipo'] : null;
                $status = (isset($_POST['status'])) ? $_POST['status'] : null;
                $status = (int) ($status) ? 0 : 1;
                $q = mysqli_query($con, "UPDATE aulamaterial SET status = {$status} WHERE idMaterial = {$idMaterial} and idAula = {$idAula} and tipo = {$idTipo}");
                echo json_encode(array(
                    "redirect" => "#/aula/materiais/idAula/" . $idAula,
                ));
                break;
            case "ativarAluno":
                $idAluno = (isset($_POST['idAluno'])) ? $_POST['idAluno'] : null;
                $idGrupo = (isset($_POST['idGrupo'])) ? $_POST['idGrupo'] : null;
                $status = (isset($_POST['status'])) ? $_POST['status'] : null;
                $status = (int) ($status) ? 0 : 1;
                $q = mysqli_query($con, "UPDATE aluno SET status = {$status} WHERE idAluno = {$idAluno}");
                echo json_encode(array(
                    "redirect" => "#/grupo/alunos/idGrupo/" . $idGrupo,
                ));
                break;
            case "buscarAluno":
                $nome = (isset($_POST['nome'])) ? $_POST['nome'] : "";
                $id = (isset($_POST['idGrupo'])) ? $_POST['idGrupo'] : "";
                $q = mysqli_query($con, "SELECT * FROM aluno where idAluno not in (SELECT g.idAluno FROM grupoaluno g WHERE idGrupo = {$id}) And (nome LIKE '%{$nome}%' or email like '%{$nome}%')");
                $conteudo = "";
                if(mysqli_num_rows($q) > 0){
                    while ($row = mysqli_fetch_assoc($q)) {
                        $conteudo .= "<tr>"
                                . "<td>" . $row['nome'] . "</td>"
                                . "<td>" . $row['email'] . "</td>"
                                . "<td><a href='#/grupo/alunos/tipo/addAluno/idGrupo/".$id."/idAluno/".$row['idAluno'] . "' class='ajax-relacionar'><i class='fa fa-plus'></i></a></td>"
                                . "</tr>";
                    }
                }else{
                    $conteudo = "<tr>"
                            . "<td colspan='3'>A pesquisa não retornou nenhum resultado</td>"
                            . "</tr>";
                }

                echo json_encode(array(
                    "aluno" => "true",
                    "conteudo" => $conteudo
                ));
//                print($q);
                break;
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
            case "cadastrarQuestao":
                $idQuest = (isset($_POST['idQuestionario'])) ? $_POST['idQuestionario'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idCorreta = (isset($_POST['correta'])) ? $_POST['correta'] : null;

                $q = mysqli_query($con, "INSERT INTO questao (titulo, idQuestionario) VALUES ('{$titulo}', {$idQuest})");
                $q = mysqli_insert_id($con);
                unset($_POST['idQuestionario'], $_POST['titulo'], $_POST['correta'], $_POST['tipo']);

                $i = 1;
                foreach ($_POST as $key => $value) {
                    $c = (int) ($i == $idCorreta);
                    mysqli_query($con, "INSERT INTO alternativa (titulo, correta, idQuestao) VALUES ('{$value}', '{$c}', '{$q}')");
                    $i++;
                }
                echo json_encode(array(
                    "redirect" => "#/questionario/questoes/idQuestionario/" . $idQuest,
                ));
                break;
            case "cadastrarQuestaquiz":
                $idQuiz = (isset($_POST['idQuiz'])) ? $_POST['idQuiz'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idCorreta = (isset($_POST['correta'])) ? $_POST['correta'] : null;

                $q = mysqli_query($con, "INSERT INTO questaoquiz (titulo, idQuiz) VALUES ('{$titulo}', {$idQuiz})");
                $q = mysqli_insert_id($con);
                unset($_POST['idQuiz'], $_POST['titulo'], $_POST['correta'], $_POST['tipo']);

                $i = 1;
                foreach ($_POST as $key => $value) {
                    $c = (int) ($i == $idCorreta);
                    mysqli_query($con, "INSERT INTO alternativaquiz (titulo, correta, idQuestaoquiz) VALUES ('{$value}', '{$c}', '{$q}')");
                    $i++;
                }
                echo json_encode(array(
                    "redirect" => "#/quiz/questoes/idQuiz/" . $idQuiz,
                ));
                break;
            case "cadastrarQuiz":
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $tipoQuiz = (isset($_POST['tipoQuiz'])) ? $_POST['tipoQuiz'] : null;
                $tempo = (isset($_POST['tempo'])) ? $_POST['tempo'] : null;
                $idProf = $_SESSION['user']['id'];
                $q = mysqli_query($con, "INSERT INTO quiz (titulo, tipo, tempo, idProfessor) values ('{$titulo}', '{$tipoQuiz}', '{$tempo}','{$idProf}')");
                echo json_encode(array(
                    "redirect" => "#/quiz/listar",
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
                    "redirect" => "#/slides/cadastrarImg/idSlide/" . $idSlide,
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
                    "redirect" => "#/aula/materiais/idAula/" . $idAula,
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
            case "editarGrupo":
                $id = (isset($_POST['idGrupo'])) ? $_POST['idGrupo'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $q = mysqli_query($con, "UPDATE grupo SET titulo = '{$titulo}' where idGrupo = {$id}");

                echo json_encode(array(
                    "redirect" => "#/grupo/listar",
                ));
                break;
            case "editarQuestao":
                $idQuest = (isset($_POST['idQuestao'])) ? $_POST['idQuestao'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idCorreta = (isset($_POST['correta'])) ? $_POST['correta'] : null;

                $q = mysqli_query($con, "UPDATE questao SET titulo = '{$titulo}' where idQuestao = {$idQuest}");
                unset($_POST['idQuestao'], $_POST['titulo'], $_POST['correta'], $_POST['tipo']);
                foreach ($_POST as $key => $value) {
                    $c = (int) ($key == $idCorreta);
                    mysqli_query($con, "UPDATE alternativa SET titulo = '{$value}', correta = $c where idAlternativa = {$key}");
                }
                echo json_encode(array(
                    "redirect" => "#/questionario/edit-questao/idQuestao/" . $idQuest,
                ));
                break;
            case "editarQuestaoquiz":
                $idQuestao = (isset($_POST['idQuestaoquiz'])) ? $_POST['idQuestaoquiz'] : null;
                $idQuiz = (isset($_POST['idQuiz'])) ? $_POST['idQuiz'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idCorreta = (isset($_POST['correta'])) ? $_POST['correta'] : null;

                $q = mysqli_query($con, "UPDATE questaoquiz SET titulo = '{$titulo}' where idQuestaoquiz = {$idQuestao}");
                unset($_POST['idQuestaoquiz'], $_POST['idQuiz'], $_POST['titulo'], $_POST['correta'], $_POST['tipo']);
                foreach ($_POST as $key => $value) {
                    $c = (int) ($key == $idCorreta);
                    mysqli_query($con, "UPDATE alternativaquiz SET titulo = '{$value}', correta = $c where idAlternativaquiz = {$key}");
                }
                echo json_encode(array(
                    "redirect" => "#/quiz/edit-questao/idQuestaoquiz/" . $idQuestao . "/idQuiz/" . $idQuiz,
                ));
                break;
            case "editarQuestionario":
                $idQuest = (isset($_POST['idQuestionario'])) ? $_POST['idQuestionario'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $q = mysqli_query($con, "UPDATE questionario SET titulo = '{$titulo}' where idQuestionario = {$idQuest}");

                echo json_encode(array(
                    "redirect" => "#/questionario/editar/idQuestionario/" . $idQuest,
                ));
                break;
            case "editarQuiz":
                $idQuiz = (isset($_POST['idQuiz'])) ? $_POST['idQuiz'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $tipoQuiz = (isset($_POST['tipoQuiz'])) ? $_POST['tipoQuiz'] : null;
                $tempo = (isset($_POST['tempo'])) ? $_POST['tempo'] : null;
                $q = mysqli_query($con, "UPDATE quiz SET titulo = '{$titulo}', tipo = {$tipoQuiz}, tempo = {$tempo} where idQuiz = {$idQuiz}");
                echo json_encode(array(
                    "redirect" => "#/quiz/listar",
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
                    "redirect" => "#/slides/cadastrarImg/idSlide/" . $idSlide,
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
                    "redirect" => "#/aula/relacionar/cdTipo/" . $cdTipo . "/idAula/" . $idAula,
                ));
                break;
            case "relacionarAulas":
                $idAula = (isset($_POST['idAula'])) ? $_POST['idAula'] : null;
                $idGrupo = (isset($_POST['idGrupo'])) ? $_POST['idGrupo'] : null;
                mysqli_query($con, "INSERT INTO grupoaula (idAula, idGrupo) values ('{$idAula}','{$idGrupo}')");
                echo json_encode(array(
                    "redirect" => "#/grupo/relacionar/idGrupo/" . $idGrupo,
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
