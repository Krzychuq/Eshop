<?php
session_start();
include_once('laczenieZbaza.php');
$id = $_POST["id"];
$zdjecie_pyt= $conn->prepare("SELECT zdjecie FROM produkty WHERE id = ?");
$zdjecie_pyt -> execute([$id]);
$zdjecie_do_usuniecia = $zdjecie_pyt -> fetch();
if($zdjecie_do_usuniecia){
    $usuniecie_zdjecia = unlink($zdjecie_do_usuniecia[0]);
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
