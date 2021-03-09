<?php

if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['timesetted'])){
    echo '1';
}
else{
    echo '0';
}


?>