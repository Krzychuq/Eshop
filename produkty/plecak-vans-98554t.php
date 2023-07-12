<?php
session_start();
?>
<!DOCTYPE html>
<html lang='pl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../s.css?v1.1'>
    <title>Sesja</title>
</head>
<body>
<?php 
include_once('../header_produkty.php');
include_once('../laczenieZbaza.php');
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$indeks1 = explode('http://localhost/forum/produkty/', $actual_link);
$indeks2 = explode('.php',$indeks1[1]);
$indeks3 = explode('-',$indeks2[0]);
$pyt_prod= $conn -> prepare('SELECT nazwa,cena,ilosc,opis,zdjecie1 FROM produkty WHERE indeks_produktu like ?');
$indeks_produktu = end($indeks3);
$pyt_prod->execute([$indeks_produktu]);
$dane = $pyt_prod->fetch();
$pyt_rozmiar= $conn -> prepare('SELECT rozmiary_produktow.rozmiar, rozmiary_produktow.ilosc FROM rozmiary_produktow inner join produkty on rozmiary_produktow.id_produktu = produkty.id WHERE produkty.indeks_produktu like ? ORDER BY RIGHT (rozmiary_produktow.rozmiar,1) desc');
$pyt_rozmiar->execute([$indeks_produktu]);
$zdjecie_prod = "../". $dane["zdjecie1"];
$nazwa_prod = str_replace('-', ' ', $dane["nazwa"]);
?>

<div class='contener'>

<div class='grid_produkt'>
    <div id='div1'>
    <!-- photo produktu -->
        <?php echo "<img src=$zdjecie_prod id=prod width=400px height=auto alt=zdjecie/produktu>"; ?>
    </div>

    <div id="div2">
    <!-- info -->
        <?php
        echo "<form action=../dodaj_do_koszyka.php method=POST>";
        echo "<input style=display:none; name=indeks value=$indeks_produktu type=text>";
        echo "<p id=nazwa>".ucfirst($nazwa_prod)."</p>";
        echo "<p name=cena id=cena>".$dane["cena"]. "zł</p>";
        echo "<p name=ilosc id=ilosc>Dostepna ilość: ".$dane["ilosc"]."</p>";
        echo "<span>Rozmiary</span> "."<select id=rozmiar name=rozmiar >";
        while ($rozmiar = $pyt_rozmiar->fetch()) {
            echo "<option value=".$rozmiar["rozmiar"].">".$rozmiar["rozmiar"]. " |". $rozmiar["ilosc"] . "|".'</option>';
        }

        echo "</select>";
        echo "<button type=submit >Kup teraz</button></form>";
        ?>
    </div>

    <div id="div3">
    <!-- opis -->
        <?php
        echo "<h2>Opis produktu</h2><br>";
        echo "<p style=padding:1%; font-family:Segoe UI;>".$dane["opis"]."</p>";
        ?>
    </div>
</div>

</div>
<footer>
    <?php include_once('../footer_produkty.html'); ?>
</footer>
</body>
</html>
<script>
const container = document.getElementById('div1');
const img = document.getElementById('prod');

container.addEventListener('mousemove', onZoom);
container.addEventListener('mouseover', onZoom);
container.addEventListener('mouseleave', offZoom);

function onZoom(e) {
    const x = e.clientX - e.target.offsetLeft;
    const y = e.clientY - e.target.offsetTop;

    // console.log(x, y)

    img.style.transformOrigin = `${x}px ${y}px`;
    img.style.transform = 'scale(1.8)';
}

function offZoom(e) {
    img.style.transformOrigin = `center center`;
    img.style.transform = 'scale(1)';
}


</script>