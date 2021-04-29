<?php
class QRCode
{
    //Type of chart (qr)
    private static $_CHT = "qr";

    //Google API QR
    private static $_API_URL = "http://chart.apis.google.com/chart";

    public function getQrCodeUrl($data,$width,$height,$encoding=false,$correctionLevel=false) {
  
        //faccio encoding dei dati
        $data = urlencode($data);
        
        //Create URL
        $url = QRCode::$_API_URL . "?cht=". QRCode::$_CHT
                     . "&chl=" . $data
                     . "&chs=" . $width . "x" . $height;
      
        //Optiona check parameters
        if($encoding){
          $url .= "&choe=" . $encoding;
        }
        
        if($correctionLevel){
          $url .= "&chld=" . $correctionLevel;
        }
        
        return $url;
      }
}
