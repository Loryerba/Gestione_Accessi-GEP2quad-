<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login Amministativo</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='#'>
    <link rel="stylesheet" href="css/styleLogin.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway"> <!-- FONT BELLO -->
    <link rel="icon" type= “image/x-icon”  href="faviconFolder/favicon001.ico"/>
    <script src='js/script.js'></script>
</head>

<style>

body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}  

</style>    

<body>
    <center>
        <!-- Immagine in alto a sx -->
        <a href="login.php"> <img src="#"> </a>
        <!-- Form per l'accesso al pannello amministrativo-->
            <form action="validator/validatelogin.php" method="post">
                <h1> Login </h1>
                <!-- Input username -->
                <?php
                /** dsfs
                 * Tabella dei redirect
                 * redirect type:
                 * 1 --> campo username vuoto
                 * 
                 * 2 --> formato della mail incorretto
                 * 
                 * 3 --> campo password vuoto
                 * 
                 * 4 --> errore durante la connesione al db
                 * 
                 * 5 --> nessun record coincide con quello inserito
                 * 
                 * 6 --> il database non contiene record
                 * 
                 * 7 --> Session timeout
                 * 
                 */
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                    echo "<div> <p style='color:red'> Il campo username è vuoto.</p></div>";
                } else if (isset($_GET['error']) && $_GET['error'] == 2) {
                    echo "<div> <p style='color:red'> Il formato del campo username è incorretto.</p></div>";
                } else if (isset($_GET['error']) && $_GET['error'] == 3) {
                    echo "<div> <p style='color:red'> Il campo password è vuoto </p></div>";
                } else if (isset($_GET['error']) && $_GET['error'] == 4) {
                    echo "<div> <p style='color:red'> Errore durante la verifica. </p></div>";
                } else if (isset($_GET['error']) && $_GET['error'] == 5) {
                    echo "<div> <p style='color:red'> Login fallito. Registrati se vuoi accedere al portale. </p></div>";
                } else if (isset($_GET['error']) && $_GET['error'] == 6) {
                    echo "<div> <p style='color:red'> Login fallito. Registrati se vuoi accedere al portale. </p></div>";
                } else if (isset($_GET['error']) && $_GET['error'] == 7) {
                    echo "<div> <p style='color:red'> Timeout session. </p></div>";
                } else if (isset($_GET['error']) && $_GET['error'] == 8) {
                    echo "<div> <p style='color:red'> Log registering error. </p></div>";
                }
                ?>

                <div class="container">

                <p> Username: <br><input type="text" placeholder="Inserisci Username" name="n_username" id="i_username"> </p>
                <!-- Input password -->
                <p> Password: <br><input type="password" placeholder="Inserisci Password" name="n_password" id="i_password"> </p>
                <!-- Bottone per il submit-->
                <p> <input type="submit" value="Login" name="Accedi" class="bottone"> </p>

                </div>

                <div class="container" style="background-color:#ddd7d7b2">
                <button type="reset" class="cancelbtn">Cancella</button>
                </div>

            </form>
    </center>
</body>

</html>