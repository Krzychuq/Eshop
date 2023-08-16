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
// print_r($_SESSION['koszyk']);
if(!empty($_SESSION['koszyk'])){
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
    echo "<a class='koszyk_link' href='$link'><img src='$zdjecie' width=200px height=200px></a>";
    echo "</div>";

    echo "<div class='koszyk_informacje'>";
    echo "<a class='koszyk_link' href='$link'>".ucfirst($nazwa)."</a>";
    echo "<div style='height: 12px;'></div>";
    echo "<p>Cena: $cena</p>";
    echo "<div style='height: 12px;'></div>";
    echo "<p>Rozmiar: $rozmiar</p>";
    echo "</div>";

    echo "<div class='koszyk_sztuki'>";
    echo "<p>Ilość</p>";
    echo "<select>";
    
    for($i=0; $i <= $rozmiar_z_bazy['ilosc']; $i++){
      if($i == 0){}
      elseif($i == $sztuk_zaznaczone){echo "<option value=$i selected>$i</option>";}
      else{echo "<option value=$i>$i</option>";}
    }
    echo "</select>";
    echo "</div>";
    
    echo "<form action=usun_produkt_koszyk.php method=POST>";
    echo "<input type='hidden' name=indeks value=$indeks>";
    echo "<input type='hidden' name=rozmiar value=$rozmiar>";
    echo "<button type='submit'><img onmouseover='animacjaIN(this)' onmouseout='animacjaOUT(this)' onclick='animacjaCLICK(this)' width='32px' height:'32px' src='svg/kosz_zamkniety.svg'></button>";
    echo "</form>";
  
    echo "</div>";
  }
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
</div>
<div>
  
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
</script>

<script src='loading.js'></script>
