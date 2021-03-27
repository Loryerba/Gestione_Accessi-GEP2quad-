<?php

//Function called to connect to the dc
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
        //Error connection
        return false;
    } else {
        //All ok, return 'conn'
        return $conn;
    }
}
