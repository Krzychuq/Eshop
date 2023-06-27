<?php
include_once('laczenieZbaza.php');
$id = $_POST["id"];
$usunp = $conn -> prepare("DELETE FROM produkty WHERE id = ?");
$usunp -> execute([$id]);
$usunr = $conn -> prepare("DELETE FROM rozmiary_produktow WHERE id_produktu = ?");
$usunr -> execute([$id]);
header("location: panel.php");
?>
