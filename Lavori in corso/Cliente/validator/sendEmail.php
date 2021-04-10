<?php
session_start();

//Check sessions
if ((isset($_SESSION['oggettoMeeting'])) && (isset($_SESSION['nominativoCliente'])) && (isset($_SESSION['emailCliente'])) && (isset($_SESSION['nominativoAdmin'])) && (isset($_SESSION['emailAdmin'])) && (isset($_SESSION['data'])) && (isset($_SESSION['ora']))) {
    //Include class phpmailer
    include('phpmailer/PHPMailerAutoload.php');

    //Get element of event
    $oggettoMeeting = $_SESSION['oggettoMeeting'];
    $nominativoCliente = $_SESSION['nominativoCliente'];
    $emailCliente = $_SESSION['emailCliente'];
    $nominativoAdmin = $_SESSION['nominativoAdmin'];
    $emailAdmin = $_SESSION['emailAdmin'];
    $date = $_SESSION['data'];
    $time = $_SESSION['ora'];

    //Get data and time withot '-' and ':'
    $datenewTemp = explode("-", $date);
    $datenew = $datenewTemp[0] . $datenewTemp[1] . $datenewTemp[2];

    $timenew1Temp = explode(":", $time);
    $timenew1 = $timenew1Temp[0] . $timenew1Temp[1] . "00";

    $timenew2Temp = intval($timenew1Temp[0]);
    $timenew2Temp += 1;
    $timenew2 = $timenew2Temp . $timenew1Temp[1] . "00";

    $start = $datenew;
    $start_time = $timenew1;
    $end = $datenew;
    $end_time = $timenew2;

    /**
     * Call function create ics file (meeting)
     * event_id, sequence
     * status ('TENTATIVE', 'CONFIRMED' or 'CANCELLED')
     * 
     */
    $event_id = 1234;
    $sequence = 0;
    $status = 'CONFIRMED';
    $ics = createICS($emailCliente, $event_id, $sequence, $status, $start, $start_time, $end, $end_time, $oggettoMeeting);

    /**
     * Call function setting email
     * 
     * Host, Port (email server)
     * Username, Password (account used to send email)
     * emailCliente, nominativoCliente (from)
     * emailAdmin, nominativoAdmin (to)
     * ics (file meeting)
     * 
     */
    $host = 'smtp.gmail.com';
    $port = '465';
    $usernameAccount = 'testdavide2021@gmail.com';
    $passwordAccount = 'test12342021';
    $mail = setEmail($host, $port, $usernameAccount, $passwordAccount, $emailCliente, $nominativoCliente, $emailAdmin, $nominativoAdmin, $ics);

    //Try send email
    if ($mail->send()) {
        /**
         * Email sent
         * Return to 'AccessoOspite.php' with ok = 1
         * Delete all sessions
         */
        header("Location: ../AccessoOspite.php?ok=1");
        deleteSession();
        exit();
    } else {
        /**
         * Email not sent
         * Return to 'AccessoOspite.php' with error = 9
         * Delete all sessions
         */
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=9");
        deleteSession();
        exit();
    }
} else {
    /**
     * Sessions not setted
     * Return to 'AccessoOspite.php' with error = 10
     */
    header("Location: ../AccessoOspite.php?error=10");
    exit();
}

//Creating ICS file (meeting)
function createICS($emailCliente, $event_id, $sequence, $status, $start, $start_time, $end, $end_time, $oggettoMeeting)
{
    $ics = "BEGIN:VCALENDAR\r\n";
    $ics .= "VERSION:2.0\r\n";
    $ics .= "PRODID:-//YourCassavaLtd//EateriesDept//EN\r\n";
    $ics .= "METHOD:PUBLISH\r\n";
    $ics .= "BEGIN:VEVENT\r\n";
    $ics .= "ORGANIZER;SENT-BY=\"MAILTO:$emailCliente\":MAILTO:$emailCliente\r\n";
    $ics .= "ATTENDEE;CN=them@kaserver.com;ROLE=REQ-PARTICIPANT;PARTSTAT=ACCEPTED;RSVP=TRUE:mailto:$emailCliente\r\n";
    $ics .= "UID:" . strtoupper(md5($event_id)) . "-kaserver.com\r\n";
    $ics .= "SEQUENCE:" . $sequence . "\r\n";
    $ics .= "STATUS:" . $status . "\r\n";
    $ics .= "DTSTAMPTZID=Europe/Rome:" . date('Ymd') . 'T' . date('His') . "\r\n";
    $ics .= "DTSTART:" . $start . "T" . $start_time . "\r\n";
    $ics .= "DTEND:" . $end . "T" . $end_time . "\r\n";
    $ics .= "LOCATION:" . 'Sede L2GM' . "\r\n";
    $ics .= "SUMMARY:" . $oggettoMeeting . "\r\n";
    if (!isset($_SESSION['descrizioneMeeting'])) {
        $ics .= "DESCRIPTION:" . "Nessuna descrizione" . "\r\n";
    } else {
        $ics .= "DESCRIPTION:" . $_SESSION['descrizioneMeeting'] . "\r\n";
    }
    $ics .= "BEGIN:VALARM\r\n";
    $ics .= "TRIGGER:-PT15M\r\n";
    $ics .= "ACTION:DISPLAY\r\n";
    $ics .= "DESCRIPTION:Reminder\r\n";
    $ics .= "END:VALARM\r\n";
    $ics .= "END:VEVENT\r\n";
    $ics .= "END:VCALENDAR\r\n";

    return $ics;
}

//Setting email
function setEmail($host, $port, $usernameAccount, $passwordAccount, $emailCliente, $nominativoCliente, $emailAdmin, $nominativoAdmin, $ics)
{
    //Create email
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = $host;
    $mail->Port = $port;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Username = $usernameAccount;
    $mail->Password = $passwordAccount;
    $mail->IsHTML(false);
    $mail->setFrom($emailCliente, $nominativoCliente);
    $mail->addReplyTo($emailCliente, 'L2GM');
    $mail->addAddress($emailAdmin, $nominativoAdmin);
    $mail->ContentType = 'text/calendar';

    //Check if the domain of the admin is google
    if (strpos($emailAdmin, "@gmail")) {
        $mail->Subject = "Nuova richiesta di meeting da $nominativoCliente";
    } else {
        $mail->Subject = "Nuova richiesta di meeting da $nominativoCliente (clicca sul file per visualizzare)";
    }


    //Add information (ics)
    $mail->addCustomHeader('MIME-version', "1.0");
    $mail->addCustomHeader('Content-type', "text/calendar; method=REQUEST; charset=UTF-8");
    $mail->addCustomHeader('Content-Transfer-Encoding', "7bit");
    $mail->addCustomHeader('X-Mailer', "Microsoft Office Outlook 12.0");
    $mail->addCustomHeader("Content-class: urn:content-classes:calendarmessage");

    //Add ics
    $mail->Body = $ics;
    return $mail;
}

//Delete all sessions
function deleteSession()
{
    session_destroy();
}
