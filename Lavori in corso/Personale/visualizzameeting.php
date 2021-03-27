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
$header = "<tr> <th>Data Meeting</th> <th>Ora Meeting</th> <th> Email dell'amministratore</th> <th> Email del partecipante</th> <th>Descrizione</th> </tr>";
$table = getMeetingTable();
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
    <title>Visualizza meeting</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <center>
        <h1> Visualizza meeting futuri</h1>

        <table>
            <!-- Stampa della query contenente i meeting futuri-->
            <?php
        //Stampa della query contenente i record in mep con orario settato e uscita no
        echo $table;
        ?>
        </table>

    </center>

    <footer>

        <button id="i_bback" name="n_bback" onclick="window.location.href='visualizza.php'"> Indietro </button>

    </footer>
</body>

</html>