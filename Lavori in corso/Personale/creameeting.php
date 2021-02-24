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
        <form action="validateMeeting.php" method="post">
            <h1> Crea meeting</h1>
            <!-- Blocco inserimento dati dell'admin -->
            <p> Nome Admin <input type="text" name="n_adnome" id="i_adnome" placeholder="Inserire il nome dell'admin"> </p>
            <p> Cognome Admin <input type="text" name="n_adcognome" id="i_adcognome" placeholder="Inserire il cognome dell'admin"></p>
            <p> Email Admin <input type="text" name="n_ademail" id="i_admail" placeholder="Inserire la mail dell'admin"> </p>

            <button name="n_showrbrica" id="i_showrubrica"> Visualizza la rubrica </button>
            <button name="n_insertbrica" id="i_insertrubrica"> Inserisci nella rubrica </button>
            <!-- Inserimento dati del cliente nella rubrica-->
            <div class="form-popup" id="myForm" style="visibility:hidden">
                <form action="validateInsertRubrica.php" method="post">
                    <h1>Rubrica</h1>

                    <label for="nome"><b>Mail cliente</b></label>
                    <input type="email" placeholder="Inserisci il nome del cliente" name="n_clemail" required>
                    <br>
                    <label for="cognome"><b>Cognome cliente</b></label>
                    <input type="text" placeholder="Inserisci il cognome del cliente" name="n_clcognome" required>
                    <br>
                    <label for="nome"><b>Nome cliente</b></label>
                    <input type="text" placeholder="Inserisci il nome del cliente" name="n_clnome" required>
                    <br>
                    <button type="submit" class="btn">Inserisci nella rubrica</button>
                    <br>
                    <button type="submit" class="btn cancel" onclick="closeForm()">Chiudi</button>
                    <br>
                </form>
            </div>
            <!-- Selezione cliente dalla rubrica-->
            <div class="form-popup" id="myForm" style="visibility:hidden">
                <form action="validateGetRubrica.php" method="post">
                    <table>
                        <!-- Stampa della query php contenente la rubrica-->
                    </table>
                </form>
            </div>
            <!-- Inserimento della descrizione del meeting -->
            <p> Descrizione: <textarea maxlength="100" rows="7" cols="40"> </textarea></p>
            <!-- Inserimento della data del meeting -->
            <p> Data meeting: <input type="date" name="datameeting" placeholder="Selezionare la data"> </p>
            <!-- Inserimento dell'orario del meeting -->
            <p> Orario meeting: <input type="time" name="orameeting" id="orario" placeholder="Inserire l'orario" onchange="mia()"> </p>
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