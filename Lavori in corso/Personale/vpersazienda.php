<?php
include 'validator/getMeetingTable.php';

//faccio partire le sessioni per la gestione del logged in dell'utente
if (!isset($_SESSION)) {
    session_start();
}

/**
 * Controllo se l'utente si è loggato prima di accedere a tale pagina e se non rimane in afk
 */
if (!isset($_SESSION['user']) || !$_SESSION['logged'] = true) {
    //redirect alla pagina 1
    redirect("7");
} else if (time() - $_SESSION['timesetted'] > 1000000) {
    //eliminazione della sessione timesetted
    unset($_SESSION['timesetted']);
    //eliminazione della sessione user
    unset($_SESSION['user']);
    //eliminazione della sessione logged
    unset($_SESSION['logged']);
    //redirect alla pagina 1
    redirect("7");
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//ottengo la tabella contenente i meeting
$header = "<tr> <th>CheckIn</th><th> Email dell'amministratore</th> <th> Email del partecipante</th> <th>Nome Partecipante</th> <th>Cognome Partecipante</th> <th> Descrizione </th></tr>";
$table = getMePTable();
//stampo una stringa nel caso in cui non vi siano dei record da stampare
if ($table == "notable") {
    $table = "<h3>Non ci sono clienti in azienda.</h3>";
}
else{
    $table = $header . $table;
}

function redirect($errortype)
{

    header("location: login.php?error=$errortype");

    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Visualizza persone in azienda</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='#'>
    <script src='#'></script>
</head>

<body>
    <center>
        <h1> Visualizza persone in azienda</h1>
        <p id="i_description"> Attualmente in azienda sono presenti: </p>
        <table id="i_tblpersone">
        <?php
        //Stampa della query contenente i record in mep con orario settato e uscita no
        echo $table;
        ?>
           
        </table>
 
    </center>

    <footer>

        <button id="i_bback" name="n_bback" onclick="window.location.href='visualizza.php'"> Indietro </button>

    </footer>
    <script>
        var totalRowCount = 0;
        var rowCount = 0;
        var table = document.getElementById("i_tblpersone");
        var rows = table.getElementsByTagName("tr")
        for (var i = 0; i < rows.length; i++) {
            totalRowCount++;
            if (rows[i].getElementsByTagName("td").length > 0) {
                rowCount++;
            }
        }
        document.getElementById("i_description").innerHTML += rowCount + " persona/e";
</script>
</body>

</html>