<?php
session_start();
$indeks = $_POST['indeks'];
$rozmiar = $_POST['rozmiar'];
$_SESSION['indeks_produktu'] = $indeks;
$_SESSION['rozmiar_produktu'] = $rozmiar;
$indeks = $_SESSION['indeks_produktu'];
$rozmiar = $_SESSION['rozmiar_produktu'];
if(empty($_SESSION['koszyk'])){
    $koszyk[$indeks] = $rozmiar; 
    $_SESSION['koszyk'] = $koszyk;
}
else{
    $push_array = array($indeks => $rozmiar);
    $laczenie_array = array_merge_recursive($_SESSION['koszyk'], $push_array);
    $_SESSION['koszyk'] = $laczenie_array;
}
?>
