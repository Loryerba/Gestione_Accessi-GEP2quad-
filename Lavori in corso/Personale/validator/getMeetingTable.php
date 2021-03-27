<?php
include 'connection.php';
if (!isset($_SESSION)) {
    session_start();
}
/**
 * Funzione che permette di calcolare una tabella contenente tutti i record presenti nella tabella meeting e di poterli modificare.
 */
function getTableIndex()
{
    // variabile tabella contenente la tabella d'output
    $table = "";
    //nome del database
    $dbname = "id16206619_dbaccessi";
    //realizzazione della connessione al database
    $conn = connect($dbname);
    //sql d'interrogazione al database, che otterrà come risultato la lista dei meeting da modificare
    $sql = "SELECT Meeting.Id_M,Meeting.DataM, Meeting.OraM,Meeting.Descrizione,Administrator.Email AS aemail,Partecipanti.Email AS pemail
    FROM Administrator INNER JOIN (Partecipanti INNER JOIN Meeting ON Partecipanti.Id_P = Meeting.Id_P) ON Administrator.Id_A = Meeting.Id_A";
    //esecuzione della query
    $result = $conn->query($sql);
    //se la query ha prodotto risultati li stampo
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // creazione della tabella contenente i meeting
            $table .= "<tr> <td> $row[DataM]</td> <td> $row[OraM]</td> <td> $row[aemail]</td> <td> $row[pemail]</td>
            <td> $row[Descrizione]</td> <td> <a href='modificaRecord.php?id=$row[Id_M]'>Modifica</a></td></tr>";
        }
        $conn->close();
        return $table;
    } else {
        $table = "notable";
        return $table;
    }
}

/**
 * Funzione che permette di calcolare una tabella contenente tutti i record presenti nella tabella meeting e di poterli eliminare.
 */
function getTableIndexDelete()
{
    // variabile tabella contenente la tabella d'output
    $table = "";
    //nome del database
    $dbname = "id16206619_dbaccessi";
    //realizzazione della connessione al database
    $conn = connect($dbname);
    //sql d'interrogazione al database, che otterrà come risultato la lista dei meeting da modificare
    $sql = "SELECT Meeting.Id_M,Meeting.DataM, Meeting.OraM,Meeting.Descrizione,Administrator.Email AS aemail,Partecipanti.Email AS pemail
    FROM Administrator INNER JOIN (Partecipanti INNER JOIN Meeting ON Partecipanti.Id_P = Meeting.Id_P) ON Administrator.Id_A = Meeting.Id_A";
    //esecuzione della query
    $result = $conn->query($sql);
    //se la query ha prodotto risultati li stampo
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // creazione della tabella contenente i meeting
            $table .= "<tr> <td> $row[DataM]</td> <td> $row[OraM]</td> <td> $row[aemail]</td> <td> $row[pemail]</td>
            <td> $row[Descrizione]</td> <td> <a href='validator/validateEliminaMeeting.php?id=$row[Id_M]'>Elimina</a></td></tr>";
        }
        $conn->close();
        return $table;
    } else {
        $table = "notable";
        return $table;
    }
}


/**
 * Funzione che permette di calcolare una tabella contenente tutti i clienti presenti in azienda
 */
function getMePTable(){
    // variabile tabella contenente la tabella d'output
    $table = "";
    //nome del database
    $dbname = "id16206619_dbaccessi";
    //realizzazione della connessione al database
    $conn = connect($dbname);
    //sql d'interrogazione al database, che otterrà come risultato la lista delle persone in azienda da modificare
    $sql = "SELECT MeP.CheckIn, MeP.CheckOut,Administrator.Email AS aemail,Partecipanti.Email AS pemail, Partecipanti.Nome, Partecipanti.Cognome, Meeting.Descrizione
    FROM Administrator INNER JOIN (Partecipanti INNER JOIN (Meeting INNER JOIN MeP ON Meeting.Id_M = MeP.Id_M) ON Partecipanti.Id_P = Meeting.Id_P) ON Administrator.Id_A = Meeting.Id_A
    WHERE MeP.CheckOut = '00:00:00'";
    //esecuzione della query
    $result = $conn->query($sql);
    //se la query ha prodotto risultati li stampo
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // creazione della tabella contenente i meeting
            $table .= "<tr> <td> $row[CheckIn]</td> <td> $row[aemail]</td> <td> $row[pemail]</td>
            <td> $row[Nome]</td> <td>$row[Cognome]</td> <td>$row[Descrizione]</td> </tr>"; 
        }
        $conn->close();
        return $table;
    } else {
        $table = "notable";
        return $table;
    }
}

/**
 * Funzione che permette di calcolare una tabella contenente tutti i log
 */
function getLogTable(){
    // variabile tabella contenente la tabella d'output
    $table = "";
    //nome del database
    $dbname = "id16206619_dbaccessi";
    //realizzazione della connessione al database
    $conn = connect($dbname);
    //sql d'interrogazione al database, che otterrà come risultato la lista delle persone in azienda da modificare
    $sql = "SELECT Id_L,OraL,DataL,Descrizione,Id_A
    FROM Logs
    ORDER BY DataL DESC, OraL DESC";
    //esecuzione della query 
    $result = $conn->query($sql);
    //se la query ha prodotto risultati li stampo
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // creazione della tabella contenente i meeting
            $table .= "<tr> <td> $row[Id_L]</td> <td> $row[OraL]</td> <td> $row[DataL]</td>
            <td> $row[Descrizione]</td> <td>$row[Id_A]</td></tr>"; 
        }
        $conn->close();
        return $table;
    } else {
        $table = "notable";
        return $table;
    }
}


/**
 * Funzione che permette di calcolare una tabella contenente tutti i meeting futuri
 */
function getMeetingTable(){
    // variabile tabella contenente la tabella d'output
    $table = "";
    //nome del database
    $dbname = "id16206619_dbaccessi";
    //realizzazione della connessione al database
    $conn = connect($dbname);
    //sql d'interrogazione al database, che otterrà come risultato la lista dei meeting da modificare
    $sql = "SELECT Meeting.DataM, Meeting.OraM,Meeting.Descrizione,Administrator.Email AS aemail,Partecipanti.Email AS pemail 
    FROM Administrator INNER JOIN (Partecipanti INNER JOIN Meeting ON Partecipanti.Id_P = Meeting.Id_P) ON Administrator.Id_A = Meeting.Id_A 
    WHERE Meeting.DataM >= CURRENT_DATE";
    //esecuzione della query
    $result = $conn->query($sql);
    //se la query ha prodotto risultati li stampo
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // creazione della tabella contenente i meeting
            $table .= "<tr> <td> $row[DataM]</td> <td> $row[OraM]</td> <td> $row[aemail]</td> <td> $row[pemail]</td>
            <td> $row[Descrizione]</td></tr>";
        }
        $conn->close();
        return $table;
    } else {
        $table = "notable";
        return $table;
    }
}

/**
 * Funzione che permette di calcolare una tabella contenente tutto il personale
 */
function getRubricaAmministratore(){
    // variabile tabella contenente la tabella d'output
    $table = "";
    //nome del database
    $dbname = "id16206619_dbaccessi";
    //realizzazione della connessione al database
    $conn = connect($dbname);
    //sql d'interrogazione al database, che otterrà come risultato la lista dei meeting da modificare
    $sql = "SELECT Id_A,Nome,Cognome,Email
            FROM Administrator";
    //esecuzione della query
    $result = $conn->query($sql);

    //controllo se è stata settata la sessione relativa alla mail del personale
    $check = false;
    if(isset($_SESSION['emailp'])){
        $check = true;
    }
    //se la query ha prodotto risultati li stampo
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if($check){
                // creazione della tabella contenente i meeting
            $table .= "<tr> <td> $row[Nome]</td> <td> $row[Cognome]</td> <td> $row[Email]</td><td><a href='creameeting.php?emaila=$row[Email]&emailp=$_SESSION[emailp]'>Seleziona</a></td></tr>";
            }
            else{
                // creazione della tabella contenente i meeting
            $table .= "<tr> <td> $row[Nome]</td> <td> $row[Cognome]</td> <td> $row[Email]</td><td><a href='creameeting.php?emaila=$row[Email]'>Seleziona</a></td></tr>";
            }
            
        }
        $conn->close();
        return $table;
    } else {
        $table = "notable";
        return $table;
    }
}


function getRubricaCliente(){
    // variabile tabella contenente la tabella d'output
    $table = "";
    //nome del database
    $dbname = "id16206619_dbaccessi";
    //realizzazione della connessione al database
    $conn = connect($dbname);
    //sql d'interrogazione al database, che otterrà come risultato la lista dei meeting da modificare
    $sql = "SELECT Id_P,Nome,Cognome,Email
            FROM Partecipanti";
    //esecuzione della query
    $result = $conn->query($sql);
    //controllo se è stata settata la sessione relativa alla mail del personale
    $check = false;
    if(isset($_SESSION['emaila'])){
        $check = true;
    }
    //se la query ha prodotto risultati li stampo
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if($check){
            // creazione della tabella contenente i meeting
            $table .= "<tr> <td> $row[Nome]</td> <td> $row[Cognome]</td> <td> $row[Email]</td><td><a href='creameeting.php?emaila=$_SESSION[emaila]&emailp=$row[Email]'>Seleziona</a></td></tr>";
            }
            else{
                $table .= "<tr> <td> $row[Nome]</td> <td> $row[Cognome]</td> <td> $row[Email]</td><td><a href='creameeting.php?emailp=$row[Email]'>Seleziona</a></td></tr>";
            }
        }
        $conn->close();
        return $table;
    } else {
        $table = "notable";
        return $table;
    }
}

function getMeetingCsv(){
     // variabile tabella contenente la tabella d'output
     $table = "";
     //nome del database
     $dbname = "id16206619_dbaccessi";
     //realizzazione della connessione al database
     $conn = connect($dbname);
     //sql d'interrogazione al database, che otterrà come risultato la lista dei meeting da modificare
     $sql = "SELECT Meeting.DataM, Meeting.OraM,Meeting.Descrizione,Administrator.Email AS aemail,Partecipanti.Email AS pemail
     FROM Administrator INNER JOIN (Partecipanti INNER JOIN Meeting ON Partecipanti.Id_P = Meeting.Id_P) ON Administrator.Id_A = Meeting.Id_A";
     //esecuzione della query
     $result = $conn->query($sql);
     //se la query ha prodotto risultati li stampo
     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             // creazione della tabella contenente i meeting
             $table .= "$row[DataM];$row[OraM];$row[Descrizione];$row[aemail];$row[pemail]" .  "\n";
         }
         $conn->close();
         return $table;
     } else {
         $table = "notable";
         return $table;
     }
}