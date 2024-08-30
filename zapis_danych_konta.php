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

// imie
if(!empty($_POST["imie"])){
    $imie = $_POST["imie"];
    $pyt_o_imie = $conn->prepare("UPDATE dane_konta SET imie = ? WHERE id_loginu = ?");
    $pyt_o_imie -> execute([$imie, $id]);
}

// nazwisko
if(!empty($_POST["nazwisko"])){
    $nazwisko = $_POST["nazwisko"];
    $pyt_nazwisko = $conn->prepare("UPDATE dane_konta SET nazwisko = ? WHERE id_loginu = ?");
    $pyt_nazwisko -> execute([$nazwisko, $id]);
}

// kod pocztowy
if(!empty($_POST["kod_pocztowy"])){
    $kod_pocztowy = $_POST["kod_pocztowy"];
    $pyt_kod_pocztowy = $conn->prepare("UPDATE dane_konta SET kod_pocztowy = ? WHERE id_loginu = ?");
    $pyt_kod_pocztowy -> execute([$kod_pocztowy, $id]);
}

// telefon
if(!empty($_POST["tel"])){
    $tel = $_POST["tel"];
    $pyt_o_tel = $conn->prepare("UPDATE dane_konta SET nr_tel = ? WHERE id_loginu = ?");
    $pyt_o_tel -> execute([$tel, $id]);
}

// nip
if(!empty($_POST["nip"])){
    $tel = $_POST["nip"];
    $pyt_o_tel = $conn->prepare("UPDATE dane_konta SET NIP = ? WHERE id_loginu = ?");
    $pyt_o_tel -> execute([$tel, $id]);
}

// ulica
if(!empty($_POST["ulica"])){
    $tel = $_POST["ulica"];
    $pyt_o_tel = $conn->prepare("UPDATE dane_konta SET ulica = ? WHERE id_loginu = ?");
    $pyt_o_tel -> execute([$tel, $id]);
}

// nr domu
if(!empty($_POST["nr_domu"])){
    $tel = $_POST["nr_domu"];
    $pyt_o_tel = $conn->prepare("UPDATE dane_konta SET nr_domu = ? WHERE id_loginu = ?");
    $pyt_o_tel -> execute([$tel, $id]);
}

// nr mieszkania
if(!empty($_POST["nr_mieszkania"])){
    $tel = $_POST["nr_mieszkania"];
    $pyt_o_tel = $conn->prepare("UPDATE dane_konta SET nr_mieszkania = ? WHERE id_loginu = ?");
    $pyt_o_tel -> execute([$tel, $id]);
}

// miasta
if(!empty($_POST["miasto"])){
    $miasto = $_POST["miasto"];
    $pyt_o_miasto = $conn->prepare("UPDATE dane_konta SET miasto = ? WHERE id_loginu = ?");
    $pyt_o_miasto -> execute([$miasto, $id]);
}

// kraj
if(!empty($_POST["kraj"])){
    $kraj = $_POST["kraj"];
    $pyt_o_kraj = $conn->prepare("UPDATE dane_konta SET kraj = ? WHERE id_loginu = ?");
    $pyt_o_kraj -> execute([$kraj, $id]);
}
$_SESSION['success'] = "Zapisano dane";
$conn = null;
header('location:konto.php');
?>