<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Visualizza persone in azienda</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='#'>
    <script src='#'></script>
</head>

<body>
    <center>
        <h1> Visualizza persone in azienda</h1>

        <table>
            <!-- Stampa della query contenente i record in mep con orario settato e uscita no.-->
        </table>

        <select name="n_sfilter" id="i_sfilter">
            <option value="Data crescente"> Data Crescente</option>
            <option value="Data decrescente"> Data Decrescente </option>
            <option value="Ultimi 10"> Ultimi 10 </option>
            <option value="Ultimi 20"> ultimi 20</option>
        </select>
    </center>

    <footer>

        <button id="i_bback" name="n_bback" onclick="window.location.href='visualizza.php'"> Indietro </button>

    </footer>
</body>

</html>