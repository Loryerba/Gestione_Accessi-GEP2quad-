<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user']) || !$_SESSION['logged'] = true) {
    //redirect alla pagina 1
    redirect("7");
} else if (time() - $_SESSION['timesetted'] > 10) {
    //eliminazione della sessione timesetted
    unset($_SESSION['timesetted']);
    //eliminazione della sessione user
    unset($_SESSION['user']);
    //eliminazione della sessione logged
    unset($_SESSION['logged']);
    //redirect alla pagina 1
    redirect("7");
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

    <title>Pannello Amministrativo</title>

    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel='stylesheet' type='text/css' media='screen' href='#'>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/styleAdminPnl.css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" type=“image/x-icon” href="faviconFolder/favicon001.ico" />

    <script src='js/script.js'></script>

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
            <a href="login.php" class="w3-bar-item w3-button w3-wide"><img src="immaginiPersonale/logo.png"></a>
            <!-- Parte destra navbar(opzionale) -->
            <div class="w3-right w3-hide-small">
            </div>


        </div>
    </div>


    <!--

<h1> Pannello Amministrativo </h1>

-->




    <div class="container">

        <div class="box">

            <!-- BOTTONE CREA -->

            <h2><i class="fa fa-user-plus"></i></h2>
            <h3>Crea Meeting</h3>
            <p>Seleziona "Crea Meeting" per realizzare un nuovo
                <br>incontro.
            </p>

            <button class="bottone" onclick="window.location.href='creameeting.php'"> Crea meeting </button>

        </div>

        <div class="box">

            <!-- BOTTONE EDIT -->

            <h2><i class="fa fa-edit"></i></h2>
            <h3>Modifica Meeting</h3>
            <p>Seleziona "Modifica Meeting" per modificare un
                <br>incontro.
            </p>

            <button class="bottone" onclick="window.location.href='modificameeting.php'"> Modifica meeting </button>

        </div>

        <div class="box">

            <!-- BOTTONE VISUALIZZA -->

            <h2><i class="fa fa-eye"></i></h2>
            <h3>Visualizza </h3>
            <p>Seleziona "Visualizza" per visualizzare i meeting futuri, i log, le persone in azienda e scaricare un file csv coi meeting futuri.</p>

            <button class="bottone" onclick="window.location.href='visualizza.php'"> Visualizza meeting</button>

        </div>

        <div class="box">

            <!-- BOTTONE RIMUOVI -->

            <h2><i class="fa fa-remove"></i></h2>
            <h3>Elimina Meeting</h3>
            <p>Seleziona "Elimina Meeting" per eliminare un
                <br>incontro.
            </p>

            <button class="bottone" onclick="window.location.href='eliminameeting.php'"> Elimina meeting</button>

        </div>

        <div class="box">

            <!-- BOTTONE ESCI -->

            <h2><i class="fa fa-sign-out"></i></h2>
            <h3>Esci</h3>
            <p>Seleziona "Esci" per tornare alla schermata
                <br>del login.
            </p>

            <button class="bottone" onclick="window.location.href='login.php'"> Esci</button>

        </div>


    </div>

</body>

</html>