<?php
//Include class
require_once 'qrcode.class.php';

//QRCod objet
$qrcode = new QRCode();

?>
<html>
<body>
    <center>
        <form action="" method="post">
            <h1>Insert something</h1>
            <input type="text" name="txt" size="50">
            <br><br>
            <button type="submit" name="SubmitButton">Generate QR Code</button>
        </form>
    </center>
</body>

</html>

<?php
//Check if form was submitted
if (isset($_POST['SubmitButton'])) {
    //Get input text
    $txt = $_POST['txt'];

    //Call getQrCodeUrl method
    echo '<center><img alt="ciao" src="' . $qrcode->getQrCodeUrl($txt, 300, 300, "UTF-8", "H") . '" /></center>';
}
?>