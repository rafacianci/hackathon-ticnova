<?php

ob_start();
session_start();

define('APP_TITLE', 'Hackathon');
define('URL_LOGIN', '/pages/auth/login.php');

function dateView($data){
    return date("d/m/Y", strtotime($data));
}

function dateDb($data){
    return strtotime(join("-", array_reverse(explode("/", $data))));
}