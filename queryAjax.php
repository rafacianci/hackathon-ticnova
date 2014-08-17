<?php

require_once '/config.php';
require_once '/db.php';

$con = Database::getCon();

if ($_POST) {
    if (isset($_POST['tipo'])) {
        switch ($_POST['tipo']) {
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
            case "editarVideos":
                $id = (isset($_POST['idVideo'])) ? $_POST['idVideo'] : null;
                $url = (isset($_POST['url'])) ? $_POST['url'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $q = mysqli_query($con, "UPDATE video SET url = '{$url}', titulo = '{$titulo}' where idVideo = {$id}");
                
                echo json_encode(array(
                    "redirect" => "#/videos/listar",
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
            case "cadastrarVideos":
                $url = (isset($_POST['url'])) ? $_POST['url'] : null;
                $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : null;
                $idProf = $_SESSION['user']['id'];
                $q = mysqli_query($con, "INSERT INTO video (titulo, url, idProfessor) values ('{$titulo}','{$url}','{$idProf}')");
                echo json_encode(array(
                    "redirect" => "#/videos/listar",
                ));
                break;
            default:
                break;
        }
    }
}
