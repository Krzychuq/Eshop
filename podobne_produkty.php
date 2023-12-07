
<?php
echo "<div class='podobne_produkty'>";
echo "<p id='tytul_polecane'>Polecane</p>";
    $podobne_produkty = $conn -> query('SELECT nazwa, cena, zdjecie1,link FROM produkty LIMIT 6');
echo "<ul class='list_prod' style='left: 0; transition: 0.7s;'>";
    while($linia = $podobne_produkty->fetch()){
        $nazwa = ucfirst($linia["nazwa"]);
        $link = "../" . $linia["zdjecie1"];
        echo "<li>";
        echo "<a style='color: black; text-decoration:none;' href='$linia[link]'>";
        echo "<img src=$link class='podobny_produkt_zdjecie' alt='podobny produkt'>";
        echo "<p style='font-size: 1.2rem;'>$nazwa</p>";
        echo "<p style='font-size: 0.9rem; font-weight:bold;'>$linia[cena] zł</p>";
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