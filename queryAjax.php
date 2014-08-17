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

            default:
                break;
        }
    }
}
