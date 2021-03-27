<?php

if (!isset($_SESSION)) {
    session_start();
}

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
</head>
<body> 
    <center>
        <form action="validator/validateAddRubricaAdmin.php" method="post">
        <h1> Inserisci un nuovo amministratore nella rubrica</h1>
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
        <p> <input type="submit" name="n_submit" value="Inserisci"> </p>
        </form> 
    </center>

    <footer>
        <button onclick="window.location.href='creameeting.php'"> Indietro </button>
    </footer>
</body>
</html>