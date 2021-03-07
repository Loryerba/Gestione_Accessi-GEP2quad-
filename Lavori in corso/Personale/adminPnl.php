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

    <script src='js/script.js'></script>

</head>

<body>

    <center>

        <h1> Pannello Amministrativo </h1>

        <p> <i> Seleziona <b> Crea Meeting</b> per realizzare un nuovo incontro.</i></p>

        <p> <button onclick="window.location.href='creameeting.php'"> Crea meeting </button></p>

        <p> <i> Seleziona <b> Modifica Meeting</b> per modificare un incontro.</i></p>

        <p> <button onclick="window.location.href='modificameeting.php'"> Modifica meeting </button> </p>

        <p> <i> Seleziona <b> Visualizza Meeting</b> per visualizzare i meeting futuri.</i></p>

        <p> <button onclick="window.location.href='visualizza.php'"> Visualizza meeting</button> </p>

        <p> <i> Seleziona <b> Elimina Meeting</b> per eliminare un incontro.</i></p>

        <p> <button onclick="window.location.href='eliminameeting.php'"> Elimina meeting</button> </p>

        <p> <button onclick="window.location.href='login.php'"> Esci </button></p>



    </center>

</body>

</html>