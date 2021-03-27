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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////12345

/**
 * error get type
 * 
 * error => 1 => Non tutti i campi sono stati compilati
 * 
 * error => 2 => Errore durante l'interrogazione al database per amministratore
 * 
 * error => 3 => Errore durante l'interrogazione al database per cliente
 * 
 * error => 4 => Oraio non valido
 * 
 *  error => 5 => Data non valida
 * 
 * error => 6 => Errore durante l'interrogazione del database per meeting
 * 
 * error => 7 => Errore durante l'interrogazione del database per log
 * 
 * error => 8 => Errore durante l'invio della mail
 * 
 * confirm => 1 => Creazione avvenuta con successo
 */

if (isset($_GET["error"]) && $_GET["error"] == 1) {
    echo "<script> alert('Compilare tutti i campi') </script>";
} else if (isset($_GET['error']) && $_GET['error'] == 2) {
    echo "<script> alert('Email amministratore non presente nel database.')</script>";
} else if (isset($_GET['error']) && $_GET['error'] == 3) {
    echo "<script> alert('Email cliente non presente nel database..')</script>";
} else if (isset($_GET['error']) && $_GET['error'] == 4) {
    echo "<script> alert('Orario inserito non valido.')</script>";
} else if (isset($_GET['error']) && $_GET['error'] == 5) {
    echo "<script> alert('Data inserita non valida.')</script>";
} else if (isset($_GET['error']) && $_GET['error'] == 6) {
    echo "<script> alert('Error meeting query.')</script>";
} else if (isset($_GET['error']) && $_GET['error'] == 7) {
    echo "<script> alert('Error log query.')</script>";
} else if (isset($_GET['error']) && $_GET['error'] == 8) {
    echo "<script> alert('Error trying sending mail.')</script>";
} else if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {
    echo "<script> alert('Meeting creato con successo.') </script>";
} else if (isset($_GET['confirm']) && $_GET['confirm'] == 2) {
    echo "<script> alert('Amministratore aggiunto con successo.') </script>";
} else if (isset($_GET['confirm']) && $_GET['confirm'] == 3) {
    echo "<script> alert('Cliente aggiunto con successo.') </script>";
}
if (isset($_GET['emaila'])) {
    $_SESSION['emaila'] = $_GET['emaila'];
} else {
    unset($_SESSION['emaila']);
}
if (isset($_GET['emailp'])) {
    $_SESSION['emailp'] = $_GET['emailp'];
} else {
    unset($_SESSION['emailp']);
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
    <title> Crea Meeting</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='js/script.js'></script>
</head>

<body>
    <center>
        <form action="validator/validateCreaMeeting.php" method="post">
            <h1> Crea meeting</h1>
            <!-- Blocco inserimento dati dell'admin -->

            <p> Email Admin <input type="email" name="n_ademail" id="i_ademail" placeholder="Inserire la mail dell'admin" value="<?php if (isset($_SESSION['emaila'])) echo $_SESSION['emaila'] ?>"> </p>

            <input type="button" name="n_showrbrica" id="i_showrubrica" onclick="window.location.href='visualizzaRubricaAdmin.php'" value="Visualizza la rubrica"> </input>
            <input type="button" name="n_insertbrica" id="i_insertrubrica" onclick="window.location.href='inserisciRubricaAdmin.php'" value="Inserisci nella rubrica"> </input>

            <!-- Blocco inserimento dati del cliente -->

            <p> Email Cliente <input type="email" name="n_clemail" id="i_clemail" placeholder="Inserire la mail del cliente" value="<?php if (isset($_SESSION['emailp'])) echo $_SESSION['emailp'] ?>"> </p>

            <input type="button" name="n_showrbricac" id="i_showrubricac" onclick="window.location.href='visualizzaRubricaCliente.php'" value="Visualizza la rubrica"></input>
            <input type="button" name="n_insertbricac" id="i_insertrubricac" onclick="window.location.href='inserisciRubricaCliente.php'" value="Inserisci nella rubrica"> </input>
            <!-- Inserimento della descrizione del meeting -->
            <p> Descrizione: <textarea maxlength="100" rows="7" cols="40" required name="n_descrizione"> </textarea></p>
            <!-- Inserimento della data del meeting -->
            <p> Data meeting: <input type="date" name="datameeting" placeholder="Selezionare la data"> </p>
            <!-- Inserimento dell'orario del meeting -->
            <p> Orario meeting: <input type="time" name="n_orameeting" id="orario" placeholder="Inserire l'orario"> </p>
            <script>
                setPreviousDate();
            </script>
            <input type="submit" name="n_confirm" id="i_confirm" value="Conferma meeting">
        </form>
    </center>
    <footer>
        <button onclick="window.location.href='adminPnl.php'"> Indietro</button>

    </footer>
</body>

</html>