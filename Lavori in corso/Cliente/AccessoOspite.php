<html>

<head>
    <title>Prenotazione appuntamento</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway"> <!-- FONT BELLO -->
    <script src="js/script.js"></script>
    <style>
    </style>
</head>

<style>

body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}  

</style> 

<body onload="loadPage()" style = "background-color: #F5F5F5;">
    <center>
        <form action="validator/checkForm.php" onsubmit="return checkFields()" name="meeting" id="meeting">

        <div id = "container">

            <h2>Prenota un appuntamento</h2>
            <br>
            <hr class ="linea">


        
        <div class = "content">
        
            <h4>Seleziona la data e l'ora desiderata:</h4>
            <input type="datetime-local" id="meeting-time" name="meeting-time" min="2017-06-01T08:30">

            <h4>Inserisci un nominativo:</h4>
            <input type="text" id="meeting-nameClient" name="meeting-nameClient" placeholder="Nome e cognome">

            <h4>Inserisci l'oggetto del meeting e una breve descrizione:</h4>
            <input type="text" id="meeting-object" name="meeting-object" placeholder="Oggetto meeting">
            <br><br>

            <textarea id="meeting-description" name="meeting-description" rows="4" cols="50" placeholder="Descrizione opzionale"></textarea>

            <h4>Scegli l'impiegato interessato al meeting:</h4>

            <?php
            include 'validator/connection.php';
            $conn = connect('id16206619_dbaccessi');

            if (!$conn) {
                //Error connection
                echo '<select id="meeting-employee" name="meeting-employee">
                    <option value="Seleziona qualcuno">Errore nel caricamento degli impiegati, ricarica la pagina</option>
                </select>';
            } else {
                echo '<select id="meeting-employee" name="meeting-employee">';
                echo '<option value="Seleziona qualcuno">Seleziona un impiegato</option>';

                //Query
                $sql = "SELECT * FROM Administrator";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cognome = $row['Cognome'];
                        $nome = $row['Nome'];
                        $id = $row['Id_A'];

                        echo "<option value='$id'>$cognome</option>";
                    }
                } else {
                    echo "<option value='Errore nel caricamento degli impiegati, ricarica la pagina' </option>";
                }
                echo "</select>";
            }
            ?>

            <h4>Inserisci un'e-mail per essere contattato successivamente:</h4>
            <input type="email" id="meeting-emailClient" name="meeting-emailClient" placeholder="Email">
            <br><br>
            <button type="submit" name="submit-meeting">Prenota l'appuntamento</button>
            <button type="reset">Reset</button>
            <br>

        </div>

        </div>

        </form>

        <br>

        <div class = "divButton">

        <!--<a href="../index.php"><button>Esci</button></a>-->
        <p> <button onclick="window.location.href='../index.php'"> Esci </button></p>
        

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
            } else if ($_GET['error'] == "no-meetingEmailClient") {
                echo '<p class = "errorMessages">! Nessuna email inserita !</p>';
            } else if ($_GET['error'] == "notcorrect-meetingEmailClient") {
                echo '<p class = "errorMessages">! Email invalida !</p>';
            }
        }
        ?>

        </div>

    </center>

    

</body>
</html>