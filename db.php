<?php

class Database {

    public static function getCon() {
        return mysqli_connect('localhost', 'root', '', 'hackathon');
//        return mysqli_connect('138.91.117.41', 'root', '123456', 'hackathon', '3306');
    }
}