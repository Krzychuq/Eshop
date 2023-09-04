<?php
session_start();
?>
<!DOCTYPE html>
<html lang='pl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="../flickity.min.js"></script>
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
$pyt_prod= $conn -> prepare('SELECT nazwa,cena,ilosc,opis,zdjecie1,zdjecie2,zdjecie3,zdjecie4 FROM produkty WHERE indeks_produktu like ?');
$indeks_produktu = end($indeks3);
$pyt_prod->execute([$indeks_produktu]);
$dane = $pyt_prod->fetch();
$pyt_rozmiar= $conn -> prepare('SELECT rozmiary_produktow.rozmiar, rozmiary_produktow.ilosc FROM rozmiary_produktow inner join produkty on rozmiary_produktow.id_produktu = produkty.id WHERE produkty.indeks_produktu like ? ORDER BY RIGHT (rozmiary_produktow.rozmiar,1) desc');
$pyt_rozmiar->execute([$indeks_produktu]);
$zdjecie_prod1 = "../". $dane["zdjecie1"];
$zdjecie_prod2 = "../". $dane["zdjecie2"];
$zdjecie_prod3 = "../". $dane["zdjecie3"];
$zdjecie_prod4 = "../". $dane["zdjecie4"];
$nazwa_prod = str_replace('-', ' ', $dane["nazwa"]);
?>

<div class='contener'>

<div class='grid_produkt'>
    <div id='div2'>
        <!-- zdjecia do wyboru produktu -->
            <?php if($dane["zdjecie1"] != NULL){echo "<img class='pick_pic' src=$zdjecie_prod1 id=prod1 style='width:auto; height:auto; max-width: 100px;' alt=zdjecie/produktu>";} ?>
            <?php if($dane["zdjecie2"] != NULL){echo "<img class='pick_pic' src=$zdjecie_prod2 id=prod2 style='width:auto; height:auto; max-width: 100px;' alt=zdjecie/produktu>";} ?>
            <?php if($dane["zdjecie3"] != NULL){echo "<img class='pick_pic' src=$zdjecie_prod3 id=prod3 style='width:auto; height:auto; max-width: 100px;' alt=zdjecie/produktu>";} ?>
            <?php if($dane["zdjecie4"] != NULL){echo "<img class='pick_pic' src=$zdjecie_prod4 id=prod4 style='width:auto; height:auto; max-width: 100px;' alt=zdjecie/produktu>";} ?>
    </div>
    
    <div id='div1'>
    <!-- zdjecie głowne produktu -->
        <?php echo "<img src=$zdjecie_prod1 id=prod width=400px height=auto alt=zdjecie/produktu>"; ?>
    </div>

    <div id="div3">
    <!-- info -->
        <?php
        echo "<form action='' method=POST>";
        echo "<input id='ilosc_rozmiaru' name=ilosc_rozmiaru value=' ' type=hidden>";
        echo "<input name=indeks value=$indeks_produktu type=hidden>";
        echo "<p id=nazwa>".ucfirst($nazwa_prod)."</p>";
        echo "<p name=cena id=cena>".$dane["cena"]. " zł</p>";
        echo "<p name=ilosc id=ilosc>Dostepna ilość: ".$dane["ilosc"]."</p>";
        echo "<span>Rozmiary</span> "."<select id=rozmiar name=rozmiar >";
        echo "<option value=''>Wybierz</option>";
        while ($rozmiar = $pyt_rozmiar->fetch()) {
            echo "<option value=".$rozmiar["rozmiar"].">".$rozmiar["rozmiar"]. " |". $rozmiar["ilosc"] . "|".'</option>';
        }

        echo "</select>";
        echo "<button  class='button_kup' name='btnsubmit' type=submit onclick='add_to_cart()' id='btnsubmit' disabled>Kup teraz</button></form>";
        ?>
    </div>

    <div id="div4">
    <!-- opis -->
        <?php
        echo "<h2>Opis produktu</h2><br>";
        echo "<p style=padding:1%; font-family:Segoe UI;>".$dane["opis"]."</p>";
        ?>
    </div>
</div>

<?php include_once('../podobne_produkty.php');?>

</div>
<footer>
    <?php include_once('../footer_produkty.html'); $conn = null;?>
</footer>
</body>
</html>
<script>
const container = document.getElementById('div1');
const img = document.getElementById('prod');

container.addEventListener('mousemove', onZoom);
container.addEventListener('mouseover', onZoom);
container.addEventListener('mouseleave', offZoom);

$(".pick_pic").click(function(){
    zdjecie = document.getElementById(this.id);
    const zrodlo = zdjecie.getAttribute("src");
    var glowne_zdjecie = document.getElementById("prod");
    const zmiana_zdjecia = $(glowne_zdjecie).attr('src', zrodlo);
    
});
function onZoom(e) {
    const x = e.clientX - e.target.offsetLeft;
    const y = e.clientY - e.target.offsetTop;

    img.style.transformOrigin = `${x}px ${y}px`;
    img.style.transform = 'scale(1.5)';
}

function offZoom(e) {
    img.style.transformOrigin = `center center`;
    img.style.transform = 'scale(1)';
}



$('#rozmiar').click(function(){
    $('#rozmiar option').each(function() {
    if($(this).is(':selected')){
        if($(this).val()){
            $('#btnsubmit').prop("disabled", false);
            tekst = $(this).text();
            przerobka = tekst.split("|");
            $('#ilosc_rozmiaru').val(przerobka[1]);
        }
        else{
            $('#btnsubmit').prop("disabled",true);
        }
    }
});
});


</script>
<?php include_once('../dodaj_do_koszyka.php');?>