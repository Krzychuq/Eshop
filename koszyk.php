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
    <link rel="stylesheet" href="s.css?v1.3">
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
  for($i=0; $i < sizeof($_SESSION['koszyk']); $i++){
    $indeks = $_SESSION['koszyk'][$i][0];
    $rozmiar = $_SESSION['koszyk'][$i][1];
    $sztuk_zaznaczone = $_SESSION['koszyk'][$i][2];
    $limit = $_SESSION['koszyk'][$i][3];
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

    echo "<div>";
    echo "<img src='$zdjecie' width=200px height=200px>";
    echo "</div>";
    echo "<p>$nazwa</p>";
    echo "<p>$cena</p>";
    echo "<p>$rozmiar</p>";
    echo "<p>$sztuk_zaznaczone</p>";
    echo "<select>";
    
    for($i=0; $i <= $rozmiar_z_bazy['ilosc'];){
      echo "<option value=$i>$i</option>";
      $i++;
    }
    echo "</select>";
    echo "</div>";
  }
}
else{
  echo "<h2>Pusty koszyk</h2>";
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

<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>