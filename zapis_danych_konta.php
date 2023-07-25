<?php
session_start();
//połączenie
include_once("laczenieZbaza.php");

//identyfikacja
$mail = $_SESSION['email'];
$pyt_o_id = $conn->prepare("SELECT id FROM loginy WHERE login like ?");
$pyt_o_id -> execute([$mail]);
$wykonanie = $pyt_o_id->fetch(PDO::FETCH_ASSOC);
$id = $wykonanie['id'];

//Zapis danych
if(!empty($_POST["imie"])){
    $imie = $_POST["imie"];
    $pyt_o_imie = $conn->prepare("UPDATE dane_konta SET imie = ? WHERE id_loginu = ?");
    $pyt_o_imie -> execute([$imie, $id]);
}

if(!empty($_POST["nazwisko"])){
    $nazwisko = $_POST["nazwisko"];
    $pyt_nazwisko = $conn->prepare("UPDATE dane_konta SET nazwisko = ? WHERE id_loginu = ?");
    $pyt_nazwisko -> execute([$nazwisko, $id]);
}
if(!empty($_POST["kod_pocztowy"])){
    $kod_pocztowy = $_POST["kod_pocztowy"];
    $pyt_kod_pocztowy = $conn->prepare("UPDATE dane_konta SET kod_pocztowy = ? WHERE id_loginu = ?");
    $pyt_kod_pocztowy -> execute([$kod_pocztowy, $id]);
}

if(!empty($_POST["tel"])){
    $tel = $_POST["tel"];
    $pyt_o_tel = $conn->prepare("UPDATE dane_konta SET nr_tel = ? WHERE id_loginu = ?");
    $pyt_o_tel -> execute([$tel, $id]);
}

if(!empty($_POST["miasto"])){
    $miasto = $_POST["miasto"];
    $pyt_o_miasto = $conn->prepare("UPDATE dane_konta SET miasto = ? WHERE id_loginu = ?");
    $pyt_o_miasto -> execute([$miasto, $id]);
}

if(!empty($_POST["kraj"])){
    $kraj = $_POST["kraj"];
    $pyt_o_kraj = $conn->prepare("UPDATE dane_konta SET kraj = ? WHERE id_loginu = ?");
    $pyt_o_kraj -> execute([$kraj, $id]);
}
$_SESSION['success'] = "Zapisano dane";
$conn = null;
header('location:konto.php');
?>