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
        header("Location: ../AccessoOspite.php?error=1");
        exit();
    } else if ((date('l', strtotime($meetingTime)) == 'Sunday') || (date('l', strtotime($meetingTime)) == 'Saturday')) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=2");
        exit();
    } else if (!checkTime($meetingTime)) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=11");
        exit();
    } else if (($name == "") || ($name == null)) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=3");
        exit();
    } else if (($meetingObject == "") || ($meetingObject == null)) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=4");
        exit();
    } else if (($meetingEmployee == "") || ($meetingEmployee == null) || ($meetingEmployee == "Seleziona qualcuno")) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=5");
        exit();
    } else if (($meetingEmailClient == "") || ($meetingEmailClient == null)) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=6");
        exit();
    } else if (!filter_var($meetingEmailClient, FILTER_VALIDATE_EMAIL)) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=7");
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
                $nome = $row['Nome'];
                $cognome = $row['Cognome'];
            }

            if (!(($_GET["meeting-description"] == "") || ($_GET["meeting-description"] == null))) {
                $_SESSION['descrizioneMeeting'] = $_GET["meeting-description"];
            }

            $_SESSION['oggettoMeeting'] = $meetingObject;
            $_SESSION['nominativoCliente'] = $cognome . " " . $nome;
            $_SESSION['emailCliente'] = $meetingEmailClient;
            $_SESSION['nominativoAdmin'] = $meetingEmployee;
            $_SESSION['emailAdmin'] = $emailAdmin;
            $_SESSION['dataora'] = $meetingTime;

            header("Location: sendEmail.php");
            exit();
        } else {
            //Return to 'AccessoOspite.php'
            header("Location: ../AccessoOspite.php?error=8");
            exit();
        }
    }
}

//Check if the event's time is correct
function checkTime($temp)
{
    $dt = new DateTime($temp);
    $date = $dt->format('d-m-Y');
    $time = $dt->format('h:i A');

    //Check if the hour are 12
    $time1 = $dt->format('h:i');
    $temp = explode(":", $time1);
    $t = intval($temp[0]);

    if ((strpos($time, "PM")) && ($t != 12)) {
        $time = $dt->format('h:i');
        $temp = explode(":", $time);
        $t = intval($temp[0]);
        $t += 12;
        $time = $t . ":" . $temp[1];
    }

    $orarioapertura = new DateTime("08:00");
    $orariochiusura = new DateTime("17:30");
    $orario = new DateTime($time);

    if ($orario >= $orarioapertura && $orario <= $orariochiusura) {
        return true;
    } else {
        return false;
    }
}
