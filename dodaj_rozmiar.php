<?php
session_start();
include_once('laczenieZbaza.php');
$id = $_POST["id"];
$rozmiar = $_POST["rozmiar"];
$ilosc = $_POST["ilosc"];
if(!empty($id) && isset($id) && !empty($rozmiar) && isset($rozmiar)){
    $sprawdz_rozmiar = $conn -> prepare("SELECT id FROM rozmiary_produktow WHERE id_produktu = ? AND rozmiar like ?");
    $sprawdz_rozmiar -> execute([$id, $rozmiar]);
    $sprawdz = $sprawdz_rozmiar -> fetch();
    if(!$sprawdz){
    $dodaj_rozmiar = $conn -> prepare("INSERT INTO rozmiary_produktow(id_produktu,rozmiar,ilosc) VALUES(?,?,?)");
    $dodaj_rozmiar -> execute([$id,$rozmiar,$ilosc]);
    // pytanie o ilosc rozmiarow
    $liczba_roz = $conn -> prepare("SELECT rozmiary_produktow.ilosc as 'iloscR', produkty.ilosc as 'iloscP' FROM rozmiary_produktow inner join produkty on rozmiary_produktow.id_produktu = produkty.id WHERE rozmiary_produktow.id_produktu = ? AND rozmiary_produktow.rozmiar like ?");
    $liczba_roz -> execute([$id,$rozmiar]);
    $liczba = $liczba_roz -> fetch();
    $suma = $liczba["iloscP"] + $liczba["iloscR"];
    $akt_liczbe_roz = $conn -> prepare("UPDATE produkty SET ilosc = ? WHERE id = ?");
    $akt_liczbe_roz -> execute([$suma, $id]);
    $_SESSION['success'] = "Dodano rozmiar";
    }
    else{$_SESSION['error'] = "Taki rozmiar już istnieje";}
}

else{
    $_SESSION['error'] = "Wpisz ID";
}
$conn = null;
header("location: panel.php");
?>
