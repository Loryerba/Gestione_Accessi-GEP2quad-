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

            <p> Email Admin <input type="email" name="n_ademail" id="i_ademail" placeholder="Inserire la mail dell'admin"> </p>

            <button name="n_showrbrica" id="i_showrubrica"> Visualizza la rubrica </button>
            <button name="n_insertbrica" id="i_insertrubrica"> Inserisci nella rubrica </button>

            <!-- Blocco inserimento dati del cliente -->

            <p> Email Cliente <input type="email" name="n_clemail" id="i_clemail" placeholder="Inserire la mail del cliente"> </p>

            <button name="n_showrbricac" id="i_showrubricac"> Visualizza la rubrica </button>
            <button name="n_insertbricac" id="i_insertrubricac"> Inserisci nella rubrica </button>
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