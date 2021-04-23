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
    <link rel="icon" type=“image/x-icon” href="faviconFolder/favicon001.ico" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="../css/styleVPersAzienda.css" />

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
            <a href="visualizza.php" class="w3-bar-item w3-button w3-wide"><img src="immaginiPersonale/logo.png"></a>
            <!-- Parte destra navbar(opzionale) -->
            <div class="w3-right w3-hide-small">
            </div>


        </div>
    </div>

    <center>

    <div id="container"> 

        <h2> Visualizza persone in azienda</h2>
        <br>
        <hr class="linea">
        <p id="i_description"> Attualmente in azienda sono presenti: </p>

        <div id="container2"> 

            <table id="i_tblpersone">
                <?php
                //Stampa della query contenente i record in mep con orario settato e uscita no
                echo $table;
                ?>
           
            </table>

        </div>
 
    </div>

        <br>


        <button id="i_bback" name="n_bback" onclick="window.location.href='visualizza.php'"> Indietro </button>

        <br>
        <br>

    </center>


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