<html>

<head>
    <title>Accesso ospite</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/script.js"></script>
    <style>
    </style>
</head>

<body onload="loadPage()">
    <center>
        <form action="php/checkForm.php" onsubmit="return checkFields()" name="meeting" id="meeting">
            <h2>Prenota un appuntamento</h2>
            <h4>Seleziona la data e l'ora desiderata:</h4>
            <input type="datetime-local" id="meeting-time" name="meeting-time" min="2017-06-01T08:30">

            <h4>Inserisci un nominativo:</h4>
            <input type="text" id="meeting-nameClient" name="meeting-nameClient" placeholder="Nome e cognome">

            <h4>Inserisci l'oggetto del meeting e una breve descrizione:</h4>
            <input type="text" id="meeting-object" name="meeting-object" placeholder="Oggetto meeting">
            <br><br>

            <textarea id="meeting-description" name="meeting-description" rows="4" cols="50" placeholder="Descrizione opzionale"></textarea>

            <h4>Scegli l'impiegato interessato al meeting:</h4>
            <select id="meeting-employee" name="meeting-employee">
                <option value="Seleziona qualcuno">Seleziona qualcuno</option>
                <option value="impiegato1">Impiegato1</option>
                <option value="impiegato1">Impiegato1</option>
            </select>

            <h4>Inserisci un'e-mail per essere contattato successivamente:</h4>
            <input type="email" id="meeting-emailClient" name="meeting-emailClient" placeholder="Email">
            <br><br>
            <button type="submit" name="submit-meeting">Prenota l'appuntamento</button>
            <button type="reset">Reset</button>
            <br>
        </form>

        <a href="../index.html"><button>Esci</button></a>
        <br>

        <?php
        //Check login error
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "submit-form") {
                echo '<p class = "errorMessages">! Errore invio form, riprova !</p>';
            } else if ($_GET['error'] == "no-meetingTime") {
                echo '<p class = "errorMessages">! Data e ora del meeting non selezionate !</p>';
            } else if ($_GET['error'] == "no-name") {
                echo '<p class = "errorMessages">! Nominativo non inserito !</p>';
            } else if ($_GET['error'] == "no-meetingObject") {
                echo '<p class = "errorMessages">! Nessun oggetto del meeting inserito !</p>';
            } else if ($_GET['error'] == "no-meetingEmployee") {
                echo '<p class = "errorMessages">! Nessun impiegato selezionato !</p>';
            }else if ($_GET['error'] == "no-meetingEmailClient") {
                echo '<p class = "errorMessages">! Nessuna email inserita !</p>';
            }else if ($_GET['error'] == "notcorrect-meetingEmailClient") {
                echo '<p class = "errorMessages">! Email invalida !</p>';
            }
        }
        ?>
    </center>
</body>

</html>