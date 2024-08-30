
<?php
include('laczenieZbaza.php');
echo "<div class='podobne_produkty'>";
echo "<p id='tytul_polecane'>Polecane</p>";
// losowanie produktów
$pytanie_pierwszy_id = $conn -> query('SELECT MAX(id) FROM produkty');
$pytanie_ostatni_id = $conn -> query('SELECT MIN(id) FROM produkty');
$max_array = $pytanie_pierwszy_id->fetch();
$min_array = $pytanie_ostatni_id->fetch();
$lista_uzytych_numerow=[''];
$lista_do_bazy = '';
// tylko 6
for($i=0; $i < 6; $i++){ 
  $los = rand($min_array[0], $max_array[0]);
  array_push($lista_uzytych_numerow, $los);
  if(in_array($los, $lista_uzytych_numerow, false)){
    if($i==0){ $lista_do_bazy .= $los; }
    else{ $lista_do_bazy .= "," . $los; }
  }
}
$podobne_produkty = $conn -> query("SELECT id,nazwa, cena, zdjecie, indeks_produktu FROM produkty WHERE id IN ($lista_do_bazy);");
echo "<ul class='list_prod' style='left: 0; transition: 0.7s;'>";
while($wynik = $podobne_produkty->fetch()){
    $nazwa = ucfirst($wynik["nazwa"]);
    $zdjecia_array = explode(",", $wynik["zdjecie"]);
    $linkZdj = "../zdjecia_produktow/" . $zdjecia_array[0];
    include("link_creator.php");

    echo "<li>";
    echo "<a style='color: black; text-decoration:none;' href='$link'>";
    echo "<img src=$linkZdj class='podobny_produkt_zdjecie' alt='podobny produkt'>";
    echo "<p style='font-size: 1.2rem;'>$nazwa</p>";
    echo "<p style='font-size: 0.9rem; font-weight:bold;'>$wynik[cena] zł</p>";
    echo "</a>";
    echo "</li>";
}
echo "</ul>";
echo "<button class='button_prev' onclick=pozycjaminus()>". "<img src='../svg/arrow-left.svg' width='42px' height='42px'>" ."</button>";
echo "<button class='button_next' onclick=pozycjaplus()>". "<img src='../svg/arrow-right.svg' width='42px' height='42px'>" ."</button>";
echo "</div>";
?>


<script>
let liczba = 0;

function pozycjaplus(){
dlugosc = document.getElementsByClassName("list_prod")[0].offsetWidth;
szerokosc_zdjecia = document.getElementsByClassName("podobny_produkt_zdjecie")[0].width;
ekran = window.screen.width;
zdjecia_maks = szerokosc_zdjecia*6+6*10;
pozostale_elementy_dlugosc = zdjecia_maks-dlugosc;
if(dlugosc < ekran){
  if(liczba <= -pozostale_elementy_dlugosc){
    liczba = 0;
    przesuniecie = liczba + "px";
    document.getElementsByClassName("list_prod")[0].style.left = przesuniecie;
  }
  else{
    liczba -= pozostale_elementy_dlugosc;
    przesuniecie = liczba + "px";
    document.getElementsByClassName("list_prod")[0].style.left = przesuniecie;
  }
}
// debug alert('Długosć: '+dlugosc+ ' Zdjecia dlugosc: '+ zdjecia_maks + ' Ekran: '+ ekran + ' Liczba: '+liczba);
}

function pozycjaminus(){
  if(liczba != 0){
    liczba += pozostale_elementy_dlugosc;
    przesuniecie = liczba + "px";
    document.getElementsByClassName("list_prod")[0].style.left = przesuniecie;
  }
}
</script>