<?php

include 'connection.php';

//controllo se è stato effettuata una richiesta POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if($_POST['n_nome'] == "" || $_POST['n_cognome'] == "" || $_POST['n_email'] == "" || $_POST['n_password'] == "" || $_POST['n_confpassword'] == ""){
        /**
         * Caso in cui uno dei campi non è stato completato
         * redirect alla pagina inserisciRubricaAdmin.php con error 1
         * 
         * error => 1 => Compilare tutti i campi
         */
        redirect_to_add(1);
    }
    else if($_POST['n_password'] == $_POST['n_confpassword']){

        $nome = test_input($_POST['n_nome']);
        $cognome = test_input($_POST['n_cognome']);
        $mail = test_input($_POST['n_email']);
        $password = test_input($_POST['n_password']);

        //criptaggio della password
        $password = password_hash($password,PASSWORD_DEFAULT);
        
        //richiamo la funzione che inserisce il record nel database
        addAdmin($nome,$cognome,$mail, $password);
    }
    else{
        /**
         * Caso in cui il campo della password e della conferma non coincidono
         * redirect alla pagina inserisciRubricaAdmin.php con error 1
         * 
         * error => 2 => I campi password e conferma password devono contenere la stessa password
         */
        redirect_to_add("2");
    }
}

function addAdmin($nome,$cognome,$mail, $password){
    
    $dbname = "id16206619_dbaccessi";
    $conn = connect($dbname);

    if(!$conn){
        /**
         * Caso in cui si verifichi un errore durante la connessione al database
         * redirect alla pagina inserisciRubricaAdmin.php con error 1
         * 
         * error => 3 => Errore durante la connessione al database
         */
        redirect_to_add("3");
    }
    else{

        $sql = "INSERT INTO Administrator (Nome,Cognome,Email,Password_) VALUES ('$nome', '$cognome', '$mail', '$password')";
        
        if($conn->query($sql)){

        /**
         * Caso in cui venga aggiunto il record correttamente
         * redirect alla pagina creameeting.php con confirm 2
         * 
         * confirm => 2 => Amministratore aggiunto con successo
         */
            redirect_to_meeting(2);
        }
        else{

        /**
         * Caso in cui la query d'inserimento produce un errore
         * redirect alla pagina inserisciRubricaAdmin.php con error 4
         * 
         * error => 4 => Amministratore aggiunto con successo
         */
            redirect_to_add(4);
        }
    }
}

function test_input($data)

{

    //rimozione spazi bianchi o caratteri predefiniti

    $data = trim($data);

    //rimozione backslash aggiunti con la funzione addslashes()

    $data = stripslashes($data);

    //conversione dei caratteri predefiniti in entità html

    $data = htmlspecialchars($data);

    return $data;
}


function redirect_to_meeting($errortype)
{

    header("location: ../creameeting.php?confirm=$errortype");  

    exit();
}

function redirect_to_add($errortype)
{

    header("location: ../inserisciRubricaAdmin.php?error=$errortype");

    exit();
}


?>