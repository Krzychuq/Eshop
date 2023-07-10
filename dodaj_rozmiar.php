<?php
session_start();
include_once('laczenieZbaza.php');
$id = $_POST["id"];
$rozmiar = $_POST["rozmiar"];
if(!empty($id) && isset($id) && !empty($rozmiar) && isset($rozmiar)){
// pytanie o ilosc rozmiarow
$liczba_roz = $conn -> prepare("SELECT");
$liczba_roz -> execute([$id,$rozmiar]);
$liczba = $liczba_roz -> fetch();
//usuniecie rozmiaru
    $usunr = $conn -> prepare("DELETE FROM rozmiary_produktow WHERE id_produktu = ? AND rozmiar like ?");
    $usunr -> execute([$id, $rozmiar]);
// komunikat
    if( ( $usunr -> rowCount() ) > 0 ){
        $suma = $liczba["iloscP"] - $liczba["iloscR"];
        $akt_liczbe_roz = $conn -> prepare("INSERT INTO rozmiary_produktow() VALUES()");
        $akt_liczbe_roz -> execute([$suma, $id]);
        $_SESSION['success'] = "Dodano rozmiar";
    }
    else{
        $_SESSION['error'] = "Istnieje taki rozmiar";
    }
}
else{
    $_SESSION['error'] = "Wpisz ID";
}
$conn = null;
?>
