<?php
session_start();
include_once("laczenieZbaza.php");

//nabywca
$email = $_POST["email"];

$pyt1 = $conn -> prepare("SELECT login FROM loginy WHERE login like ?");
$pyt1 -> execute([$email]);
if($pyt1){
    foreach($pyt1 as $linia){
        $mail_weryfikacja = $linia['login'];
    }
}

if($mail_weryfikacja == $email){

    // *Tytuł maila | base64 pozwala zrobic kodowanie na utf8 
    $tytul = '=?UTF-8?B?'.base64_encode('Reset hasła do konta Eshop').'?=';
    //token
    $token = substr(sha1(mt_rand()),0,20);
    $url = $_SERVER['HTTP_HOST']."/" .explode("/",$_SERVER['REQUEST_URI'])[1];
    $token_link = $url."/przeslanie_hasla.php"."?key=".$token;
    // Zawartość
    $img = file_get_contents("svg/logo1.svg");
    $imgbase = base64_encode($img);
    $content = "<h2>Witaj sklepowiczu</h2><br> <p>O to <a href=$token_link>link</a> do zmiany hasła. Jeśli to nie ty wysłałeś prośbe zmiany hasła. Skontaktuj się z nami pod support@gmail.com. Najlepiej zmień hasło!</p><br><p>Jeśli link nie działa wklej w wyszukiwarke:</p><p>$token_link</p><br><br><br><br><br><p>Pozdrawia i życzy miłego dnia</p> <p>zespół sklepu Eshop</p><img src='data:image/x-icon;base64,$imgbase' width='100px' height=auto alt=''>";
    $content = wordwrap($content,70,"\r\n");
    //poczatek wiadomosci
    $headers = "From: <no-reply@gmail.com>" . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=UTF-8' . "\r\n";


    if(mail($email, $tytul, $content, $headers)){
        //przypisanie tokenu
        $pyt3 = $conn->prepare("UPDATE loginy SET token_hasla = ? WHERE login like ?");
        $pyt3 -> execute([$token, $email]);
    }
    else{
        $_SESSION['error'] = "Błąd z wysłaniem maila";
        header("location: reset_hasla.php");
    }
}
else{
    $_SESSION['error'] = "Email nie jest zarejestrowany";
    header("location: reset_hasla.php");
}
$conn = null;


?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css?v=1.1">
    <title>Sesja</title>
</head>
<body>
<?php include_once("header.php");?>
<div class="contener">
<section class="wrap-sign-up-in" style='margin-top: 50px;'>
    <div class='zaloguj'>
        <div class="divy-grid">
			<p>Wysłaliśmy na <?php echo $email ?> wiadomość do zmiany hasła. Znajdziesz go w skrzynce odbiorczej, bądź w spamie. Jeśli jej nie otrzymałeś napisz do nas: support@gmail.com</p>
        </div>
    </div>

</section>
</div>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>