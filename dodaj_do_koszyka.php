<?php
session_start();
$indeks = $_POST['indeks'];
$rozmiar = $_POST['rozmiar'];
$_SESSION['indeks_produktu'] = $indeks;
$_SESSION['rozmiar_produktu'] = $rozmiar;
$indeks = $_SESSION['indeks_produktu'];
$rozmiar = $_SESSION['rozmiar_produktu'];
print_r($_COOKIE);

array_push($koszyk_dec, $indeks, $rozmiar );
$koszyk_dec = json_decode(, true);
// print_r(json_decode($_COOKIE['koszyk'], true));
?>
