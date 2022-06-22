<?php

function connect()
{
    $dbhost = "localhost";
    $dbname = "yourcoin";
    $dbuser = "root";
    $dbpass = "";

    $base = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($base->connect_error) {
        die("Connection error: " . $base->connect_error);
    }

    return $base;
}
?>