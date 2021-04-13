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
$header = "<tr> <th>Data Meeting</th> <th>Ora Meeting</th> <th> Email dell'amministratore</th> <th> Email del partecipante</th> <th> Descrizione </th></tr>";
$table = getTableIndex();
//stampo una stringa nel caso in cui non vi siano dei record da stampare
if ($table == "notable") {
    $table = "<h3>Non ci sono record da visualizzare per la modifica.</h3>";
}
else{
    $table = $header . $table;
}

/**
 * error type
 * 
 * confirm => 1 => modifica avvenuta con successo
 * 
 * error => 1 => errore durante l'interrogazione del database, prodotto più di un record o zero
 * 
 * error => 2=> record aggiornato correttamente
 * 
 * error => 7 => Errore durante l'interrogazione del database per log
 */
if (isset($_GET["confirm"]) && $_GET["confirm"] == 1) {
    echo "<script> alert('Modifica avvenuta con successo') </script>";
} else if (isset($_GET["error"]) && $_GET["error"] == 1) {
    echo "<script> alert('Error getting record meeting') </script>";
} else if (isset($_GET["error"]) && $_GET["error"] == 2) {
    echo "<script> alert('Error executing query') </script>";
}
else if(isset($_GET["error"]) && $_GET["error"] == 7) {
    echo "<script> alert('Error log query.') </script>";
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
    <title>Modifica Meeting</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='#'>
    <script src='#'></script>
    <link rel="icon" type=“image/x-icon” href="faviconFolder/favicon001.ico" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="css/styleModificaMeeting.css" />

    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Raleway", sans-serif
        }

        .w3-bar .w3-button {

            display: block;
            padding: 0px;

            border-bottom: 2px solid transparent;

            transition: border-bottom-color 0.5s ease-out;
            -webkit-transition: border-bottom-color 0.5s ease-out;
        }


        .w3-button:hover {
            color: blue;
            border-bottom-color: blue;
        }
    </style>

</head>

<body style="background-color: #F5F5F5;">

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
            <a href="adminPnl.php" class="w3-bar-item w3-button w3-wide"><img src="immaginiPersonale/logo.png"></a>
            <!-- Parte destra navbar(opzionale) -->
            <div class="w3-right w3-hide-small">
            </div>


        </div>
    </div>

    <center>

    <div id="container"> 

        <h2> Modifica Meeting</h2>
        <br>
        <hr class="linea">

        <br>
        <br>

        <form action="modificaRecord.php" method="post">

        <div id="container2"> 
            <table>
                <?php
                //stampa della tabella
                echo $table;
                ?>
                <!-- Stampa della query contenente i  meeting futuri. Alla selezione di un record passo tramite get alla pagina di modifica -->
            </table>
            </div>

        </form>

    </div>    

    

        <br>

        <button id="i_bback" name="n_bback" onclick="window.location.href='adminPnl.php'"> Indietro </button>

        <br>
        <br>

    </center>    

</body>

</html>