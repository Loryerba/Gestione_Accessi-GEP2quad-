<?php
session_start();

if ((isset($_SESSION['to'])) && (isset($_SESSION['nominativoCliente'])) && (isset($_SESSION['emailCliente']))) {
    //Require class phpmailer
    require_once('phpmailer/PHPMailerAutoload.php');

    //Get email
    $to = $_SESSION['to'];
    $nominativoCliente = $_SESSION['nominativoCliente'];
    $emailCliente = $_SESSION['emailCliente'];

    //Create e-mail
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
    $mail->Body = "<h1>Richiesta appuntamento da $emailCliente</h1>
                <p>$nominativoCliente richiede un appuntamento con te</p>";
    $mail->addAddress($to);

    //Send
    if ($mail->send()) {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?ok=Email inviata con successo");
        exit();
    } else {
        //Return to 'AccessoOspite.php'
        header("Location: ../AccessoOspite.php?error=Errore nell'invio dell'email di richiesta, riprova");
        exit();
    }
} else {
    //Return to 'AccessoOspite.php'
    header("Location: ../AccessoOspite.php");
    exit();
}
