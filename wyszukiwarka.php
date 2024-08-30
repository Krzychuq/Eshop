<?php
include_once('laczenieZbaza.php');
//slowo do bazy
$slowo = "%". $_REQUEST["q"] . "%";
//pytanie o produkty
$szukaj1 = $conn->prepare('SELECT nazwa, cena, zdjecie, link, indeks_produktu FROM produkty WHERE nazwa like ? LIMIT 10');
$szukaj1 -> execute([$slowo]);
//slowo klucz
$q = $_REQUEST["q"];
//wynik
if($szukaj1-> rowCount() > 0) {
  $q = strtolower($q);
  while($wynik = $szukaj1->fetch()){
    $zdjecie = explode(",",$wynik["zdjecie"]);

    include("link_creator.php");

    echo "<div class='wyszukiwanie_produkt'><a style='text-decoration:none; color: #171717;' href=".$link.">
    <div><img src=zdjecia_produktow/".$zdjecie[0]." alt='produkt' class ='wyszukanie_prod_zdjecie'></div>
    <div class='wyszukanie_prod_info'>".$wynik['nazwa']."<p>".$wynik['cena']." PLN</p></div></a></div>";
  }
}
//brak wyniku
else{
  echo "<h3>Brak dopasowania...</h3>";
}
$conn = null;
?> 