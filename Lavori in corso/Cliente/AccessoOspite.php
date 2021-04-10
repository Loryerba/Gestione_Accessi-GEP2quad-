<html>

<head>
    <title>Prenotazione appuntamento</title>
    <link rel="stylesheet" href="css/style.css" />
    <!-- FONT -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <script src="js/script.js"></script>
    <!-- FAVICON -->
    <link rel="icon" type=“image/x-icon” href="faviconFolder/favicon001.ico" />

</head>

<style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: "Raleway", sans-serif;
    }
</style>

<body style="background-color: #59c0f349;">
    <center>
        <form action="validator/checkForm.php" onsubmit="return checkField()" name="meeting" id="meeting">
            <div id="container">
                <h2>Prenota un appuntamento</h2>
                <br>
                <hr class="linea">
                <div class="content">
                    <!-- FORM -->
                    <h4>Seleziona la data desiderata:</h4>
                    <input type="date" id="meeting-date" name="meeting-date" placeholder="Selezionare la data">

                    <script>
                        //Set attribute min today to input date
                        var today = new Date().toISOString().split('T')[0];
                        document.getElementsByName("meeting-date")[0].setAttribute('min', today);
                    </script>

                    <h4>Seleziona l'ora desiderata</h4>
                    <input type="time" id="meeting-time" name="meeting-time" placeholder="Inserire l'orario">

                    <h4>Inserisci un nominativo:</h4>
                    <input type="text" id="meeting-nameClient" name="meeting-nameClient" placeholder="Nome e cognome">

                    <h4>Inserisci l'oggetto del meeting e una breve descrizione:</h4>
                    <input type="text" id="meeting-object" name="meeting-object" placeholder="Oggetto meeting">
                    <br><br>

                    <textarea id="meeting-description" name="meeting-description" rows="4" cols="50" placeholder="Descrizione opzionale"></textarea>

                    <h4>Scegli l'impiegato interessato al meeting:</h4>

                    <?php
                    //Connect to db to get the administrators
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

                        //Check result
                        if ($result->num_rows > 0) {
                            //Out all the administrators
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
                    <button type="submit" name="submit-meeting" id="buttonForm">Prenota l'appuntamento</button>
                    <button type="reset" id="buttonForm">Reset</button>
                    <br>
                </div>
            </div>
        </form>

        <?php
        //Output errors
        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 1:
                    echo "<script>alert('Data del meeting non selezionata')</script>";
                    break;
                case 2:
                    echo "<script>alert('É stato selezionato un giorno festivo')</script>";
                    break;
                case 3:
                    echo "<script>alert('Nominativo non inserito')</script>";
                    break;
                case 4:
                    echo "<script>alert('Nessun oggetto del meeting inserito')</script>";
                    break;
                case 5:
                    echo "<script>alert('Nessun impiegato selezionato')</script>";
                    break;
                case 6:
                    echo "<script>alert('Nessuna email inserita')</script>";
                    break;
                case 7:
                    echo "<script>alert('Email non valida')</script>";
                    break;
                case 8:
                    echo "<script>alert('Errore invio form, riprova')</script>";
                    break;
                case 9:
                    echo "<script>alert('Errore invio email di richiesta, riprova')</script>";
                    break;
                case 10:
                    echo "<script>alert('Compila tutti i campi')</script>";
                    break;
                case 11:
                    echo "<script>alert('Seleziona un orario tra le 08:00 e le 17:30')</script>";
                    break;
                case 12:
                    echo "<script>alert('Ora del meeting non selezionata')</script>";
                    break;
            }
        }

        //Output "ok" messages
        if (isset($_GET['ok'])) {
            switch ($_GET['ok']) {
                case 1:
                    echo "<script>alert('Email inviata')</script>";
                    break;
            }
        }
        ?>
        <p> <button onclick="window.location.href='../index.php'" id="bottoneExit"> Esci </button></p>
        <br>
        <br>
    </center>
</body>

</html>