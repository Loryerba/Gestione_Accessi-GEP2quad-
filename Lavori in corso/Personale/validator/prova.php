<?php
include 'connection.php';
$dbname = "id16206619_dbaccessi";
$conn = connect($dbname);
//query d'interrogazione del database per ottenere i dati relativi all'amministratore identificato dalla mail inserita
$sql = "SELECT Nome,Cognome FROM Administrator WHERE Email = 'matcacciarino@gmail.com";
//esecuzione della query 
$result = $conn->query($sql);

$row = $result->fetch_assoc();
echo $row['Nome'];
