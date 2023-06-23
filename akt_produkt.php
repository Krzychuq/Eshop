<?php
session_start();
include_once('laczenieZbaza.php');
$id = $_POST["id"];
if(!empty($id) && isset($id)){
if(!empty($_POST["nazwa"]) && isset($_POST["nazwa"])){
    $nazwa = $_POST["nazwa"];
    $nowa_nazwa = strtolower($nazwa);
    $zmiana1 = str_replace("ą", "a", $nowa_nazwa);
    $zmiana2 = str_replace("ć", "c", $zmiana1);
    $zmiana3 = str_replace("ę", "e", $zmiana2);
    $zmiana4 = str_replace("ł", "l", $zmiana3);
    $zmiana5 = str_replace("ń", "n", $zmiana4);
    $zmiana6 = str_replace("ó", "o", $zmiana5);
    $zmiana7 = str_replace("ś", "s", $zmiana6);
    $zmiana8 = str_replace("ż", "z", $zmiana7);
    $zmiana9 = str_replace("ź", "z", $zmiana8);
    $str = str_replace(" ", "-", $zmiana9);
    $litera = strtolower(chr(rand(65,91)));
    $generuj_indeks = rand(0,999999) . $litera;
    $strona = $str . "-" .$generuj_indeks. ".php";
    $link = "http://localhost/forum/produkty/". $strona;
    $dodanie_produktu = $conn->prepare('UPDATE produkty SET nazwa = ?,indeks_produktu = ?, link = ? WHERE id = ?');
    $dodanie_produktu -> execute([$nazwa, $generuj_indeks, $link, $id]);
}

if(!empty($_POST["cena"]) && isset($_POST["cena"])){
    $cena = $_POST["cena"];
    $dodanie_produktu = $conn->prepare('UPDATE produkty SET cena = ? WHERE id = ?');
    $dodanie_produktu -> execute([$cena, $id]);
}


if(!empty($_POST["ilosc"]) && isset($_POST["ilosc"])){
    $ilosc = $_POST["ilosc"];
    $dodanie_produktu = $conn->prepare('UPDATE produkty SET ilosc = ? WHERE id = ?');
    $dodanie_produktu -> execute([$ilosc,$id]);
}

if(!empty($_POST["rodzaj"]) && isset($_POST["rodzaj"])){
    $rodzaj = $_POST["rodzaj"];
    $dodanie_produktu = $conn->prepare('UPDATE produkty SET rodzaj = ? WHERE id = ?');
    $dodanie_produktu -> execute([$rodzaj, $id]);
}

if(!empty($_POST["rozmiar"]) && isset($_POST["rozmiar"])){
    $rozmiar = $_POST["rozmiar"];
    $dodanie_produktu = $conn->prepare('UPDATE produkty SET rozmiar = ? WHERE id = ?');
    $dodanie_produktu -> execute([$rozmiar,$id]);
}

if(!empty($_POST["opis"]) && isset($_POST["opis"])){
    $opis = $_POST["opis"];
    $dodanie_produktu = $conn->prepare('UPDATE produkty SET opis = ? WHERE id = ?');
    $dodanie_produktu -> execute([$opis,$id]);
}

if(!empty($_FILES['zdjecie']['name']) && isset($_FILES['zdjecie']['name'])){
$nazwa_zdjecia = $_FILES["zdjecie"]["name"];
$zdjecietemp = $_FILES["zdjecie"]["tmp_name"];
$rozszerzenie_zdjecia = mime_content_type($zdjecietemp);
//sprawdzanie formatu
if($rozszerzenie_zdjecia == "image/png" || $rozszerzenie_zdjecia == "image/jpg" || $rozszerzenie_zdjecia == "image/jpeg" || $rozszerzenie_zdjecia == "image/webp"){
    if(is_uploaded_file($zdjecietemp)) {

        //nowa nazwa z datą
        $zdjecie_bez_roz = explode(".",$nazwa_zdjecia);
        $nowa_nazwa_zdjecia = date("Y-m-d-H-i-s") . '.' . $zdjecie_bez_roz[1];
        $sciezka = "zdjecia_produktow/";
        $sciezka_do_bazy = $sciezka . $nowa_nazwa_zdjecia;

        //stare zdjecie
        $pyt_zdjecie_z_bazy = $conn->prepare("SELECT zdjecie FROM produkty WHERE id = ?");
        $pyt_zdjecie_z_bazy -> execute([$id]);

        if($pyt_zdjecie_z_bazy){
            $wykonanie = $pyt_zdjecie_z_bazy->fetch(PDO::FETCH_ASSOC);
            $stare_zdjecie = $wykonanie['zdjecie'];
        }

        $zdjecie_do_usuniecia = $stare_zdjecie;

        //usuniecie starego zdjecia
        if(file_exists($zdjecie_do_usuniecia)) {
            unlink($zdjecie_do_usuniecia);
        } 

        //nowe zdjecie
            
        if(move_uploaded_file($zdjecietemp, $sciezka . $nowa_nazwa_zdjecia)) {
            $dodanie_produktu = $conn->prepare('UPDATE produkty SET zdjecie = ? WHERE id = ?');
            $dodanie_produktu -> execute([$sciezka_do_bazy, $id]);
        }
        else {
            $_SESSION['error'] = "Nie udało sie umieścić zdjecia!";
        }
    }
    else {
        $_SESSION['error'] = "Nie udało sie zapisać zdjecia!";
    }
}   
else{
    $_SESSION['error'] = "Zdjęcie może być tylko w formacie jpg, jpeg, png !";
    
}
}
header("location: panel.php");
$conn = null;
}
else{
    $_SESSION['error'] = "Wpisz ID";
    header("location: panel.php");
}
?>