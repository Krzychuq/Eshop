<?php
session_start();
$imie = $_POST["imie"];
$nazwisko = $_POST["nazwisko"];
$email = $_POST["email"];
$zamowienie = $_POST["zamowienie"];
$wiadomosc = $_POST["wiadomosc"];

if( !empty($imie) && !empty($nazwisko) && !empty($email) && !empty($zamowienie) && !empty($wiadomosc) ){
    include_once("laczenieZbaza.php");
    $wyslij_wiad = $conn -> prepare("INSERT INTO wiadomosci_klientow(imie,nazwisko,email,nr_zamowienia,wiadomosc) VALUES(?,?,?,?,?)");
    $wyslij_wiad -> execute([$imie, $nazwisko, $email, $zamowienie, $wiadomosc]);
    $_SESSION['success'] = "Wiadomość została wysłana";
}
else{$_SESSION['error'] = "Uzupełnij wszystkie pola";}


$conn = null;
header("location: kontakt.php");

?>