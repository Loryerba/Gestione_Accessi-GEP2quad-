<?php

//Function called to connect to the dc
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
        //Error connection
        return false;
    } else {
        //All ok, return 'conn'
        return $conn;
    }
}
