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
} else if (time() - $_SESSION['timesetted'] > 10000) {
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
if(isset($GET['error']) && $_GET['error'] == 1){
    echo "<script> alert('Impossibile stabilire la connessione al database')</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Visualizzazione</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../css/styleVisualizza.css" />
    <script src='main.js'></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type=“image/x-icon” href="../faviconFolder/favicon001.ico" />

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
<body>

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
            <a href="adminPnl.php" class="w3-bar-item w3-button w3-wide"><img src="../img/logo.png"></a>
            <!-- Parte destra navbar(opzionale) -->
            <div class="w3-right w3-hide-small">
            </div>
        </div>
    </div>

    <div class="container">

        <div class="box">

            <!-- Visualizza persone -->

            <h2><i class="fa fa-building"></i></h2>
            <h3>Visualizza persone in azienda</h3>
            <p>Seleziona "Visualizza persone in azienda" per visualizzare 
                <br>le persone attualmente in azienda.
            </p>

            <button class="bottone" onclick="window.location.href='vpersazienda.php'"> Visualizza persone in azienda </button>

        </div>

        <div class="box">

            <!-- Visualizza persone -->

            <h2><i class="fa fa-users"></i></h2>
            <h3>Visualizza Meeting</h3>
            <p>Seleziona "Visualizza persone" per visualizzare i meeting 
                <br>futuri.
            </p>

            <button class="bottone" onclick="window.location.href='visualizzameeting.php'"> Visualizza persone </button>

        </div>

        <div class="box">

            <!-- Visualizza Log -->

            <h2><i class="fa fa-terminal"></i></h2>
            <h3>Visualizza Log </h3>
            <p>Seleziona "Visualizza Log" per visualizzare i log
                <br>d'accesso.
            </p>
            <br>

            <button class="bottone" onclick="window.location.href='visualizzalog.php'"> Visualizza Log</button>

        </div>

        <div class="box">

            <!-- Scarica Meeting -->

            <h2><i class="fa fa-download"></i></h2>
            <h3>Scarica Meeting</h3>
            <p>Seleziona "Scarica Meeting" per scarciare un file excel contenente 
                <br>i meeting futuri.
            </p>

            <button class="bottone" onclick="window.location.href='scaricameeting.php'"> Scarica Meeting</button>

        </div>

        <div class="box">

        <!-- BOTTONE INDIETRO -->

        <h2><i class="fa fa-arrow-left"></i></h2>
        <h3>Indietro</h3>
        <p>Seleziona "Indietro" per tornare alla schermata
            <br>principale.
        </p>
        <br>
        <button class="bottone" onclick="window.location.href='adminPnl.php'"> Indietro</button>

        </div>
        

    </div>

</body>
</html>