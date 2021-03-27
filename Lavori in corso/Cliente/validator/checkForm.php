<?php
session_start();
include 'connection.php';

//Check get
if (isset($_GET['submit-meeting'])) {
    //Get values from method GET
    $meetingDate = $_GET["meeting-date"];
    $meetingTime = $_GET["meeting-time"];
    $name = $_GET["meeting-nameClient"];
    $meetingObject = $_GET["meeting-object"];
    $meetingDescription = $_GET["meeting-description"];
    $meetingEmployee = $_GET["meeting-employee"];
    $meetingEmailClient = $_GET["meeting-emailClient"];

    //Check values
    if (($meetingDate == "") || ($meetingDate == null)) {
        //Return to 'AccessoOspite.php' with error = 1
        header("Location: ../AccessoOspite.php?error=1");
        exit();
    } else if (($meetingTime == "") || ($meetingTime == null)) {
        //Return to 'AccessoOspite.php' with error = 12
        header("Location: ../AccessoOspite.php?error=12");
        exit();
    }
    //Check if the date is not saturday and sunday
    else if ((date('l', strtotime($meetingDate)) == 'Sunday') || (date('l', strtotime($meetingDate)) == 'Saturday')) {
        //Return to 'AccessoOspite.php' with error = 2
        header("Location: ../AccessoOspite.php?error=2");
        exit();
    } else if (!checkTime($meetingTime)) {
        //Return to 'AccessoOspite.php' with error = 11
        header("Location: ../AccessoOspite.php?error=11");
        exit();
    } else if (($name == "") || ($name == null)) {
        //Return to 'AccessoOspite.php' with error = 3
        header("Location: ../AccessoOspite.php?error=3");
        exit();
    } else if (($meetingObject == "") || ($meetingObject == null)) {
        //Return to 'AccessoOspite.php' with error = 4
        header("Location: ../AccessoOspite.php?error=4");
        exit();
    } else if (($meetingEmployee == "") || ($meetingEmployee == null) || ($meetingEmployee == "Seleziona qualcuno")) {
        //Return to 'AccessoOspite.php' with error = 5
        header("Location: ../AccessoOspite.php?error=5");
        exit();
    } else if (($meetingEmailClient == "") || ($meetingEmailClient == null)) {
        //Return to 'AccessoOspite.php' with error = 6
        header("Location: ../AccessoOspite.php?error=6");
        exit();
    }
    //Check email format 
    else if (!filter_var($meetingEmailClient, FILTER_VALIDATE_EMAIL)) {
        //Return to 'AccessoOspite.php' with error = 7
        header("Location: ../AccessoOspite.php?error=7");
        exit();
    } else {
        //All ok, connection to db to get the email of administrator
        //Query
        $sql = "SELECT * FROM Administrator WHERE Id_A = '$meetingEmployee'";

        //Connection
        $conn = connect('id16206619_dbaccessi');
        $result = $conn->query($sql);

        //Check result of connection
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $emailAdmin = $row['Email'];
                $nome = $row['Nome'];
                $cognome = $row['Cognome'];
            }

            //Check if there is a description of the meeting
            if (!(($_GET["meeting-description"] == "") || ($_GET["meeting-description"] == null))) {
                $_SESSION['descrizioneMeeting'] = $_GET["meeting-description"];
            }

            //Set session with values
            $_SESSION['oggettoMeeting'] = $meetingObject;
            $_SESSION['nominativoCliente'] = $cognome . " " . $nome;
            $_SESSION['emailCliente'] = $meetingEmailClient;
            $_SESSION['nominativoAdmin'] = $meetingEmployee;
            $_SESSION['emailAdmin'] = $emailAdmin;
            $_SESSION['ora'] = $meetingTime;
            $_SESSION['data'] = $meetingDate;

            //Send email page
            header("Location: sendEmail.php");
            exit();
        } else {
            //Return to 'AccessoOspite.php' with error = 8
            header("Location: ../AccessoOspite.php?error=8");
            exit();
        }
    }
}

//Check if the event's time is correct
function checkTime($temp)
{
    $orarioapertura = new DateTime("08:00");
    $orariochiusura = new DateTime("17:30");
    $orario = new DateTime($temp);

    //Check
    if ($orario >= $orarioapertura && $orario <= $orariochiusura) {
        //Between 2 times
        return true;
    } else {
        return false;
    }
}
