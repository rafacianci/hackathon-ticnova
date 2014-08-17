<?php

class Database {

    public static function getCon() {
        return mysqli_connect('localhost', 'root', '', 'hackathon');
    }
}