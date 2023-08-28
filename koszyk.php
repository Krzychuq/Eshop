<?php
session_start();
if(isset($_SESSION['email'])) {
  $czas_aktualny = time();
    if ($czas_aktualny > $_SESSION['expire']) {
        session_unset();
        session_destroy();
        header('location: index.php');
    }
}
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
  <div class='koszyk'>
    <div class="koszyk_naglowek" id="koszyk_naglowek1">
      <span>Koszyk</span>
    </div>
    <div class="koszyk_naglowek" id="koszyk_naglowek2">
      <span>Podsumowanie</span>
    </div>
<?php
// print_r($_SESSION['koszyk']);
$podsumowanie_kosztow = 0;
if(!empty($_SESSION['koszyk'])){
  echo "<div class='produkty_koszyk'>";
  for($liczba_produktow=0; $liczba_produktow < sizeof($_SESSION['koszyk']); $liczba_produktow++){
    $indeks = $_SESSION['koszyk'][$liczba_produktow][0];
    $rozmiar = $_SESSION['koszyk'][$liczba_produktow][1];
    $sztuk_zaznaczone = $_SESSION['koszyk'][$liczba_produktow][2];
    $limit = $_SESSION['koszyk'][$liczba_produktow][3];
    $pyt = $conn->prepare('SELECT id, nazwa, cena, zdjecie1, link FROM produkty WHERE indeks_produktu like ?');
      $pyt -> execute([$indeks]);
      $results = $pyt->fetchAll();
      foreach ($results as $linia){
        $id = $linia['id'];
        $nazwa = $linia['nazwa'];
        $cena = $linia['cena'];
        $zdjecie = $linia['zdjecie1'];
        $link = $linia['link'];
      }
      $pyt_rozmiar = $conn -> prepare('SELECT ilosc FROM rozmiary_produktow WHERE id_produktu = ? and rozmiar like ?');
      $pyt_rozmiar -> execute([$id, $rozmiar]);
      $rozmiar_z_bazy = $pyt_rozmiar->fetch(PDO::FETCH_ASSOC);
    echo "<div class='produkt_z_koszyka'>";
    
    echo "<div class='koszyk_zdjecie_produktu'>";
    echo "<a class='koszyk_link' href='$link'><img src='$zdjecie' width=180px height=autopx></a>";
    echo "</div>";
    $cena_produktu = $cena * $sztuk_zaznaczone;
    $podsumowanie_kosztow += $cena_produktu;
    echo "<div class='koszyk_informacje'>";
    echo "<a class='koszyk_link' href='$link'>".ucfirst($nazwa)."</a>";
    echo "<div style='height: 12px;'></div>";
    echo "<p class='koszyk_cena'>Cena: ". $cena_produktu ." PLN</p>";
    echo "<div style='height: 12px;'></div>";
    echo "<p>Rozmiar: $rozmiar</p>";
    echo "</div>";

    echo "<div class='koszyk_sztuki'>";
    echo "<p>Ilość</p>";
    echo "<form action='aktualizuj_ilosc.php' method=POST style='justify-content:center; width:100%;'>";
    echo "<input type=hidden value=".$indeks." name=indeks>";
    echo "<input type=hidden value=".$rozmiar." name=rozmiar>";
    echo "<select onchange='this.form.submit()' name='ilosc'>";
    
    for($i=0; $i <= $rozmiar_z_bazy['ilosc']; $i++){
    if($i == 0){ /* Pomija */ }
      elseif($i == $sztuk_zaznaczone){echo "<option value=$i selected>$i</option>";}
      else{echo "<option value=$i>$i</option>";}
    }
    echo "</select>";
    echo "</form>";
    echo "</div>";
    
    echo "<form action=usun_produkt_koszyk.php method=POST>";
    echo "<input type='hidden' name=indeks value=$indeks>";
    echo "<input type='hidden' name=rozmiar value=$rozmiar>";
    echo "<button type='submit'><img onmouseover='animacjaIN(this)' onmouseout='animacjaOUT(this)' onclick='animacjaCLICK(this)' width='32px' height:'32px' src='svg/kosz_zamkniety.svg'></button>";
    echo "</form>";
  
    echo "</div>";
  }
  echo "</div>";
}
else{
  echo "<h2 style='text-align:center;'>Twój koszyk jest pusty</h2>";
}

//powiadomienia
if(isset($_SESSION['error'])){
    echo "<div class='error'>" . "&#10005 ". $_SESSION["error"] . "</div>";
    unset($_SESSION['error']);
    echo "<script src='blad.js'></script>";
}
if(isset($_SESSION['success'])){
    echo "<div class='success'>" . "&#10003 ". $_SESSION["success"] . "</div>";
    unset($_SESSION['success']);
    echo "<script src='powiadomienie.js'></script>";
}
?>
<div class='koszyk_podsumowanie'>
  <form action="" method="POST">
    <label for="rabat"><s>Kod rabatowy</s></label>
    <input type="text" name='rabat' placeholder='!In progress!'>
    <br>
    <label for="kurier">Dostawa</label>
    <div class='lista_kurierow'>
      <div class="kurier_listy" >
        <img src="https://techcabal.com/wp-content/uploads/2015/08/dhl_logo876.jpg" alt="" width="40px" height="40px">
        <p>14 PLN</p>
        <input type="radio" name="kurier" id='kurier1' onclick='przelicz(this)' value="14">
      </div>
      <div class="kurier_listy" >
        <img src="https://www.orderhive.com/wp-content/uploads/2021/04/GLS-cover.svg" alt="" width="40px" height="40px">
        <p>12 PLN</p>
        <input  type="radio" name="kurier" id='kurier2' onclick='przelicz(this)' value="12">
      </div>
      <div class="kurier_listy" >
        <img src="https://avlab.pl/wp-content/uploads/2020/09/poczta-polska-logo.jpg" alt="" width="40px" height="40px">
        <p>11 PLN</p>
        <input type="radio" name="kurier" id='kurier3' onclick='przelicz(this)' value="11">
      </div>
    </div>
  <div>
    <?php 
    echo "<br><p>Koszt dostawy: <span id=koszt_dostawy>0</span> PLN</p>";
    echo  "<p>Łączny koszt: <span id='suma'>".$podsumowanie_kosztow."</span> PLN</p>";
    echo "<input type='hidden' id='koszt_calkowity' name='suma' value='". $podsumowanie_kosztow ."'>" ;
    ?>
    <div style="text-align: center;">
      <button class='button_kup'  type="submit" style="margin-top: 5%; width: 90%;">Przejdź dalej</button>
    </div>
  </div>
  </form>
</div>

</div>

</div>

<footer>
    <?php include_once("footer.html"); ?>
</footer>

</body>
</html>
<script>
  function animacjaIN(zrodlo){
    zrodlo.src = "svg/kosz_otwarty.svg";
  }

  function animacjaOUT(zrodlo){
    zrodlo.src = "svg/kosz_zamkniety.svg";
  }
  function animacjaCLICK(rozmiar){
    rozmiar.style.transition = "0.5s";
    rozmiar.style.transform = "scale(0.8)";
  }

  suma = document.getElementById('suma').innerHTML;
  suma = parseFloat(suma);

function przelicz(inp) {
  if(inp.checked){
    document.getElementById('koszt_dostawy').innerHTML = inp.value;
    suma_koncowa = suma + parseFloat(inp.value);
    document.getElementById('suma').innerHTML = suma_koncowa;
    document.getElementById('koszt_calkowity').value = suma_koncowa;
  }
}
</script>

<script src='loading.js'></script>
