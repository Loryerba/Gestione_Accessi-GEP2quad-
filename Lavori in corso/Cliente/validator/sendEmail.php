<?php

if (isset($_GET['email'])) {
    //Require class phpmailer
    require_once('phpmailer/PHPMailerAutoload.php');

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
    $mail->setFrom('davidecorbetta0209@gmail.com');
    $mail->Subject = 'Hi';
    $mail->Body = 'Test e-mail with PHP';
    $remove[] = "'";
    $mail->addAddress(str_replace($remove, "", $_GET['email']));
    echo str_replace($remove, "", $_GET['email']);

    //Send
    $mail->send();
}
