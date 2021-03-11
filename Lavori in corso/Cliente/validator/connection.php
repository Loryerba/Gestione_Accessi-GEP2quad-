<?php

function connect($name)
{
    $servername = "localhost";
    $username = "id16206619_admin";
    $password = "U3{0nZ%!wrfGIsz$";
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
