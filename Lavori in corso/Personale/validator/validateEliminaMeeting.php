<?php
include 'connection.php';
$dbname = "id16206619_dbaccessi";
$conn = connect($dbname);
if(!$conn){
    /**
             * caso in cui non viene fatta la connessione
             * 
             * error => 2 => Not connection
             */
            header("location: ../eliminameeting.php?error=1");
            die();
}
else{
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "DELETE FROM Meeting WHERE Id_M = $id";
        if ($conn->query($sql) == TRUE) {
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

