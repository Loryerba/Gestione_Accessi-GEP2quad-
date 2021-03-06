<!DOCTYPE html>
<html>

<head>
    <title>Pannello principale</title>
    <link rel="stylesheet" href="css/styleIndex.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" type= “image/x-icon”  href="faviconFolder/favicon001.ico"/>

    <style>
        
    </style>
</head>

<body>

    <div class='split-pane col-xs-12 col-sm-6 client-side'>
        <div>
            <img src="img/image002.png">
            <div class='text-content'>
                <div class="bold">Accesso</div>
                <div class='big'>CLIENTI</div>
            </div>


            <form action="Cliente/AccessoOspite.php">
                <button>
                    Vai all'accesso clienti
                </button>
            </form>
        </div>
    </div>

    <div class='split-pane col-xs-12 col-sm-6 frontend-side'>
        <div>
            <img src='img/image002.png'>
            <div class='text-content'>
                <div class="bold">Accesso</div>
                <div class='big'>ADMIN</div>
            </div>
            <form action="Personale/login.php">
                <button>
                    Vai all'accesso amministratori
                </button>
            </form>
        </div>
    </div>
    <div id='split-pane-or'>
        <div>
            <img src='img/image001.png'>
        </div>
    </div>

</body>

</html>