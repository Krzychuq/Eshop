<?php
session_start();
if(isset($_SESSION['email'])) {
    $czas_aktualny = time();
    
    if ($czas_aktualny > $_SESSION['expire']) {
        session_unset();
        session_destroy();
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css?v1.1">
    <title>Sesja</title>
</head>
<body>
<?php 
include_once("laczenieZbaza.php");
include_once("header.php");
?>

<div class="contener">
<div class="showcase">
    <p class="showcase_tytul">Nowości</p>
    <div class="showcase_flex">
<?php
$pyt_produkt = $conn -> query("SELECT nazwa, cena, zdjecie, indeks_produktu FROM produkty LIMIT 3");

while($wynik = $pyt_produkt->fetch()){
    $nazwa = ucfirst($wynik["nazwa"]);
    $zdjecie = explode(",",$wynik["zdjecie"]);
    include("link_creator.php");
    echo "<div>";
    echo "<a style='color: black; text-decoration:none;' href=$link>";
    echo "<img src='zdjecia_produktow/$zdjecie[0]'>";
    echo "<p class='showcase_flex_nazwa'>$nazwa</p>";
    echo "<p class='showcase_flex_cena'>$wynik[cena] zł</p>";
    echo "</a>";
    echo "</div>";
}

$conn = null;
?>
    </div>
</div>
<div class="lista_produktow_poziom">

    
</div>

<div class="lista_produktow_poziom">
    
</div>

</div>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>