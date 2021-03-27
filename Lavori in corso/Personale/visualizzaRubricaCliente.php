<?php

// includo il file per ottenere la tabella dei meeting
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
$header = "<tr> <th>Nome</th> <th>Cognome</th> <th> Email del partecipante</th><th>Seleziona</th></tr>";
$table = getRubricaCliente();
//stampo una stringa nel caso in cui non vi siano dei record da stampare
if ($table == "notable") {
    $table = "<h3>Non ci sono record da visualizzare per la rubrica.</h3>";
}
else{
    $table = $header . $table;
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Rubrica Cliente</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <center>
    <h1> Rubrica Personale</h1>
    <table>

    <?php if(isset($table))
            echo $table;
            ?>

    </table>
    </center>
    <footer>
        <button onclick="window.location.href='creameeting.php'"> Indietro</button>

    </footer>
</body>
</html>