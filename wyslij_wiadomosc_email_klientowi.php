<?php
session_start();
if(!empty($_POST["tekst"]) && isset($_POST["tekst"])){
    $email = $_POST["email"];
    // Tytuł maila
    $tytul = 'Support Session';
    // Zawartość
    $content = $_POST["tekst"];
    $content = wordwrap($content,70,"\r\n");
    //poczatek wiadomosci
    $headers = "From: <no-reply@gmail.com> \r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    if(mail($email, $tytul, $content, $headers)){
        $_SESSION['success'] = "Wysłano odpowiedź";
    }
    else{
        $_SESSION['error'] = "Błędny email";
    }
}
else{
    $_SESSION['error'] = "Napisz wiadomość";
}

header("location: wiadomosci_klientow.php");
?>