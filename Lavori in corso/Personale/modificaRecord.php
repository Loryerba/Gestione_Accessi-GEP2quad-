<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Completa modifica</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='#'></script>
</head>
<style>
    table,td,th{
        border:1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
    <center>
        <h2> Modifica del meeting selezionato</h2>
        <!--Ricevere via get il record selezionato e prevedo la modifica dei campi-->
        <table>
            <tr>
                <th> Data Meeting</th>
                <th> Ora Meeting</th>
                <th> Descrizione</th>
            </tr>
        </table>
        <!-- Al click, aggiornare il record nel db e inviare mail di modifica -->
        <p> <button onclick="window.location.href='modificameeting.php'">Modifica Meeting </button></p>
        <p> <button onclick="window.location.href='modificameeting.php'"> Indietro </button> </p>
    </center>
</body>

</html>