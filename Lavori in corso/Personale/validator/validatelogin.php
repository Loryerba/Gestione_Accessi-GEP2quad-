<?php

/**
 * Tabella dei redirect
 * redirect type:
 * 1 --> campo username vuoto
 * 
 * 2 --> formato della mail incorretto
 * 
 * 3 --> campo password vuoto
 * 
 * 4 --> errore durante la connesione al db
 * 
 * 5 --> nessun record coincide con quello inserito
 * 
 * 6 --> il database non contiene record
 * 
 * 8 --> log registering error
 * 
 */
// se non è stata ancora settata una sessione, la faccio partire
if (!isset($_SESSION)) {
    session_start();
}
include 'connection.php';

$dbname = "id16206619_dbaccessi";

if (empty($_POST['n_username'])) {

    //redirect alla pagina di login con error type = 1

    // error type => 1 => username vuoto

    redirect(1);
} else {

    $mail = test_input($_POST['n_username']);

    //controllo se la mail è formattata in maniera corretta

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {

        //redirect alla pagina index con error type = 2

        // erorr type => 2 => formato della mail incorretto

        redirect(2);
    } else if (empty($_POST['n_password'])) {

        //redirect alla pagina index con error type = 3

        // error type => 3 => campo password vuoto

        redirect(3);
    } else {

        // salvataggio della password con criptaggio di base

        $password = password_hash(test_input($_POST['n_password']), PASSWORD_DEFAULT);


        $conn = connect($dbname);

        if (!$conn) {

            //redirect alla pagina index con error type = 4

            // error type => 4 => errorre durante la connessione al db

            redirect(4);
        } else {

            // query al db per ottenere username e password degli amministratori

            $sql = "SELECT Id_A,Email,Password_ FROM Administrator";

            // esecuzione della query

            $result = $conn->query($sql);

            // flag booleano per il controllo dei dati inseriti

            $check = false;

            //controllo se la query ha prodotto dei risultati

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    if ($mail == $row['Email'] && password_verify($row['Password_'], $password) == 1) {

                        //setting del flag booleano a true

                        //tale setting permetterà di verificare che l'utente è stato riconosciuto

                        $check = true;
                        //ottengo l'id dell'utente che si è loggato attualmente
                        $id = $row['Id_A'];
                    }
                }



                if ($check) {

                    //ottengo l'orario attuale
                    $time = new DateTime('now', new DateTimeZone('Europe/Rome'));
                    $time = $time->format('H:i');
                    //ottengo la data attuale
                    $date = new DateTime('now', new DateTimeZone('Europe/Rome'));
                    $date = $date->format("Y-m-d");
                    // descrizione del log
                    $description = "Administrator logged in";
                    $conn = connect($dbname);
                    $sql = "INSERT INTO Logs (OraL,DataL,Descrizione,Id_A) VALUES ('$time', '$date', '$description', $id)";
                    if ($conn->query($sql) == TRUE) {
                        // realizzazione della sessione user contenente la mail utente 
                        $_SESSION['user'] = $mail;
                        // realizzazione della sessione logged, contenente il flag booleano indicante che è stato effettuato l'acceso
                        $_SESSION['logged'] = true;
                        // realizzazione della sessione timesetted, contenente l'orario in cui si è loggato l'utente.
                        $_SESSION['timesetted'] = time();
                        // realizzazione della sessione idadmin, contenente l'id dell'admin che ha effettuato l'accesso
                        $_SESSION['idadmin'] = $id;
                        redirect_to_pnl();
                    } else {
                        // chiusura connessione al database
                        $conn->close();
                        //redirect alla pagina index con error type = 8

                        // error type => 8 => errore durante il salvataggio dei log 
                        redirect(8);
                    }
                } else {
                    // chiusura connessione al database
                    $conn->close();
                    //redirect alla pagina index con error type = 5

                    // error type => 5 => nessun record coincide con quello inserito

                    redirect(5);
                }
            } else {
                // chiusura connessione al database
                $conn->close();
                //redirect alla pagina index con error type = 6

                // error type => 6 => il database non contiene amministratori

                redirect(6);
            }
        }
    }
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



function redirect($errortype)

{

    header("Location: ../login.php?error=$errortype");

    exit();
}



function redirect_to_pnl()

{

    header("location: ../adminPnl.php");

    exit();
}
