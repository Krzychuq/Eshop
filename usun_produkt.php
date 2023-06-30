<?php
session_start();
include_once('laczenieZbaza.php');
$id = $_POST["id"];
$pyt= $conn->prepare("SELECT zdjecie, link FROM produkty WHERE id = ?");
$pyt -> execute([$id]);
$wyniki = $pyt -> fetch();
if($pyt->rowCount()){
    $usuniecie_zdjecia = unlink($wyniki["zdjecie"]);
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
