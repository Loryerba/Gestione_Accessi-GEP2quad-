<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Accesso</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='#'>
    <script src='js/script.js'></script>
</head>
<body>
    <center>
        <!-- Immagine in alto a sx -->
        <a href="login.php"> <img src="#"> </a>
        <!-- Form per l'accesso al pannello amministrativo-->
        <form action="validateLogin.php" method="post">
            <h1> Login </h1>
            <!-- Input username -->
            <p> Username: <input type="email" name="username" id="i_username"> </p>
            <!-- Input password -->
            <p> Password: <input type="password" name="password" id="i_password"> </p>
            <!-- Bottone per il submit-->
            <p> <input type="submit" value="Login" name="Accedi"> </p>
        </form>

    </center>
</body>
</html>