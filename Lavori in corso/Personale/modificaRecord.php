<?php
// includo il file php per effettuare la modifica del record
include 'validator/validateModificaRecord.php';
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


if (isset($_GET["id"])) {
    $values = getArrayOfAttribute($_GET["id"]);
}


/**
 * error type
 * 
 * error => 1 =>  Compilare tutti i campi
 * 
 * error => 2 => Errore durante l'interrogazione al database per amministratore
 * 
 * error => 3 => Errore durante l'interrogazione al database per cliente
 * 
 * error => 4 => Oraio non valido
 * 
 * error => 5 => Data non valida
 */
if (isset($_GET["error"]) && $_GET["error"] == 1) {
    echo "<script> alert('Compilare tutti i campi') </script>";
}
else if(isset($_GET["error"]) && $_GET["error"] == 2){
    echo "<script> alert('Errore durante l'interrogazione al database per amministratore') </script>";
}
else if(isset($_GET["error"]) && $_GET["error"] == 3){
    echo "<script> alert('Errore durante l'interrogazione al database per cliente') </script>";
}
else if(isset($_GET["error"]) && $_GET["error"] == 4){
    echo "<script> alert('Oraio non valido') </script>";
}
else if(isset($_GET["error"]) && $_GET["error"] == 5){
    echo "<script> alert('Data non valida') </script>";
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
    <title>Completa modifica</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='js/script.js'></script>
</head>


<body>
    <center>
        <h2> Modifica del meeting selezionato</h2>
        <!--Ricevere via get il record selezionato e prevedo la modifica dei campi-->
        <form action='validator/validateModificaRecord.php' method='post'>
            <table>
                <tr>
                    <th> Id Meeting</th>
                    <th> Data Meeting</th>
                    <th> Ora Meeting</th>
                    <th> Email dell'amministratore</th>
                    <th> Email del partecipante</th>
                    <th> Descrizione</th>
                </tr>

                <?php
                // se è settata la variabile values, vuol dire che non ci sono stati errori nell'ottenere il record richiesto per la modifica
                if (isset($values)) {
                    echo "<tr> <td><input type='number' name='idm' value='$values[Id_M]' min='1' max='999'></td><td><input type='date' name='datameeting' value='$values[DataM]'></td> <td> <input type='time' name='oram' value='$values[OraM]'></td> 
                <td> <input type='text' name='aemail' value='$values[aemail]'> </td> <td> <input type='text' name='peamil' value='$values[pemail]'> </td> 
                <td> <input type='text' name='descrizione' value='$values[Descrizione]'</td></tr>";
                    echo "<script>
                setPreviousDate();
            </script>";
                }
                ?>
            </table>

            <p><input type='submit' value='Conferma modifiche'> </p>
        </form>
        <button onclick="window.location.href='modificameeting.php'"> Indietro </button>
    </center>
</body>

</html>