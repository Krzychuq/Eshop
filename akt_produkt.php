<?php
include_once('laczenieZbaza.php');
$id = $_POST["id"];
$nazwa = $_POST["nazwa"];
$cena = $_POST["cena"];
$ilosc = $_POST["ilosc"];
$rodzaj = $_POST["rodzaj"];
$rozmiar = $_POST["rozmiar"];
$opis = $_POST["opis"];
$nazwa_zdjecia = $_FILES["zdjecie"]["name"];
$zdjecietemp = $_FILES["zdjecie"]["tmp_name"];
$rozszerzenie_zdjecia = mime_content_type($zdjecietemp);
//sprawdzanie formatu
if($rozszerzenie_zdjecia == "image/png" || $rozszerzenie_zdjecia == "image/jpg" || $rozszerzenie_zdjecia == "image/jpeg"){
    $sciezka = "zdjecia_produktow/";
    $sciezka_do_bazy = $sciezka . $nazwa_zdjecia;
    $dodanie_produktu = $conn->prepare('UPDATE produkty SET nazwa = ?,cena = ?,ilosc = ?,rodzaj = ?,rozmiar = ?,opis = ?,zdjecie = ? WHERE id = ?');
    $dodanie_produktu -> execute([$nazwa, $cena, $ilosc, $rodzaj, $rozmiar, $opis, $sciezka_do_bazy, $id]);
    if(is_uploaded_file($zdjecietemp)){
        move_uploaded_file($zdjecietemp, $sciezka . $nazwa_zdjecia);
    }
    header("location: panel.php");
}   
else{
    $_SESSION['error']= "Zdjęcie może być tylko w formacie jpg, jpeg, png !";
    header("location: panel.php");
}

$conn = null;
//  $pyt_zdjecie_z_bazy = $conn->prepare("SELECT avatar FROM dane_konta WHERE id_loginu = ?");
// $pyt_zdjecie_z_bazy -> execute([$id]);

// if($pyt_zdjecie_z_bazy){
//     $wykonanie = $pyt_zdjecie_z_bazy->fetch(PDO::FETCH_ASSOC);
//     $stare_zdjecie = $wykonanie['avatar'];
// }

// $zdjecie_do_usuniecia = $stare_zdjecie;

// //usuniecie starego zdjecia
// if(file_exists($zdjecie_do_usuniecia)) {
//     unlink($zdjecie_do_usuniecia);
// } 
?>