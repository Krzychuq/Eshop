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

    $pyt = $conn -> prepare("SELECT indeks_produktu,link FROM produkty WHERE id = ?");
    $pyt -> execute([$id]);
    $indeks = $pyt -> fetch();

    $strona = $str . "-" . $indeks["indeks_produktu"] . ".php";
    $nowa_strona_nazwa = "produkty/" . $strona;
    $stara_strona = explode('http://localhost/forum/', $indeks["link"]);

    rename($stara_strona[1], $nowa_strona_nazwa);
    $link = "http://localhost/forum/produkty/". $strona;

    $dodanie_produktu = $conn->prepare('UPDATE produkty SET nazwa = ?,indeks_produktu = ?, link = ? WHERE id = ?');
    $dodanie_produktu -> execute([$nazwa, $indeks["indeks_produktu"], $link, $id]);
}

if(!empty($_POST["cena"]) && isset($_POST["cena"])){
    $cena = $_POST["cena"];
    $dodanie_produktu = $conn->prepare('UPDATE produkty SET cena = ? WHERE id = ?');
    $dodanie_produktu -> execute([$cena, $id]);
}


if(!empty($_POST["XS"]) && isset($_POST["XS"])){
    $dodaj_rozmiar1 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar1 -> execute([$_POST["XS"], $id, "XS"]);
}
if(!empty($_POST["S"]) && isset($_POST["S"])){
    $dodaj_rozmiar2 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar2 -> execute([$_POST["S"], $id, "S"]);
}
if(!empty($_POST["M"]) && isset($_POST["M"])){
    $dodaj_rozmiar3 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar3 -> execute([$_POST["M"], $id, "M"]);
}
if(!empty($_POST["L"]) && isset($_POST["L"])){
    $dodaj_rozmiar4 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar4 -> execute([$_POST["L"], $id, "L" ]);
}
if(!empty($_POST["XL"]) && isset($_POST["XL"])){
    $dodaj_rozmiar5 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar5 -> execute([$_POST["XL"], $id, "XL" ]);
}
if(!empty($_POST["XXL"]) && isset($_POST["XXL"])){
    $dodaj_rozmiar6 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar6 -> execute([ $_POST["XXL"], $id, "XXL"]);
}
if(!empty($_POST["Uniwersalny"]) && isset($_POST["Uniwersalny"])){
    $dodaj_rozmiar7 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar7 -> execute([$_POST["Uniwersalny"]], $id, "Uniwersalny" );
}
if(!empty($_POST["XS"]) || !empty($_POST["S"]) || !empty($_POST["M"]) || !empty($_POST["L"]) || !empty($_POST["XL"]) || !empty($_POST["XXL"]) || !empty($_POST["Uniwersalny"])){
    $pyt_ilosc = $conn -> prepare("SELECT ilosc FROM rozmiary_produktow WHERE id_produktu = ?");
    $pyt_ilosc -> execute([$id]);
    $suma = 0;
    while ($linia = $pyt_ilosc->fetch()) {
        $suma += $linia[0];
    }
    $akt_ilosc = $conn -> prepare("UPDATE produkty SET ilosc = ? WHERE id = ?");
    $akt_ilosc -> execute([$suma, $id]);
}

if(!empty($_POST["rodzaj"]) && isset($_POST["rodzaj"])){
    $rodzaj = $_POST["rodzaj"];
    $dodanie_produktu = $conn->prepare('UPDATE produkty SET rodzaj = ? WHERE id = ?');
    $dodanie_produktu -> execute([$rodzaj, $id]);
}

if(!empty($_POST["rozmiar"]) && isset($_POST["rozmiar"])){
    $rozmiar = $_POST["rozmiar"];
    $dodanie_produktu = $conn->prepare('UPDATE rozmiary_produktow SET rozmiar = ? WHERE id_produktu = ?');
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