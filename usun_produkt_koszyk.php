<?php
session_start();
$indeks = $_POST['indeks'];
$rozmiar = $_POST['rozmiar'];
  for($i=0; $i < sizeof($_SESSION['koszyk']); $i++){
    $powtorzenie = in_array($indeks, $_SESSION['koszyk'][$i]);
    $powtorzenie_r = in_array($rozmiar, $_SESSION['koszyk'][$i]);
    if($powtorzenie == $powtorzenie_r){
        $tablica = $i;
        break;
    }
  }
  if($_SESSION['koszyk'][$tablica][0] == $indeks && $_SESSION['koszyk'][$tablica][1] == $rozmiar){
    unset($_SESSION['koszyk'][$tablica]);
    $nowe = array_values($_SESSION['koszyk']);
    $_SESSION['koszyk'] = $nowe;
    header("location: koszyk.php");
  }
  else{
    header("location: koszyk.php");
  }

?>