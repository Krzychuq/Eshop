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
    <link rel="stylesheet" href="s.css?v1.1">
    <title>Sesja</title>
</head>
<body>
<?php 
include_once("header.php");
include_once("laczenieZbaza.php");
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$indeks1 = explode("http://localhost/forum/", $actual_link);
$indeks = explode(".php",$indeks1[1]);
$pyt_prod= $conn -> prepare("SELECT nazwa,cena,ilosc,opis,zdjecie FROM produkty WHERE indeks_produktu like ?");
$pyt_prod->execute(["952182t"]);
$dane = $pyt_prod->fetch();
$pyt_rozmiar= $conn -> prepare("SELECT rozmiary_produktow.rozmiar FROM produkty inner join rozmiary_produktow on produkty.id = rozmiary_produktow.id_produktu WHERE produkty.indeks_produktu like ?;");
$pyt_rozmiar->execute(["952182t"]);
$rozmiary = $pyt_rozmiar->fetchAll();
?>

<div class="contener">

<div class="grid_produkt">
    <div id="div1">
    <!-- photo produktu -->
        <?php echo "<img src='$dane[zdjecie]' width='400px' height='auto' alt='zdjecie/produktu'>"; ?>
    </div>

    <div id="div2">
    <!-- info -->
        <?php
        echo "<form action=dodaj_do_koszyka.php method=GET>";
        echo "<label name='$dane[nazwa]' id=nazwa>".ucfirst($dane["nazwa"])."</label>";
        echo "<label name='$dane[cena]' id=cena>$dane[cena] zł</label>";
        echo "<label name='$dane[ilosc]' id=ilosc>Ilość: $dane[ilosc]</label>";
        echo "<span>Rozmiary</span> "."<select id=rozmiar name=rozmiar>";
        foreach($rozmiary as $rozmiar){
            echo "<option value=$rozmiar[rozmiar]>".$rozmiar["rozmiar"]."</option>";
        }
        echo "</select>";
        ?>
    </div>

    <div id="div3">
    <!-- opis -->
        <?php
        echo "<p>".$dane["opis"]."</p>";
        ?>
    </div>
</div>

</div>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>
