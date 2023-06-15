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

    // Tytuł maila
    $tytul = 'Reset hasła do konta Session';
    //token
    $token = substr(sha1(mt_rand()),0,20);
    $token_link = "localhost/session/przeslanie_hasla.php"."?key=".$token;
    // Zawartość
    $content = "<h2>Witaj!</h2> <p>O to <a href=$token_link>link</a> do zmiany hasła.Jeśli to nie ty wysłałeś prośbe zmiany hasła. Skontaktuj się znami pod support@gmail.com i zmień hasło!</p>";
    $content = wordwrap($content,70,"\r\n");
    //poczatek wiadomosci
    $headers = "From: <no-reply@gmail.com> \r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    if(mail($email, $tytul, $content, $headers)){
        //przypisanie tokenu
        $pyt3 = $conn->prepare("UPDATE loginy SET token_hasla = ? WHERE login like ?");
        $pyt3 -> execute([$token, $email]);
    }
    else{
        $_SESSION['error'] = "Błąd z wysłaniem";
        header("location: reset_hasla.php");
    }
}
else{
    $_SESSION['error'] = "Błędny email";
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
<div style="content">
<section class="wrap-sign-up-in">
    <div class='zaloguj'>
        <div class="divy-grid">
			<p>Wysłaliśmy na <?php echo $email;?> wiadomość do zmiany hasła. Znajdziesz go w skrzynce odbiorczej, bądź w spamie. Jeśli jej nie otrzymałeś napisz do nas: support@gmail.com</p>
        </div>
    </div>

</section>
</div>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>