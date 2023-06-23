<!-- <?php
echo "<h1 style=text-align:center;>".date("d-m-Y H:i:s")."</h1><br>";

?> -->
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
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$indeks1 = explode("http://localhost/forum/", $actual_link);
$indeks = explode(".php",$indeks1[1]);
$pyt_prod= $conn -> prepare("SELECT nazwa,cena,ilosc,rozmiar,opis,zdjecie FROM produkty WHERE indeks_produktu like '$indeks[0]'");
?>

<div class="contener">

<div class="grid_produkt">
    <div id="div1">
    <!-- photo produktu -->
        <?php echo "<img src=$zdjecie alt='zdjecie/produktu'>"?>
    </div>

    <div id="div2">
    <!-- info -->
        <?php
        echo "<h2></h2>";
        echo "<h3></h3>";
        echo "<select name=rozmiar>
            <option value=Uniwersalny>Uniwersalny</option>
            <option value=XS>XS</option>
            <option value=S>S</option>
            <option value=M>M</option>
            <option value=L>L</option>
            <option value=XL>XL</option>
            <option value=XXL>XXL</option>
        </select>";
        ?>
    </div>

    <div id="div3">
    <!-- opis -->
        
    </div>
</div>

</div>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>