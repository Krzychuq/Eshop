<?php
session_start();
include_once('laczenieZbaza.php');
$id = $_POST["id"];
$rozmiar = $_POST["rozmiar"];
if(!empty($id) && isset($id) && !empty($rozmiar) && isset($rozmiar)){
// pytanie o ilosc rozmiarow
$liczba_roz = $conn -> prepare("SELECT rozmiary_produktow.ilosc as 'iloscR', produkty.ilosc as 'iloscP' FROM rozmiary_produktow inner join produkty on rozmiary_produktow.id_produktu = produkty.id WHERE rozmiary_produktow.id_produktu = ? AND rozmiary_produktow.rozmiar like ?");
$liczba_roz -> execute([$id,$rozmiar]);
$liczba = $liczba_roz -> fetch();
//usuniecie rozmiaru
    $usunr = $conn -> prepare("DELETE FROM rozmiary_produktow WHERE id_produktu = ? AND rozmiar like ?");
    $usunr -> execute([$id, $rozmiar]);
// komunikat
    if( ( $usunr -> rowCount() ) > 0 ){
        $_SESSION['success'] = "Usunieto rozmiar";
        $suma = $liczba["iloscP"] - $liczba["iloscR"];
        $akt_liczbe_roz = $conn -> prepare("UPDATE produkty SET ilosc = ? WHERE id = ?");
        $akt_liczbe_roz -> execute([$suma, $id]);
    }
    else{
        $_SESSION['error'] = "Nie ma takiego ID lub rozmiaru";
    }
}
else{
    $_SESSION['error'] = "Wpisz ID";
}
$conn = null;
?>
