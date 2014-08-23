<?php

session_start();
session_unset();
die("<pre>file: ".__FILE__.", line: ".__LINE__."<br>".print_r("saiu", 1)."</pre>");