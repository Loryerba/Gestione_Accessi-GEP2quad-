<?php
if (!isset($_SESSION)) {
    session_start();
}
//Require class phpmailer
require_once('phpmailer/PHPMailerAutoload.php');
include 'connection.php';
$dbname = "id16206619_dbaccessi";
$apertura = "08:00";
$chiusura = "17:30";
//controllo se è stato effettuata una richiesta POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //controllo se tutti i campi sono compilati
    if (
        empty($_POST['n_ademail']) || empty($_POST['n_clemail']) || empty($_POST['n_descrizione']) || empty($_POST['datameeting']) || empty($_POST['n_orameeting'])
    ) {
        //caso in cui alcuni campi sono vuoti
        //redirect alla pagina creameeting.php con error type = 1
        // errror => 1 => Compilare tutti i campi
        redirect(1);
    } else {
        //controllo se l'orario inserito è corretto
        $orario = new DateTime($_POST['n_orameeting']);
        $orarioapertura = new DateTime($apertura);
        $orariochiusura = new DateTime($chiusura);
        if ($orario >= $orarioapertura && $orario <= $orariochiusura) {
            //controllo se la data inserita non è nel weekend
            if (!(date('l', strtotime($_POST['datameeting'])) == "Saturday" || date('l', strtotime($_POST['datameeting'])) == "Sunday")) {
                $datameeting = $_POST['datameeting'];
                //ottengo la mail dell'amministratore
                $emailad = test_input($_POST['n_ademail']);
                //connessione al database
                $conn = connect($dbname);
                //query d'interrogazione del database per ottenere i dati relativi all'amministratore identificato dalla mail inserita
                $sql = "SELECT Id_A,Nome,Cognome FROM Administrator WHERE Email = '$emailad'";
                //esecuzione della query 
                $result = $conn->query($sql);
                //controllo se la query ha prodotto 1 risultato
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    //ottengo l'id del'amministratore
                    $ida = $row['Id_A'];
                    //ottengo la mail del cliente
                    $emailcl = test_input($_POST['n_clemail']);
                    //query d'interrogazione al database per ottenere i dati relativi al cliente identificato dalla mail inserita
                    $sql = "SELECT Id_P,Nome,Cognome FROM Partecipanti WHERE Email = '$emailcl'";
                    //esecuzione della query
                    $result = $conn->query($sql);
                    //controllo se la query ha prodotto 1 risultato
                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        // ottengo l'id del cliente
                        $idc = $row['Id_P'];
                        // ottengo la descrizione del meeting
                        $descrizione = $_POST['n_descrizione'];
                        addMeeting($ida, $idc, $orario, $datameeting, $descrizione, $conn);
                    } else {

                        // chiusura connessione al database
                        $conn->close();
                        // caso in cui vengono prodotti più risultati di 1 oppure nessun risultato
                        // redirect alla pagina creameeting.php con error type = 3
                        // error => 3 => Errore durante l'interrogazione al database per cliente
                        redirect(3);
                    }
                } else {
                    // chiusura connessione al database
                    $conn->close();
                    // caso in cui vengono prodotti più risultati di 1 oppure nessun risultato
                    // redirect alla pagina creameeting.php con error type = 2
                    // error => 2 => Errore durante l'interrogazione al database per amministratore
                    redirect(2);
                }
            } else {
                // caso in cui viene selezionata una data non valida
                // redirect alla pagina creameeting.php con error type = 5
                // error => 5 => Data non valida
                redirect(5);
            }
        } else {
            // caso in cui viene inserito un orario che non rientra in quello valido
            // redirect alla pagina creameeting.php con errror type = 4
            // error => 4 => Oraio non valido
            redirect(4);
        }
    }
}


function redirect($errortype)

{

    header("Location: ../creameeting.php?error=$errortype");

    exit();
}

function goback()

{

    header("Location: ../creameeting.php?confirm=1");

    exit();
}
function test_input($data)

{

    //rimozione spazi bianchi o caratteri predefiniti

    $data = trim($data);

    //rimozione backslash aggiunti con la funzione addslashes()

    $data = stripslashes($data);

    //conversione dei caratteri predefiniti in entità html

    $data = htmlspecialchars($data);

    return $data;
}


function addMeeting($ida, $idc, $orario, $datameeting, $descrizione, $conn)
{
    // riformattazione dell'orario nel formato accettato dal database
    $orario = $orario->format('H:i');
    // query per inserire nel database il meeting
    $sql = "INSERT INTO Meeting (DataM,OraM,Id_A,Id_P,Descrizione) VALUES ('$datameeting', '$orario', '$ida', '$idc', '$descrizione')";
    // esecuzione della query
    if ($conn->query($sql)) {
        //registrazione del log
        updateLog($conn);
        //funzione che invia la mail col qr code


        //Create e-mail
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();
        $mail->Username = 'lorenzoerba250@gmail.com';
        $mail->Password = 'Portocesareo25';
        $mail->Subject = 'Hi';
        $mail->Body = '<h1>prova erba ada2</h1> 
                <p>ciao</p>';
        $mail->addAddress('cestinodirete@gmail.com');
        //Send
        //se l'invio della mail ha prodotto errori
        // redirect alla pagina index con error type = 8
        // error => 8 => Errore durante l'invio della mail
        if (!$mail->send()) {
            $conn->close();
            redirect(8);
        } else {
            $conn->close();
            goback();
        }
    } else {
        // caso in cui avviene un errore nell'inserimento nel database
        // redirect alla pagina creameeting.php con errror type = 6
        // error => 6 => Errore durante l'interrogazione del database per meeting
        redirect(6);
        $conn->close();
    }
}


function updateLog($conn)
{
    //ottengo l'orario attuale
    $time = new DateTime('now', new DateTimeZone('Europe/Rome'));
    $time = $time->format('H:i');
    //ottengo la data attuale
    $date = new DateTime('now', new DateTimeZone('Europe/Rome'));
    $date = $date->format("Y-m-d");
    // descrizione del log
    $description = "Administrator created a meeting";
    $id = $_SESSION['idadmin'];
    // query per inserire nel database il  log
    $sql = "INSERT INTO Logs (OraL,DataL,Descrizione,Id_A) VALUES ('$time', '$date', '$description', $id)";
    if ($conn->query($sql) == FALSE) {
        // caso in cui avviene un errore nell'inserimento nel database
        // redirect alla pagina creameeting.php con errror type = 7
        // error => 7 => Errore durante l'interrogazione del database per log
        $conn->close();
        redirect(7);
    }
}
