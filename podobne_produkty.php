
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
        echo "<img src=$link>";
        echo "<p style='font-size: 1.2rem;'>$nazwa</p>";
        echo "<p style='font-size: 0.9rem; font-weight:bold;'>$linia[cena] PLN</p>";
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
if( dlugosc < 1890){
  if(liczba <= -930){
    liczba = 0;
    przesuniecie = liczba + "px";
    document.getElementsByClassName("list_prod")[0].style.left = przesuniecie;
  }
  else{
    liczba -= 310;
    przesuniecie = liczba + "px";
    document.getElementsByClassName("list_prod")[0].style.left = przesuniecie;
  }
}

}
function pozycjaminus(){
  if(liczba != 0){
    liczba += 310;
    przesuniecie = liczba + "px";
    document.getElementsByClassName("list_prod")[0].style.left = przesuniecie;
  }
}
</script>