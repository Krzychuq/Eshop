<?php
// on top script
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendmail($email, $tytul, $tresc){
    //Load Composer's autoloader
    require '../../phpMyAdmin/vendor/autoload.php';
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/PHPMailer.php';


    // OLD *Tytuł maila | base64 pozwala zrobic kodowanie na utf8 
    // $tytul = '=?UTF-8?B?'.base64_encode($tytul).'?=';


    $mail = new PHPMailer(true);

    try {
        //Server settings        
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'krzysiu.krzys65@gmail.com';                   
        $mail->Password   = 'vjfigydgyetdtxwe';                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;   
        $mail->CharSet = "UTF-8";    
        $mail->setLanguage('pl', '/optional/path/to/language/directory/');                      

        //nadawca i odbiorca
        $mail->setFrom('krzysiu.krzys65@gmail.com', 'Eshop');
        $mail->addAddress($email);
        $mail->WordWrap = 70;

        //Attachments
        // if(!empty($plik1)){ $mail->addAttachment($plik1); }


        //Content
        $mail->isHTML(true);  
        $mail->AddEmbeddedImage("photos/logo1.png", "logo1", "logo1.png"); //logo                        
        $mail->Subject = $tytul;
        $mail->Body    = $tresc;
        // $mail->AltBody = 'Please enable HTML messages | Prosze włącz wiadomości HTML ';

        $mail->send();
        return TRUE;
    } catch (Exception $e) {
        echo "{$mail->ErrorInfo}";
        return FALSE;
    }

}

?>