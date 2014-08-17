<?php
require_once '../../config.php';

unset($_SESSION['user']);
header('location: /index.php');
