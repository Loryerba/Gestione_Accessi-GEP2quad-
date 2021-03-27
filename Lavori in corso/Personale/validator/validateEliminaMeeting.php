<?php
include 'connection.php';
if (!isset($_SESSION)) {
    session_start();
}
$dbname = "id16206619_dbaccessi";
$conn = connect($dbname);
if (!$conn) {
    /**
     * caso in cui non viene fatta la connessione
     * 
     * error => 2 => Not connection
     */

    header("location: ../eliminameeting.php?error=1");
    die();
} else {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "DELETE FROM Meeting WHERE Id_M = $id";
        if ($conn->query($sql) == TRUE) {
            //registrazione del log
            updateLog($conn,$id);
            $conn->close();
            /**
             * confirm => 1 => Record eliminato con successo
             */
            header("location: ../eliminameeting.php?confirm=1");
            die();
        } else {
            $conn->close();
            /**
             * caso in cui la query è andata male
             * 
             * error => 1 => Error exectuing query
             */
            header("location: ../eliminameeting.php?error=1");
            die();
        }
    }
}

function updateLog($conn,$id)
{
    //ottengo l'orario attuale
    $time = new DateTime('now', new DateTimeZone('Europe/Rome'));
    $time = $time->format('H:i');
    //ottengo la data attuale
    $date = new DateTime('now', new DateTimeZone('Europe/Rome'));
    $date = $date->format("Y-m-d");
    // descrizione del log
    $description = "Administrator deleted a meeting where id meeting is $id";
    $id = $_SESSION['idadmin'];
    // query per inserire nel database il  log
    $sql = "INSERT INTO Logs (OraL,DataL,Descrizione,Id_A) VALUES ('$time', '$date', '$description', $id)";
    if ($conn->query($sql) == FALSE) {
        // caso in cui avviene un errore nell'inserimento nel database
        // redirect alla pagina creameeting.php con errror type = 7
        // error => 7 => Errore durante l'interrogazione del database per log
        $conn->close();
        header("location: ../eliminameeting.php?error=7");
    }
}
