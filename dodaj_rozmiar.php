<?php
session_start();
if(empty($_POST["id"])){
    $_SESSION['error'] = "Wpisz ID";
}
elseif(empty($_POST["rozmiar"])){
    $_SESSION['error'] = "Wpisz rozmiar";
}
elseif(!empty($_POST["id"])){
    $id = $_POST["id"];
    $rozmiar = $_POST["rozmiar"];
    include_once("laczenieZbaza.php");
    $pyt_dodaj_rozmiar = $conn -> prepare("INSERT INTO rozmiary_produktow (id_produktu,rozmiar) VALUES(?,?)");
    $pyt_dodaj_rozmiar -> execute([$id,$rozmiar]);
}
$conn = null;
header("location: panel.php");
?>