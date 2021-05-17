<?php

if (!isset($_SESSION)) {
    session_start();
}

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
if (isset($_GET["error"]) && $_GET["error"] == 1) {
    echo "<script> alert('Compilare tutti i campi') </script>";
} else if (isset($_GET['error']) && $_GET['error'] == 2) {
    echo "<script> alert('I campi password e conferma password devono contenere la stessa password.')</script>";
} else if (isset($_GET['error']) && $_GET['error'] == 3) {
    echo "<script> alert('Errore durante la connessione al database.')</script>";
} else if (isset($_GET['error']) && $_GET['error'] == 4) {
    echo "<script> alert('Amministratore aggiunto con successo.')</script>";
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
    <title>Inserisci Admin</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" type=“image/x-icon” href="../faviconFolder/favicon001.ico" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="../css/styleInserisciRubricaAdmin.css" />

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
<body style="background-color: #59c0f349;">

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
            <a href="adminPnl.php" class="w3-bar-item w3-button w3-wide"><img src="../img/logo.png"></a>
            <!-- Parte destra navbar(opzionale) -->
            <div class="w3-right w3-hide-small">
            </div>


        </div>
    </div>

    <center>

        <form action="validator/validateAddRubricaAdmin.php" method="post">
        <div id="container"> 
        <h1> Inserisci un nuovo amministratore nella rubrica</h1>
        <br>
        <hr class="linea">

        <br>        
        <br>

        <table>
            <tr>
                <th> Nome </th>
                <th> Cognome </th>
                <th> Email </th>
                <th> Password </th>
                <th> Conferma Password </th>
            </tr>
            <tr>
                <td> <input type="text" name="n_nome" id="i_name"></td>
                <td> <input type="text" name="n_cognome" id="i_cognome"></td>
                <td> <input type="email" name="n_email" id="i_email"></td>
                <td> <input type="password" name="n_password" id="i_password"></td>
                <td> <input type="password" name="n_confpassword" id="i_confpassword"></td>
            </tr>
        </table>
        <p> <input type="submit" id = "n_submit" name="n_submit" value="Inserisci"> </p>
        </div>
        </form> 
    

        <br>

        <button id="i_bback" name="n_bback" onclick="window.location.href='creameeting.php'"> Indietro </button>

    </center>    

</body>
</html>