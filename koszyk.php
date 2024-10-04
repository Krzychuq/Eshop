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

<?php
// debbug
// print_r($_SESSION['koszyk']);
//

$podsumowanie_kosztow = 0;
if(!empty($_SESSION['koszyk'])){
  echo "<div class='order'>
  <div class='order_naglowek' id='koszyk_naglowek1'>
    <span>Koszyk</span>
  </div>";
  echo "<div class='left_order'>";
  for($liczba_produktow=0; $liczba_produktow < sizeof($_SESSION['koszyk']); $liczba_produktow++){
    $indeks = $_SESSION['koszyk'][$liczba_produktow][0];
    $rozmiar = $_SESSION['koszyk'][$liczba_produktow][1];
    $sztuk_zaznaczone = $_SESSION['koszyk'][$liczba_produktow][2];
    $limit = $_SESSION['koszyk'][$liczba_produktow][3];
    $pyt = $conn->prepare('SELECT id, nazwa, cena, zdjecie, indeks_produktu FROM produkty WHERE indeks_produktu like ?');
      $pyt -> execute([$indeks]);
      $results = $pyt->fetchAll();
      foreach ($results as $wynik){
        $id = $wynik['id'];
        $nazwa = $wynik['nazwa'];
        $cena = $wynik['cena'];
        $zdjecie = explode(",",$wynik["zdjecie"]);
        include("link_creator.php");
      }
      $pyt_rozmiar = $conn -> prepare('SELECT ilosc FROM rozmiary_produktow WHERE id_produktu = ? and rozmiar like ?');
      $pyt_rozmiar -> execute([$id, $rozmiar]);
      $rozmiar_z_bazy = $pyt_rozmiar->fetch(PDO::FETCH_ASSOC);
    echo "<div class='left_item_order'>";
    
    echo "<div class='koszyk_zdjecie_produktu'>";
    echo "<a class='koszyk_link' href='$link'><img src='zdjecia_produktow/$zdjecie[0]' width=180px height=autopx></a>";
    echo "</div>";
    $cena_produktu = $cena * $sztuk_zaznaczone;
    $podsumowanie_kosztow += $cena_produktu;
    echo "<div class='koszyk_informacje'>";
    echo "<a class='koszyk_link' href='$link'>".ucfirst($nazwa)."</a>";
    echo "<div style='height: 12px;'></div>";
    echo "<p class='koszyk_cena'>Cena: ". $cena_produktu ." zł</p>";
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
    // /////////////////////| hidden |\\\\\\\\\\\\\\\\\\\
    
    echo "<input type='hidden' name='indeks' value=$indeks>";
    echo "<input type='hidden' name='rozmiar' value=$rozmiar>";
        
    // ///////////////////////////////////////////////////
    echo "<button type='submit'><img onmouseover='animacjaIN(this)' onmouseout='animacjaOUT(this)' onclick='animacjaCLICK(this)' width='32px' height:'32px' src='svg/kosz_zamkniety.svg'></button>";

    echo "</form>";
    echo "</div>";
  }
  echo "</div>";
  //elementy koszyku
  $pyt_firmy = $conn -> prepare('SELECT * FROM firmy_kurierskie');
  $pyt_firmy -> execute();
  // !null
  $conn = null;

  echo "<div class='right_order'>
    <form action='zamowienie_klient.php' method='POST'>
    <label for='rabat'>Kod rabatowy</label>
    <input type='text' name='rabat' placeholder='Wpisz kod twardzielu'>
    <br>
    <label for='kurier'>Dostawa</label>
    <div class='lista_kurierow'>";
    foreach($pyt_firmy as $wynik){
      echo "<div class='kurier_listy'>";
      if( $wynik['rodzaj']=="paczkomat" ){ echo " <img src='svg/package.svg' width='28px' height='28px'> "; }
      else{ echo " <img src='svg/shipping-van.svg' width='30px' height='30px'> "; }
      echo "<span>". ucfirst($wynik['rodzaj']) ." ".$wynik['nazwa_firmy']." ".$wynik['cena']." zł</span>
      <input  type='radio' name='kurier' onclick='przelicz(this)' value='".$wynik['cena']."/".$wynik['id']."'>
      </div>";
    }
  echo
  "</div>
    <div>
      <br><p>Koszt dostawy: <span id=koszt_dostawy>0</span> zł</p>
    <p>Łączny koszt: <span id='suma'>$podsumowanie_kosztow</span> zł</p>
      <input type='hidden' id='koszt_calkowity' name='suma' value='$podsumowanie_kosztow'>
      <div class='kup' style='text-align: center;'>
        <button class='button_podsumowanie' type='submit' disabled>Przejdź dalej</button>
      </div>
    </div>";

   echo "</form>";
  echo "</div>";
}
else{
  echo "<div class='wiadomosc_koszyk_pusty'>";
  echo "<h2>Twój koszyk jest pusty</h2><br>";
  echo "<a href='index.php'><h3>> Zapełnij go <</h3></a>";
  echo "</div>";
}
?>
<!-- \\\\\\\\\\\\\\\\\\\\\\| Powiadomienia |///////////////////// -->

<?php include_once("powiadomienia.php"); ?>


<!-- \\\\\\\\\\\\\\\\\\\\\\| /Powiadomienia |///////////////////// -->
 
</div>

</div>

<footer>
    <?php include_once("footer.html"); ?>
</footer>

</body>
</html>
<script>
  function powieksz(){
    document.getElementsByClassName('button_podsumowanie')[0].style.transform = 'scale(1.1)';
  }
  function normal(){
    document.getElementsByClassName('button_podsumowanie')[0].style.transform = 'scale(1)';
  }
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
    v = inp.value
    cena = v.split("/");
    document.getElementById('koszt_dostawy').innerHTML = cena[0];
    suma_koncowa = suma + parseFloat(inp.value);
    suma_koncowa = Math.round(suma_koncowa * 100) / 100;
    document.getElementById('suma').innerHTML = suma_koncowa;
    document.getElementById('koszt_calkowity').value = suma_koncowa;
    document.getElementsByClassName('button_podsumowanie')[0].style.background = '#fbc936';
    document.getElementsByClassName('button_podsumowanie')[0].style.color = '#161616';
    document.getElementsByClassName('button_podsumowanie')[0].style.boxShadow = '3px 3px 1px #00000083';
    document.getElementsByClassName('button_podsumowanie')[0].setAttribute('onmouseover', 'powieksz()');
    document.getElementsByClassName('button_podsumowanie')[0].setAttribute('onmouseout', 'normal()');
    document.getElementsByClassName('button_podsumowanie')[0].removeAttribute('disabled');
  }
}
</script>

<script src='loading.js'></script>
