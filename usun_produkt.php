<?php
session_start();
include_once('laczenieZbaza.php');
$id = $_POST["id"];
$pyt= $conn->prepare("SELECT zdjecie1, zdjecie2, zdjecie3, zdjecie4, link FROM produkty WHERE id = ?");
$pyt -> execute([$id]);
$wyniki = $pyt -> fetch();
if($wyniki){
    $usuniecie_zdjecia1 = unlink($wyniki["zdjecie1"]);
    $usuniecie_zdjecia2 = unlink($wyniki["zdjecie2"]);
    $usuniecie_zdjecia3 = unlink($wyniki["zdjecie3"]);
    $usuniecie_zdjecia4 = unlink($wyniki["zdjecie4"]);
    $n1 = explode("http://localhost/forum/", $wyniki["link"]);
    $plik_usun = unlink($n1[1]);
    $usunr = $conn -> prepare("DELETE FROM rozmiary_produktow WHERE id_produktu = ?");
    $usunr -> execute([$id]);
    $usunp = $conn -> prepare("DELETE FROM produkty WHERE id = ?");
    $usunp -> execute([$id]);
}
else{
    $_SESSION['error'] = "Nie ma takiego ID";
}
$conn = null;
header("location: panel.php");
?>
