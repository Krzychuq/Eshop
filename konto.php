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

    foreach ($wykonanie as $linia){
        $imie = $linia['imie'];
        $nazwisko = $linia['nazwisko'];
        $tel = $linia['nr_tel'];
        $ulica = $linia['ulica'];
        $miasto = $linia['miasto'];
        $kod_pocztowy = $linia['kod_pocztowy'];
        $kraj = $linia['kraj'];
        $dostep = $linia['dostep'];
    }
    $conn = null;
    
?>

<div class="profil">
    <img src="https://www.kindpng.com/picc/m/105-1055656_account-user-profile-avatar-avatar-user-profile-icon.png" class="zdjecie_profilowe">
</div><br>

<div class="info_profilu">
<?php
    echo "<p style='border-top-right-radius: 5px; border-top-left-radius: 5px; font-size:18px;'>Email: $_SESSION[email]</p>";
    if($dostep == 1){
        echo "<p>"."Administrator"."</p>";
    }
?>
<p>Imię: <?php echo $imie ?></p>
<p>Nazwisko: <?php echo $nazwisko ?></p>
<p>Numer telefonu: <?php echo $tel ?></p>
<p>Miasto: <?php echo $miasto ?></p>
<p>Kod pocztowy: <?php echo $kod_pocztowy ?></p>
<p>Kraj: <?php echo $kraj ?></p>


</div><br>
</section class="wrap-konta">
<br>
<div id="zmien_dane_div">
    <a href="edytuj_konto.php" id="zmien_dane"><button id="zmien_dane_button">Zmień dane</button></a>
</div>
<?php
    $dostep = $_SESSION['dostep'];
    if($dostep > 0){
        echo "<div id='panel'><a href='panel.php' id='zmien_dane'><button id='zmien_dane_button'>Panel</button></a></div>";
    }

?>

</div>
<?php 
if(isset($_SESSION['wiadomosc_o_zdjeciu'])){
    echo "<div class='error'>" . "&#10005 ". $_SESSION["wiadomosc_o_zdjeciu"] . "</div>";
    unset($_SESSION['wiadomosc_o_zdjeciu']);
    echo "<script src='blad.js'></script>";
}
?>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>