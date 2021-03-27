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

//ottengo la tabella contenente i log
$header = "<tr> <th>Id_L</th><th>Ora</th> <th>Data</th> <th>Descrizione</th> <th>Id_A</th></tr>";
$table = getLogTable();
//stampo una stringa nel caso in cui non vi siano dei record da stampare
if ($table == "notable") {
    $table = "<h3>Non ci sono log.</h3>";
} else {
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
    <title>Visualizza Log</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <center>
        <h1> Visualizza Log</h1>

        <table>
            <!-- Stampa della query i log d'accesso-->
            <?php

            echo $table;
            ?>
        </table>


    </center>

    <footer>

        <button id="i_bback" name="n_bback" onclick="window.location.href='visualizza.php'"> Indietro </button>

    </footer>
</body>

</html>