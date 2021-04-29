<?php
include 'connection.php';
if (!isset($_SESSION)) {
    session_start();
}
$dbname = "id16206619_dbaccessi";
$apertura = "08:00";
$chiusura = "17:30";
//controllo se è stato effettuata una richiesta POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idm = $_POST['idm'];
    //controllo se tutti i campi sono compilati
    if (
        empty($_POST['datameeting']) || empty($_POST['oram']) || empty($_POST['aemail']) || empty($_POST['peamil']) || empty($_POST['descrizione'])
    ) {
        //caso in cui alcuni campi sono vuoti
        //redirect alla pagina modificaRecord.php con error type = 1
        // errror => 1 => Compilare tutti i campi
        redirect_to_record(1, $idm);
    } else {
        //controllo se l'orario inserito è corretto
        $orario = new DateTime($_POST['oram']);
        $orarioapertura = new DateTime($apertura);
        $orariochiusura = new DateTime($chiusura);
        if ($orario >= $orarioapertura && $orario <= $orariochiusura) {
            //controllo se la data inserita non è nel weekend
            if (!(date('l', strtotime($_POST['datameeting'])) == "Saturday" || date('l', strtotime($_POST['datameeting'])) == "Sunday")) {
                $datameeting = $_POST['datameeting'];
                //ottengo la mail dell'amministratore
                $emailad = test_input($_POST['aemail']);
                //connessione al database
                $conn = connect($dbname);
                //query d'interrogazione del database per ottenere i dati relativi all'amministratore identificato dalla mail inserita
                $sql = "SELECT Id_A FROM Administrator WHERE Email = '$emailad'";
                //esecuzione della query 
                $result = $conn->query($sql);
                //controllo se la query ha prodotto 1 risultato
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    //ottengo l'id del'amministratore
                    $ida = $row['Id_A'];
                    //ottengo la mail del cliente
                    $emailcl = test_input($_POST['peamil']);
                    //query d'interrogazione al database per ottenere i dati relativi al cliente identificato dalla mail inserita
                    $sql = "SELECT Id_P FROM Partecipanti WHERE Email = '$emailcl'";
                    //esecuzione della query
                    $result = $conn->query($sql);
                    //controllo se la query ha prodotto 1 risultato
                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        // ottengo l'id del cliente
                        $idc = $row['Id_P'];
                        // ottengo la descrizione del meeting
                        $descrizione = $_POST['descrizione'];

                        modifyMeeting($idm, $ida, $idc, $orario, $datameeting, $descrizione, $conn);
                    } else {

                        // chiusura connessione al database
                        $conn->close();
                        // caso in cui vengono prodotti più risultati di 1 oppure nessun risultato
                        // redirect alla pagina modificaRecord.php con error type = 3
                        // error => 3 => Errore durante l'interrogazione al database per cliente
                        redirect_to_record(3, $idm);
                    }
                } else {
                    // chiusura connessione al database
                    $conn->close();
                    // caso in cui vengono prodotti più risultati di 1 oppure nessun risultato
                    // redirect alla pagina modificaRecord.php con error type = 2
                    // error => 2 => Errore durante l'interrogazione al database per amministratore
                    redirect_to_record(2, $idm);
                }
            } else {
                // caso in cui viene selezionata una data non valida
                // redirect alla pagina modificaRecord.php con error type = 5
                // error => 5 => Data non valida
                redirect_to_record(5, $idm);
            }
        } else {
            // caso in cui viene inserito un orario che non rientra in quello valido
            // redirect alla pagina modificaRecord.php con errror type = 4
            // error => 4 => Oraio non valido
            redirect_to_record(4, $idm);
        }
    }
}


function modifyMeeting($idm, $ida, $idc, $orario, $datameeting, $descrizione, $conn)
{
    // riformattazione dell'orario nel formato accettato dal database
    $orario = $orario->format('H:i');
    // query per inserire nel database il meeting
    $sql = "UPDATE Meeting SET DataM='$datameeting',OraM='$orario',Id_A='$ida',Id_P='$idc',Descrizione='$descrizione' WHERE Id_M='$idm'";
    //interrogazione al database
    if ($conn->query($sql)) {
        //registrazione del log
        updateLog($conn, $idm);
        //caso in cui venga aggiornato il record correttamente
        // redirect alla pagina modificameeting.php con confirm type 1
        // confirm => 1 => record aggiornato correttamente
        header("location: ../modificameeting.php?confirm=1");
        exit();
    } else {
        //caso in cui si verifica un errore nel tentativo di aggiornare il record
        // redirect alla pagina modificameeting.php con errror type 2
        redirect_to_meeting(2);
    }
}

/**
 * Metodo che effettua una redirect con errore nella richiesta GET alla pagina modificameeting.php
 */
function redirect_to_meeting($error)
{
    header("location: ../modificameeting.php?error=$error");
    exit();
}

/**
 * Metodo che effettua una redirect con errore nella richiesta GET alla pagina modificaRecord.php
 */
function redirect_to_record($error, $id)
{
    header("location: ../modificaRecord.php?id=$id&error=$error");
    exit();
}
function getArrayOfAttribute($id)
{
    $dbname = "id16206619_dbaccessi";
    // realizzazione della connessione al database
    $conn = connect($dbname);
    //query d'interrogazione al database
    $sql = "SELECT Meeting.Id_M,Meeting.DataM, Meeting.OraM,Meeting.Descrizione,Administrator.Email AS aemail,Partecipanti.Email AS pemail
    FROM Administrator INNER JOIN (Partecipanti INNER JOIN Meeting ON Partecipanti.Id_P = Meeting.Id_P) ON Administrator.Id_A = Meeting.Id_A 
    WHERE Meeting.Id_M = $id";
    //esecuzione della query
    $result = $conn->query($sql);

    //se la query ha prodotto 1 risultato lo stampo
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        //realizzo un array associativo
        $values = array("Id_M" => "$row[Id_M]", "DataM" => "$row[DataM]", "OraM" => "$row[OraM]", "Descrizione" => "$row[Descrizione]", "aemail" => "$row[aemail]", "pemail" => "$row[pemail]");
        return $values;
    }
    // in caso non venga prodotto nessun risultato o più di uno procedo a tornare un errore
    else {
        //caso in cui venga prodotto piu di un record
        // redirect alla pagina modificameeting.php con error type 1
        // error => 1 => errore durante l'interrogazione del database, prodotto più di un record o zero
        redirect_to_meeting(1);
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

function updateLog($conn, $idm)
{
    //ottengo l'orario attuale
    $time = new DateTime('now', new DateTimeZone('Europe/Rome'));
    $time = $time->format('H:i');
    //ottengo la data attuale
    $date = new DateTime('now', new DateTimeZone('Europe/Rome'));
    $date = $date->format("Y-m-d");
    // descrizione del log
    $description = "Administrator modified a meeting where id meeting is $idm";
    $id = $_SESSION['idadmin'];
    // query per inserire nel database il  log
    $sql = "INSERT INTO Logs (OraL,DataL,Descrizione,Id_A) VALUES ('$time', '$date', '$description', $id)";
    if ($conn->query($sql) == FALSE) {
        // caso in cui avviene un errore nell'inserimento nel database
        // redirect alla pagina creameeting.php con errror type = 7
        // error => 7 => Errore durante l'interrogazione del database per log
        $conn->close();
        redirect_to_meeting(7);
    }
}
