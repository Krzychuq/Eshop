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
        $profilowe = $linia['avatar'];
        $nick = $linia['nazwa'];
        $uro = $linia['data_urodzenia'];
        $tel = $linia['nr_tel'];
        $miasto = $linia['miasto'];
        $kraj = $linia['kraj'];
        $opis = $linia['opis_konta'];
    }
    $conn = null;
    
?>

<div class="profil">

<?php 
if(!empty($profilowe)){
    echo "<img src=$profilowe class=zdjecie_profilowe>"; 
}
else{
    echo "<img src=https://www.kindpng.com/picc/m/105-1055656_account-user-profile-avatar-avatar-user-profile-icon.png class=zdjecie_profilowe>";
}



?>

</div><br>

<div class="info_profilu">
    <?php
if(!empty($nick)){
    echo "<p style='border-top-right-radius: 5px; border-top-left-radius: 5px; font-size:30px; text-align:center;'>$nick</p>";
}
else{
    echo "<p style='border-top-right-radius: 5px; border-top-left-radius: 5px; font-size:30px; text-align:center;'>$_SESSION[email]</p>";
}
?>
<p>Urodziny: <?php echo $uro?></p>
<p>Numer telefonu: <?php echo $tel ?></p>
<p>Miasto: <?php echo $miasto ?></p>
<p>Kraj: <?php echo $kraj ?></p>

<div class='opis_konta'>
    <p style="border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; color:white; background-color:black;">O mnie: <br> <?php echo $opis ?></p>
</div>

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

<?php 
    if(isset($_SESSION['wiadomosc_o_zdjeciu'])){
        echo $_SESSION['wiadomosc_o_zdjeciu'];
        unset($_SESSION['wiadomosc_o_zdjeciu']);
    }
?>
</div>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>