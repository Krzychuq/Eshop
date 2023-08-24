<?php
session_start();
$indeks = $_POST['indeks'];
$rozmiar= $_POST['rozmiar'];
$ilosc= $_POST['ilosc'];


for($i=0; $i < sizeof($_SESSION['koszyk']); $i++){
    $powtorzenie = in_array($indeks, $_SESSION['koszyk'][$i]);
    $powtorzenie_r = in_array($rozmiar, $_SESSION['koszyk'][$i]);
    if($powtorzenie == 1 && $powtorzenie_r == 1){
        $tablica = $i;
    }
}
if($ilosc <= $_SESSION['koszyk'][$tablica][3]){
    if($_SESSION['koszyk'][$tablica][0] == $indeks && $_SESSION['koszyk'][$tablica][1] == $rozmiar && $_SESSION['koszyk'][$tablica][2] <= $_SESSION['koszyk'][$tablica][3]){
        $_SESSION['koszyk'][$tablica][2] = $ilosc;
    }
    else{
        echo "ERROR: zmiana ilosci";
    }
}
header("location: koszyk.php");
?>