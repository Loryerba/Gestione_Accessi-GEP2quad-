<?php

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
$mail->Username = '';
$mail->Password = '';
$mail->setFrom("");
$mail->Subject = 'Hi';
$mail->Body = '<h1>Test e-mail with PHP</h1>
                <p>ciao</p>';
$mail->addAddress('');
//Send
$mail->send();