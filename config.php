<?php

ob_start();
session_start();

define('APP_TITLE', 'Hackathon');
define('URL_LOGIN', '/pages/auth/login.php');
define('MATERIAL_QUESTIONARIO', 1);
define('MATERIAL_SLIDE', 2);
define('MATERIAL_VIDEO', 3);

function dateView($data){
    return date("d/m/Y", strtotime($data));
}

function dateDb($data){
    return join("-", array_reverse(explode("/", $data)));
}