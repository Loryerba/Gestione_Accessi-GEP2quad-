<?php

include 'validator/connection.php';
require_once('validator/phpmailer/PHPMailerAutoload.php');
$dbname = "id16206619_dbaccessi";
$conn = connect($dbname);

//controllo se la connessione al database non ha prodotto errori
if (!$conn) {
    echo "<script> alert('Errore durante la connessione al database') </script>";
} else {
    if (isset($_GET['idm'])) {
        //ottengo via get l'id del meeting
        $idm = $_GET['idm'];
        //query sql per controllare se il cliente ha già effettuato l'accesso in azienda oppure no
        $sql = "SELECT CheckOut FROM MeP WHERE Id_M = '$idm'";
        //esecuzione della query
        $result = $conn->query($sql);
        //controllo se la query ha prodotto 1 risultato, in tal caso ciò corrisponde che il cliente ha già effettuato l'accesso e quindi sta richiedendo l'uscita.
        if ($result->num_rows == 1) {

            //aggiorno la tabella MeP per l'uscita del cliente
            updateMePUscita($conn, $idm);
        } else {
            $sql = "SELECT Meeting.DataM, Meeting.OraM, Administrator.Nome as anome, Administrator.Cognome as acognome, Administrator.Email, Partecipanti.Nome as pnome, Partecipanti.Cognome as pcognome
                FROM Administrator INNER JOIN (Partecipanti INNER JOIN Meeting ON Partecipanti.Id_P = Meeting.Id_P) ON Administrator.Id_A = Meeting.Id_A
                WHERE Meeting.Id_M = $idm";
            //esecuzione della query
            $result = $conn->query($sql);
            //ottengo la data attuale
            $date = new DateTime('now', new DateTimeZone('Europe/Rome'));
            $date = $date->format("Y-m-d");
            //controllo se la query ha prodotto 1 risultato
            if ($result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    if ($date < $row["DataM"]) {
                        //stampa del messaggio di riconoscimento del cliente
                        echo "<script> alert('$row[pnome] $row[pcognome] riconociuto per il meeting del $row[DataM] alle ore $row[OraM] con $row[anome] $row[acognome]') </script>";
                        //registrazione dell'ingresso del cliente all'interno del database
                        $valore = updateMePIngresso($conn, $idm, $row['pnome'], $row['pcognome'], $row['Email']);
                        switch ($valore) {
                            case 1:
                                echo "<center><h1>Cliente registrato. Il personale è stato avvisato, attendere prego...</h1></center>";
                                break;
                            case -1:
                                echo "<center><h1>Errore durante la registrazione dell'ingresso</h1></center>";
                                break;
                            case -2:
                                echo "<center><h1>Errore durante l'invio della mail di notifica. Il cliente risulta comunque registrato.</h1></center>";
                                break;
                            default:
                                echo "<center><h1>Errore non riconosciuto</h1></center>";
                                break;
                        };
                    } else {
                        //stampa del messaggio di non riconoscimento del cliente
                        echo "<script> alert('Cliente riconosciuto ma la data non è corretta. Il meeting è previsto per il $row[DataM]') </script>";
                    }
                }
            } else {
                //stampa del messaggio di non riconoscimento del cliente
                echo "<script> alert('Cliente non riconosciuto.') </script>";
            }
        }
    } else {
        //stampa del messaggio di errore durante l'ottenimento del parametro idm via get
        echo "<script> alert('Errore durante il get via URI') </script>";
    }
}

function updateMePIngresso($conn, $idm, $pnome, $pcognome, $email)
{
    //ottengo l'orario attuale
    $time = new DateTime('now', new DateTimeZone('Europe/Rome'));
    $time = $time->format('H:i');
    $sql = "INSERT INTO MeP (CheckIn,CheckOut,Id_M) VALUES ('$time', '00:00:00' , '$idm')";

    if (!$conn->query($sql)) {
        //stampa del messaggio di errore durante l'aggiornamento dell'ingresso utente
        return -1;
        //return "<script> alert('Errore durante la registrazione dell'ingresso.') </script>";
    } else {
        //invio della mail di notifica al personale interessato
        return warnAdmin($conn, $pnome, $pcognome, $email);
    }
}

function updateMePUscita($conn, $idm)
{
    //ottengo l'orario attuale
    $time = new DateTime('now', new DateTimeZone('Europe/Rome'));
    $time = $time->format('H:i');
    $sql = "UPDATE  MeP SET CheckOut='$time' WHERE Id_M='$idm'";

    if (!$conn->query($sql)) {
        //stampa del messaggio di errore durante l'aggiornamento dell'ingresso utente
        echo "<center> <h1>Errore durante la registrazione dell'uscita.</h1></center>";
    } else {
        echo "<center> <h1> Uscita registrata, arrivederci.</h1> </center>";
    }
}

function warnAdmin($conn, $nomep, $cognomep, $emaila)
{

    //Create e-mail
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = "lorenzoerba250@gmail.com";
    $mail->Password = 'Portocesareo25';
    $mail->Subject = 'Cliente arrivato.';
    $mail->Body = "<p> Il cliente $cognomep $nomep ha appena effettuato l'accesso in azienda</p>";
    $mail->addAddress('cestinodirete@gmail.com');

    if (!$mail->send()) {
        //stampa del messaggio di errore durante l'invio della mail di notifica
        $conn->close();
        return -2;
    } else {
        $conn->close();

        return 1;
    }
}
