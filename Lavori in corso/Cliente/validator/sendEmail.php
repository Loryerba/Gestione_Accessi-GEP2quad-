<?php
session_start();

//Check sessions
if ((isset($_SESSION['oggettoMeeting'])) && (isset($_SESSION['nominativoCliente'])) && (isset($_SESSION['emailCliente'])) && (isset($_SESSION['nominativoAdmin'])) && (isset($_SESSION['emailAdmin'])) && (isset($_SESSION['data'])) && (isset($_SESSION['ora']))) {
    //Require class phpmailer
    include('phpmailer/PHPMailerAutoload.php');
    
    $event_id = 1234;
    $sequence = 0;
    $status = 'CONFIRMED';

    //Get element of event
    $oggettoMeeting = $_SESSION['oggettoMeeting'];
    $nominativoCliente = $_SESSION['nominativoCliente'];
    $emailCliente = $_SESSION['emailCliente'];
    $nominativoAdmin = $_SESSION['nominativoAdmin'];
    $emailAdmin = $_SESSION['emailAdmin'];
    $date = $_SESSION['data'];
    $time = $_SESSION['ora'];

    $datenewTemp = explode("-", $date);
    $datenew = $datenewTemp[0] . $datenewTemp[1] . $datenewTemp[2];

    $timenew1Temp = explode(":", $time);
    $timenew1 = $timenew1Temp[0].$timenew1Temp[1]."00";

    $timenew2Temp = intval($timenew1Temp[0]);
    $timenew2Temp += 1;
    $timenew2 = $timenew2Temp.$timenew1Temp[1]."00";

    $start = $datenew;
    $start_time = $timenew1;
    $end = $datenew;
    $end_time = $timenew2;

    //PHPMailer
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    //$mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Username = 'testdavide2021@gmail.com';
    $mail->Password = 'test12342021';
    $mail->IsHTML(false);
    $mail->setFrom($emailCliente, $nominativoCliente);
    $mail->addReplyTo('testdavide2021@gmail.com', 'L2GM');
    $mail->addAddress($emailAdmin, $nominativoAdmin);
    $mail->ContentType = 'text/calendar';

    $mail->Subject = "Nuova richiesta di meeting da $nominativoCliente (clicca per accettare)";
    $mail->addCustomHeader('MIME-version', "1.0");
    $mail->addCustomHeader('Content-type', "text/calendar; method=REQUEST; charset=UTF-8");
    $mail->addCustomHeader('Content-Transfer-Encoding', "7bit");
    $mail->addCustomHeader('X-Mailer', "Microsoft Office Outlook 12.0");
    $mail->addCustomHeader("Content-class: urn:content-classes:calendarmessage");

    $ical = "BEGIN:VCALENDAR\r\n";
    $ical .= "VERSION:2.0\r\n";
    $ical .= "PRODID:-//YourCassavaLtd//EateriesDept//EN\r\n";
    $ical .= "METHOD:PUBLISH\r\n";
    $ical .= "BEGIN:VEVENT\r\n";
    $ical .= "ORGANIZER;SENT-BY=\"MAILTO:$emailCliente\":MAILTO:$emailCliente\r\n";
    $ical .= "ATTENDEE;CN=them@kaserver.com;ROLE=REQ-PARTICIPANT;PARTSTAT=ACCEPTED;RSVP=TRUE:mailto:$emailCliente\r\n";
    $ical .= "UID:" . strtoupper(md5($event_id)) . "-kaserver.com\r\n";
    $ical .= "SEQUENCE:" . $sequence . "\r\n";
    $ical .= "STATUS:" . $status . "\r\n";
    $ical .= "DTSTAMPTZID=Europe/Rome:" . date('Ymd') . 'T' . date('His') . "\r\n";
    $ical .= "DTSTART:" . $start . "T" . $start_time . "\r\n";
    $ical .= "DTEND:" . $end . "T" . $end_time . "\r\n";
    $ical .= "LOCATION:" . 'Sede L2GM' . "\r\n";
    $ical .= "SUMMARY:" . $_SESSION['oggettoMeeting'] . "\r\n";
    if (!isset($_SESSION['descrizioneMeeting'])) {
        $ical .= "DESCRIPTION:" . "Nessuna descrizione" . "\r\n";
    } else {
        $ical .= "DESCRIPTION:" . $_SESSION['descrizioneMeeting'] . "\r\n";
    }
    $ical .= "BEGIN:VALARM\r\n";
    $ical .= "TRIGGER:-PT15M\r\n";
    $ical .= "ACTION:DISPLAY\r\n";
    $ical .= "DESCRIPTION:Reminder\r\n";
    $ical .= "END:VALARM\r\n";
    $ical .= "END:VEVENT\r\n";
    $ical .= "END:VCALENDAR\r\n";

    $mail->Body = $ical;

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
