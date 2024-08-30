<?php
session_start();
    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email']) ){
        //nic
    }
    else{
        header("location: index.php");
    }
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
<div class="contener">
<?php include_once("header.php");?>
<?php include_once("laczenieZbaza.php");?>
<section class="wrap-konta">
    
<?php
    $mail = $_SESSION['email'];
    //identyfikacja
    $mail = $_SESSION['email'];
    $pyt_o_id = $conn->prepare("SELECT id FROM loginy WHERE login like ?");
    $pyt_o_id -> execute([$mail]);
    $wykonanie = $pyt_o_id->fetch(PDO::FETCH_ASSOC);
    $id = $wykonanie['id'];

    //dane konta
    $pyt_o_dane = $conn->prepare("SELECT * FROM dane_konta WHERE id_loginu = ?");
    $pyt_o_dane -> execute([$id]);
    $wykonanie = $pyt_o_dane->fetchAll();

    foreach ($wykonanie as $wynik){
        $imie = $wynik['imie'];
        $nazwisko = $wynik['nazwisko'];
        $nip = $wynik['NIP'];
        $tel = $wynik['nr_tel'];
        $miasto = $wynik['miasto'];
        $ulica = $wynik['ulica'];
        $nr_domu = $wynik['nr_domu'];
        $nr_mieszkania = $wynik['nr_mieszkania'];
        $kod_pocztowy = $wynik['kod_pocztowy'];
        $kraj = $wynik['kraj'];
        $dostep = $wynik['dostep'];
    }
    $conn = null;
    
?>
<div class="profil">
<div class="mailkonta">
<?php
    if($dostep == 1){ echo "<p style='border-top-right-radius: 5px; border-top-left-radius: 5px; font-size:18px;'>ADMIN| $_SESSION[email]</p>"; }
    else{ echo "<p style='border-top-right-radius: 5px; border-top-left-radius: 5px; font-size:18px;'>$_SESSION[email]</p>"; }
?>
</div><br>

<div class="info_profilu">

<p>Imię: <?php echo $imie; ?></p>
<p>Nazwisko: <?php echo $nazwisko; ?></p>
<p>NIP: <?php echo $nip; ?></p>
<p>Nr telefonu: <?php echo $tel; ?></p>
<p>Ulica: <?php echo $ulica; ?></p>
<p>Nr domu: <?php echo $nr_domu; ?></p>
<p>Nr mieszkania: <?php echo $nr_mieszkania; ?></p>
<p>Kod pocztowy: <?php echo $kod_pocztowy; ?></p>
<p>Miasto: <?php echo $miasto; ?></p>
<p>Kraj: <?php echo $kraj; ?></p>


</div>
</div><br>
<?php

?>
<!-- <div class='aktualne_zamowienie_wglad'>
<h2 style='text-align: center;'>Ostatnie zamówienie</h2>
<a href=''>
    <div class='first-aktualne-zamowienie'>
    <h4>Numer zamówienia: </h4>

    </div>
    <div class='secound-aktualne-zamowienie'>
    <p>Data zakupu: </p>
    <p>Status: </p>
    <p>Kwota: </p>
    
    </div>
    
    <div class='third-aktualne-zamowienie'>
    <img src='zdjecia_produktow/' style='border-radius: 5px; border:1px #111111 solid;' width='100px' height='90px' alt=''>
    
    </div>
</a>
</div> -->
<div id="zmien_dane_div">
    <a href="edytuj_konto.php" id="zmien_dane"><button id="zmien_dane_button">Zmień dane</button></a>
</div>
</section class="wrap-konta">
<br>

</div>
<?php 
if(isset($_SESSION['error'])){
    echo "<div class='error'>" . "&#10005 ". $_SESSION["error"] . "</div>";
    unset($_SESSION['error']);
    echo "<script src='blad.js'></script>";
}
if(isset($_SESSION['success'])){
    echo "<div class='success'>" . "&#10003 ". $_SESSION["success"] . "</div>";
    unset($_SESSION['success']);
    echo "<script src='powiadomienie.js'></script>";
}
?>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>