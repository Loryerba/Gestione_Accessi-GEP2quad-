<?php
session_start();

//Check sessions
if ((isset($_SESSION['oggettoMeeting'])) && (isset($_SESSION['nominativoCliente'])) && (isset($_SESSION['emailCliente'])) && (isset($_SESSION['nominativoAdmin'])) && (isset($_SESSION['emailAdmin'])) && (isset($_SESSION['dataora']))) {
    //Require class phpmailer
    require_once('phpmailer/PHPMailerAutoload.php');

    //Get element of event
    $oggettoMeeting = $_SESSION['oggettoMeeting'];
    $nominativoCliente = $_SESSION['nominativoCliente'];
    $emailCliente = $_SESSION['emailCliente'];
    $nominativoAdmin = $_SESSION['nominativoAdmin'];
    $emailAdmin = $_SESSION['emailAdmin'];
    $dataora = $_SESSION['dataora'];

    //Setting event
    //Check if meeting description isset
    $checkDescription = false;
    if (!isset($_SESSION['descrizioneMeeting'])) {
        $ical_content = "BEGIN:VCALENDAR
        VERSION:2.0
        PRODID://Drupal iCal API//EN
        BEGIN:VEVENT
        UID:http://www.icalmaker.com/event/d8fefcc9-a576-4432-8b20-40e90889affd
        DTSTAMP:$dataora
        DTSTART:$dataora
        DTEND:$dataora
        SUMMARY:$oggettoMeeting
        LOCATION:Sede L2GM
        END:VEVENT
        END:VCALENDAR";
    } else {
        $descrizione = $_SESSION['descrizioneMeeting'];
        $checkDescription = true;
        $ical_content = "BEGIN:VCALENDAR
        VERSION:2.0
        PRODID://Drupal iCal API//EN
        BEGIN:VEVENT
        UID:http://www.icalmaker.com/event/d8fefcc9-a576-4432-8b20-40e90889affd
        DTSTAMP:$dataora
        DTSTART:$dataora
        DTEND:$dataora
        SUMMARY:$oggettoMeeting
        LOCATION:Sede L2GM
        DESCRIPTION:$descrizione
        END:VEVENT
        END:VCALENDAR";
    }

    //Create e-mail's structure
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = 'testdavide2021@gmail.com';
    $mail->Password = 'test12342021';
    $mail->setFrom('testdavide2021@gmail.com');
    $mail->Subject = 'Richiesta appuntamento';
    $mail->Body = "<h1>Richiesta appuntamento da $emailCliente</h1><p>$nominativoCliente richiede un appuntamento</p><p>Oggetto: $oggettoMeeting</p>";

    $mail->addAddress($emailAdmin);

    //Check sending email
    if ($mail->send()) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?ok=1");
        deleteSession();
        exit();
    } else {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=9");
        deleteSession();
        exit();
    }
} else {
    //Return to 'AccessoOspite.php'
    header("Location: ../AccessoOspite.php?error=10");
    exit();
}

//Delete all sessions
function deleteSession()
{
    session_destroy();
}
