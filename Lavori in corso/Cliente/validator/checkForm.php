<?php
session_start();

//Check get
if (isset($_GET['submit-meeting'])) {
    //Get values from method GET
    $meetingTime = $_GET["meeting-time"];
    $name = $_GET["meeting-nameClient"];
    $meetingObject = $_GET["meeting-object"];
    $meetingDescription = $_GET["meeting-description"];
    $meetingEmployee = $_GET["meeting-employee"];
    $meetingEmailClient = $_GET["meeting-emailClient"];

    //Check values
    if (($meetingTime == "") || ($meetingTime == null)) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=Data e ora del meeting non selezionate");
        exit();
    } else if (($name == "") || ($name == null)) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=Nominativo non inserito");
        exit();
    } else if (($meetingObject == "") || ($meetingObject == null)) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=Nessun oggetto del meeting inserito");
        exit();
    } else if (($meetingEmployee == "") || ($meetingEmployee == null) || ($meetingEmployee == "Seleziona qualcuno")) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=Nessun impiegato selezionato");
        exit();
    } else if (($meetingEmailClient == "") || ($meetingEmailClient == null)) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=Nessuna email inserita");
        exit();
    } else if (!filter_var($meetingEmailClient, FILTER_VALIDATE_EMAIL)) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=Email non valida");
        exit();
    } else {

        //Query
        $sql = "SELECT * FROM Administrator WHERE Id_A = '$meetingEmployee'";

        include 'connection.php';
        $conn = connect('id16206619_dbaccessi');

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $emailAdmin = $row['Email'];
            }

            $_SESSION['nominativoCliente'] = $name;
            $_SESSION['emailCliente'] = $meetingEmailClient;
            $_SESSION['to'] = $emailAdmin;

            header("Location: sendEmail.php");
            exit();
        } else {
            //Return to 'AccessoOspite.php'
            header("Location: ../AccessoOspite.php?error=Errore invio form, riprova");
            exit();
        }
    }
}
