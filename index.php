<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css?v1.3">
    <title>Sesja</title>
</head>
<body>
<?php 
include_once("header.php");
include_once("laczenieZbaza.php");
?>

<div class="contener">
<div class="showcase">
<?php
$pyt_produkt = $conn -> query("SELECT nazwa, cena, zdjecie1,link FROM produkty LIMIT 3");

while($linia = $pyt_produkt->fetch()){
    $nazwa = ucfirst($linia["nazwa"]);
    echo "<div>";
    echo "<a style='color: black; text-decoration:none;' href=$linia[link]>";
    echo "<img src=$linia[zdjecie1]>";
    echo "<p style='font-size: 1.4rem;'>$nazwa</p>";
    echo "<p style='font-size: 0.9rem; font-weight:bold;'>$linia[cena] PLN</p>";
    echo "</a>";
    echo "</div>";
}
?>
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
<script src="slideshow.js"></script>