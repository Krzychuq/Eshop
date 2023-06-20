<?php
include_once('laczenieZbaza.php');
$id = $_POST["id"];
$usun = $conn -> prepare("DELETE FROM produkty WHERE id = ?");
$usun -> execute([$id]);
header("location: panel.php");
?>
