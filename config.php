<?php

ob_start();
session_start();

define('APP_TITLE', 'TEACH');
define('URL_LOGIN', '#/auth/login');
define('MATERIAL_QUESTIONARIO', 1);
define('MATERIAL_SLIDE', 2);
define('MATERIAL_VIDEO', 3);
define('QUESTIONARIO_ATIVO', 1);

function dateView($data){
    return date("d/m/Y", strtotime($data));
}

function dateDb($data){
    return join("-", array_reverse(explode("/", $data)));
}

function getTipoMaterial($id){
    switch ($id) {
        case MATERIAL_QUESTIONARIO:
            return "Questionário";
            break;
        case MATERIAL_SLIDE:
            return "Slide";
            break;
        case MATERIAL_VIDEO:
            return "Vídeo";
            break;
        default:
            break;
    }
}