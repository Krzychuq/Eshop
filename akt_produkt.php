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
    if($dodaj_rozmiar1 -> rowCount() == 0){
        $_SESSION['error'] = "Nie ma takiego rozmiaru";
    }
    else{
        $_SESSION['success'] = "Zaaktualizowano produkt";
    }
}
if(!empty($_POST["S"]) && isset($_POST["S"])){
    $dodaj_rozmiar2 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar2 -> execute([$_POST["S"], $id, "S"]);
    if($dodaj_rozmiar2 -> rowCount() == 0){
        $_SESSION['error'] = "Nie ma takiego rozmiaru";
    }
    else{
        $_SESSION['success'] = "Zaaktualizowano produkt";
    }
}
if(!empty($_POST["M"]) && isset($_POST["M"])){
    $dodaj_rozmiar3 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar3 -> execute([$_POST["M"], $id, "M"]);
    if($dodaj_rozmiar3 -> rowCount() == 0){
        $_SESSION['error'] = "Nie ma takiego rozmiaru";
    }
    else{
        $_SESSION['success'] = "Zaaktualizowano produkt";
    }
}
if(!empty($_POST["L"]) && isset($_POST["L"])){
    $dodaj_rozmiar4 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar4 -> execute([$_POST["L"], $id, "L" ]);
    if($dodaj_rozmiar4 -> rowCount() == 0){
        $_SESSION['error'] = "Nie ma takiego rozmiaru";
    }
    else{
        $_SESSION['success'] = "Zaaktualizowano produkt";
    }
}
if(!empty($_POST["XL"]) && isset($_POST["XL"])){
    $dodaj_rozmiar5 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar5 -> execute([$_POST["XL"], $id, "XL" ]);
    if($dodaj_rozmiar5 -> rowCount() == 0){
        $_SESSION['error'] = "Nie ma takiego rozmiaru";
    }
    else{
        $_SESSION['success'] = "Zaaktualizowano produkt";
    }
}
if(!empty($_POST["XXL"]) && isset($_POST["XXL"])){
    $dodaj_rozmiar6 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar6 -> execute([ $_POST["XXL"], $id, "XXL"]);
    if($dodaj_rozmiar6 -> rowCount() == 0){
        $_SESSION['error'] = "Nie ma takiego rozmiaru";
    }
    else{
        $_SESSION['success'] = "Zaaktualizowano produkt";
    }
}
if(!empty($_POST["Uniwersalny"]) && isset($_POST["Uniwersalny"])){
    $dodaj_rozmiar7 = $conn->prepare('UPDATE rozmiary_produktow SET ilosc = ? WHERE id_produktu = ? AND rozmiar LIKE ?');
    $dodaj_rozmiar7 -> execute([$_POST["Uniwersalny"]], $id, "Uniwersalny" );
    if($dodaj_rozmiar7 -> rowCount() == 0){
        $_SESSION['error'] = "Nie ma takiego rozmiaru";
    }
    else{
        $_SESSION['success'] = "Zaaktualizowano produkt";
    }
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

if(isset($_FILES['zdjecia']) || !empty($_FILES['zdjecia'])){
    $liczba_zdjec = count($_FILES["zdjecia"]['name']);
    $zdjecia_array = '';
    for($i=0; $i < $liczba_zdjec; $i++){
        if(!empty($_FILES["zdjecia"]['name'][$i]) && isset($_FILES["zdjecia"]['name'][$i])){
            $rozszerzenie = mime_content_type($_FILES["zdjecia"]["tmp_name"][$i]);
    
        if($rozszerzenie == "image/png" || $rozszerzenie == "image/jpg" || $rozszerzenie == "image/jpeg" || $rozszerzenie == "image/webp"){
    
    //POST
        if(is_uploaded_file($_FILES["zdjecia"]['tmp_name'][$i])){
    //nowa nazwa z datą
            $zdjecie_bez_roz = explode(".",$_FILES["zdjecia"]['name'][$i]);
            $nowa_nazwa_zdjecia = date("Y-m-d-H-i-s") . "-$i" . '.' . $zdjecie_bez_roz[1];
            $sciezka = "zdjecia_produktow/";
            $sciezka .= $nowa_nazwa_zdjecia;
            if($i == 0){ $zdjecia_array .= $nowa_nazwa_zdjecia; }
            else{ $zdjecia_array .= "," . $nowa_nazwa_zdjecia; }
    
    //dodanie zdjecia do folderu
            move_uploaded_file($_FILES["zdjecia"]['tmp_name'][$i], $sciezka);
        }   
        }
        }
    }

//dodanie produktu do bazy
$zdjecia_string='';
$zdjecia_array = explode(',', $zdjecia_array);
for($i=0; $i < sizeof($zdjecia_array); $i++){
    if($i== (sizeof($zdjecia_array)-1)){
        $zdjecia_string .= $zdjecia_array[$i];
    }
    else{
        $zdjecia_string .= $zdjecia_array[$i]. ",";
    }
}
$dodanie_produktu = $conn->prepare('INSERT INTO produkty (nazwa,cena,ilosc,rodzaj,opis,zdjecie,indeks_produktu,link) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
$dodanie_produktu -> execute([$litery_male, $cena, $suma, $rodzaj, $opis, $zdjecia_string, $generuj_indeks,$link]);
$conn = null;
header("location: panel.php");
}
else{
    $conn = null;
    $_SESSION['error'] = "Wpisz ID";
    header("location: panel.php");
}
?>