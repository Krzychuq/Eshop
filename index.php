<?php
session_start();
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
include_once("header.php");
include_once("laczenieZbaza.php");
?>

<div class="contener">
<div class="showcase">
<?php
$pyt_produkt = $conn -> prepare("SELECT nazwa, cena, zdjecie FROM produkty WHERE id < ?");
$pyt_produkt -> execute([4]);

while($linia = $pyt_produkt->fetch()){
    echo "<div>";
    echo "<img src=$linia[zdjecie] width=100px height=100px>";
    echo "<p>$linia[nazwa]</p>";
    echo "<p>$linia[cena] zł</p>";
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