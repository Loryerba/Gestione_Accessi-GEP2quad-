<?php
include 'connection.php';


$dbname = "id16206619_dbaccessi";
$apertura = "08:00";
$chiusura = "17:30";
//controllo se è stato effettuata una richiesta POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //controllo se tutti i campi sono compilati
    if (
        empty($_POST['datameeting']) || empty($_POST['oram']) || empty($_POST['aemail']) || empty($_POST['peamil']) || empty($_POST['descrizione'])
    ) {
        //caso in cui alcuni campi sono vuoti
        //redirect alla pagina modificaRecord.php con error type = 1
        // errror => 1 => Compilare tutti i campi
        redirect_to_record(1);
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
                        $idm = $_POST['idm'];
                        modifyMeeting($idm, $ida, $idc, $orario, $datameeting, $descrizione, $conn);
                    } else {

                        // chiusura connessione al database
                        $conn->close();
                        // caso in cui vengono prodotti più risultati di 1 oppure nessun risultato
                        // redirect alla pagina modificaRecord.php con error type = 3
                        // error => 3 => Errore durante l'interrogazione al database per cliente
                        redirect_to_record(3);
                    }
                } else {
                    // chiusura connessione al database
                    $conn->close();
                    // caso in cui vengono prodotti più risultati di 1 oppure nessun risultato
                    // redirect alla pagina modificaRecord.php con error type = 2
                    // error => 2 => Errore durante l'interrogazione al database per amministratore
                    redirect_to_record(2);
                }
            } else {
                // caso in cui viene selezionata una data non valida
                // redirect alla pagina modificaRecord.php con error type = 5
                // error => 5 => Data non valida
                redirect_to_record(5);
            }
        } else {
            // caso in cui viene inserito un orario che non rientra in quello valido
            // redirect alla pagina modificaRecord.php con errror type = 4
            // error => 4 => Oraio non valido
            redirect_to_record(4);
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
        //caso in cui venga aggiornato il record correttamente
        // redirect alla pagina modificameeting.php con confirm type 1
        // confirm => 1 => record aggiornato correttamente
        header("location: modificameeting.php?confirm=1");
        exit();
    } else {
        //caso in cui si verifica un errore nel tentativo di aggiornare il record
        // redirect alla pagina modificameeting.php con errror type 2
        // error => 2=> record aggiornato correttamente
        redirect_to_meeting(2);
    }
}

/**
 * Metodo che effettua una redirect con errore nella richiesta GET alla pagina modificameeting.php
 */
function redirect_to_meeting($error)
{
    header("location: modificameeting.php?error=$error");
    exit();
}

/**
 * Metodo che effettua una redirect con errore nella richiesta GET alla pagina modificaRecord.php
 */
function redirect_to_record($error)
{
    header("location: modificaRecord.php?error=$error");
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
