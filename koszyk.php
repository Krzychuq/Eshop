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
    <link rel="stylesheet" href="s.css?v1.2">
    <title>Sesja</title>
</head>
<body>
<?php 
include_once("header.php");
include_once("laczenieZbaza.php");
?>

<div class="contener">
<?php
print_r($_SESSION['koszyk']);
if(!empty($_SESSION['koszyk'])){
foreach($_SESSION['koszyk'] as $kod => $rozmiar) {
  if(!empty($kod)){
    if(is_array($rozmiar)){
      foreach($rozmiar as $pojedyncze){
        $pyt = $conn->prepare('SELECT id, nazwa, cena, zdjecie1, link FROM produkty WHERE indeks_produktu like ?');
        $pyt -> execute([$kod]);
        $results = $pyt->fetchAll();
        foreach ($results as $linia){
          $id = $linia['id'];
          $nazwa = $linia['nazwa'];
          $cena = $linia['cena'];
          $zdjecie = $linia['zdjecie1'];
          $link = $linia['link'];
        }
        $pyt_rozmiar = $conn -> prepare('SELECT ilosc FROM rozmiary_produktow WHERE id_produktu = ? and rozmiar like ?');
        $pyt_rozmiar -> execute([$id, $pojedyncze]);
        $rozmiar = $pyt_rozmiar->fetch(PDO::FETCH_ASSOC);
        echo "<div class='produkt_z_koszyka'>";

        echo "<div>";
        echo "<img src='$zdjecie' width=200px height=200px>";
        echo "</div>";
        echo "<p>$nazwa</p>";
        echo "<p>$cena</p>";
        echo "<p>$pojedyncze</p>";
        echo "<select>";
        for($i=0; $i <= $rozmiar['ilosc'];){
          echo "<option value=$i>$i</option>";
          $i++;
        }
        echo "</select>";
        echo "</div>";
        
      }
    }
    else{
      $pyt = $conn->prepare('SELECT nazwa, cena, ilosc, zdjecie1, link FROM produkty WHERE indeks_produktu like ?');
      $pyt -> execute([$kod]);
      $results = $pyt->fetchAll();
      foreach ($results as $linia){
        $nazwa = $linia['nazwa'];
        $cena = $linia['cena'];
        $ilosc = $linia['ilosc'];
        $zdjecie1 = $linia['zdjecie1'];
        $link = $linia['link'];
      }

    } 
  
  }
}
}
else{
  echo "<h2>Pusty koszyk</h2>";
}
?>
</div>

<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>