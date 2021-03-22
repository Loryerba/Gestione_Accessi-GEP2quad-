<?php
include 'connection.php';

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