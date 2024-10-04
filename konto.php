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
        $tel = $wynik['nr_tel'];
        $miasto = $wynik['miasto'];
        $ulica = $wynik['ulica'];
        $nr_domu = $wynik['nr_domu'];
        $kod_pocztowy = $wynik['kod_pocztowy'];
        $kraj = $wynik['kraj'];
        $dostep = $wynik['dostep'];
    }

    // dane faktury
    $pyt_o_dane = $conn->prepare("SELECT * FROM dane_do_faktury WHERE id_konta = ?");
    $pyt_o_dane -> execute([$id]);
    $wykonanie = $pyt_o_dane->fetchAll();

    foreach ($wykonanie as $wynik2){
        $nip = $wynik2['NIP'];
        $nazwa_firmy = $wynik2['nazwa_firmy'];
        $miasto_firmy = $wynik2['miasto'];
        $adres_firmy = $wynik2['adres'];
        $kod_pocztowy_firmy = $wynik2['kod_pocztowy'];
        $kraj_firmy = $wynik2['kraj'];
    }
    $conn = null;
    
?>
<div class="profil">
    <!-- \\\\\\\\\\\\\\\\\\\\\Dane konta///////////////////// -->
<div id="div1">
<div class="headerkonta">
    <h3>Dane konta:</h3>
</div><br>
<div class="info_profilu">
    <p>Email: <?php echo $_SESSION["email"];?></p>
    <p>Imię: <?php echo $imie; ?></p>
    <p>Nazwisko: <?php echo $nazwisko; ?></p>
    <p>Telefon: <?php echo $tel; ?></p>
</div>
</div>
<!-- \\\\\\\\\\\\\\\\\\\\\\Dane do wysylki/////////////////////// -->
<div id="div2">
<div class="headerkonta">
    <h3>Twój adres:</h3>
</div><br>
<div class="info_profilu">
    <p>Ulica: <?php echo $ulica; ?></p>
    <p>Nr domu/mieszkania: <?php echo $nr_domu; ?></p>
    <p>Kod pocztowy: <?php echo $kod_pocztowy; ?></p>
    <p>Miasto: <?php echo $miasto; ?></p>
    <p>Kraj: <?php echo $kraj; ?></p>
</div>
</div>

<!-- \\\\\\\\\\\\Dane do faktury//////////////////// -->
<div id="div3">
<div class="headerkonta">
    <h3>Dane do faktury:</h3>
</div><br>
<div class="info_profilu">
<?php
if(empty($nip)){
    echo "<p>NIP: ...</p>   
    <p>Firma: ...</p>
    <p>Adres: ...</p>
    <p>Kod pocztowy: ...</p>
    <p>Miasto: ...</p>
    <p>Kraj: ...</p>";
}
else{
    echo "<p>NIP: $nip</p>   
    <p>Firma: $nazwa_firmy</p>
    <p>Adres: $adres_firmy</p>
    <p>Kod pocztowy: $kod_pocztowy_firmy</p>
    <p>Miasto: $miasto_firmy</p>
    <p>Kraj: $kraj_firmy</p>";
}
?>
</div><br>
</div>
<!-- \\\\\\\\\\\\\\\\\\Ostatnie zamówienia///////////////// -->
<?php

?>
<div class='aktualne_zamowienie_wglad'>
<h2 style='text-align: center;'>Ostatnie zamówienia</h2>
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
</div>
<!-- \\\\\\\\\\button///////// -->
<div id="zmien_dane_div">
    <a href="edytuj_konto.php" id="zmien_dane"><button id="zmien_dane_button">Zmień dane</button></a>
</div>
</section class="wrap-konta">
<br>

</div>
<!-- \\\\\\\\\\\\\\\\\\\\\\| Powiadomienia |///////////////////// -->

<?php include_once("powiadomienia.php"); ?>


<!-- \\\\\\\\\\\\\\\\\\\\\\| /Powiadomienia |///////////////////// -->
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>