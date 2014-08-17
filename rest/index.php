<?php

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
            $con = Database::getCon();
            $q = mysqli_query($con, "select * from ");
            break;

        default:
            break;
    }
}