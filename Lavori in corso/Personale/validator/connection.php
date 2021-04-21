<?php

function connect($name)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = $name;
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        return false;
    } else {
        return $conn;
    }
}
