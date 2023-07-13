<?php
session_start();
include_once('laczenieZbaza.php');
if(!empty($_POST["nazwa"])){

$nazwa = $_POST["nazwa"];
$cena = $_POST["cena"];
// $ilosc = $_POST["ilosc"];
$rodzaj = $_POST["rodzaj"];
//rozmiary value
$ilosc_XS = $_POST["XS"];
$ilosc_S = $_POST["S"];
$ilosc_M = $_POST["M"];
$ilosc_L = $_POST["L"];
$ilosc_XL = $_POST["XL"];
$ilosc_XXL = $_POST["XXL"];
$ilosc_Uniwersalny = $_POST["Uniwersalny"];
if(empty($ilosc_Uniwersalny)){
    $ilosc_Uniwersalny = 0;
}
if(empty($ilosc_XS)){
    $ilosc_XS = 0;
}
if(empty($ilosc_S)){
    $ilosc_S = 0;
}
if(empty($ilosc_M)){
    $ilosc_M = 0;
}
if(empty($ilosc_L)){
    $ilosc_L = 0;
}
if(empty($ilosc_XL)){
    $ilosc_XL = 0;
}
if(empty($ilosc_XXL)){
    $ilosc_XXL = 0;
}

$opis = $_POST["opis"];

$nazwa_zdjecia1 = $_FILES["zdjecie1"]["name"];
$zdjecietemp1 = $_FILES["zdjecie1"]["tmp_name"];
$rozszerzenie_zdjecia1 = mime_content_type($zdjecietemp1);
if(!empty($_FILES["zdjecie2"]["name"]) && isset($_FILES["zdjecie2"]["name"])){
    $nazwa_zdjecia2 = $_FILES["zdjecie2"]["name"];
    $zdjecietemp2 = $_FILES["zdjecie2"]["tmp_name"];
    $rozszerzenie_zdjecia2 = mime_content_type($zdjecietemp2);
}
if(!empty($_FILES["zdjecie3"]["name"]) && isset($_FILES["zdjecie3"]["name"])){
    $nazwa_zdjecia3 = $_FILES["zdjecie3"]["name"];
    $zdjecietemp3 = $_FILES["zdjecie3"]["tmp_name"];
    $rozszerzenie_zdjecia3 = mime_content_type($zdjecietemp3);
}
if(!empty($_FILES["zdjecie4"]["name"]) && isset($_FILES["zdjecie4"]["name"])){
    $nazwa_zdjecia4 = $_FILES["zdjecie4"]["name"];
    $zdjecietemp4 = $_FILES["zdjecie4"]["tmp_name"];
    $rozszerzenie_zdjecia4 = mime_content_type($zdjecietemp4);
}
//sprawdzanie formatu
if(!empty($nazwa_zdjecia1) && isset($nazwa_zdjecia1)){
if($rozszerzenie_zdjecia1 == "image/png" || $rozszerzenie_zdjecia1 == "image/jpg" || $rozszerzenie_zdjecia1 == "image/jpeg" || $rozszerzenie_zdjecia1 == "image/webp"){
    $zmiana1 = str_replace("ą", "a", $nazwa);
    $zmiana2 = str_replace("ć", "c", $zmiana1);
    $zmiana3 = str_replace("ę", "e", $zmiana2);
    $zmiana4 = str_replace("ł", "l", $zmiana3);
    $zmiana5 = str_replace("ń", "n", $zmiana4);
    $zmiana6 = str_replace("ó", "o", $zmiana5);
    $zmiana7 = str_replace("ś", "s", $zmiana6);
    $zmiana8 = str_replace("ż", "z", $zmiana7);
    $zmiana9 = str_replace("ź", "z", $zmiana8);
    $zmiana10 = str_replace("Ą", "a", $zmiana9);
    $zmiana11 = str_replace("Ć", "c", $zmiana10);
    $zmiana12 = str_replace("Ę", "e", $zmiana11);
    $zmiana13 = str_replace("Ł", "l", $zmiana12);
    $zmiana14 = str_replace("Ń", "n", $zmiana13);
    $zmiana15 = str_replace("Ó", "o", $zmiana14);
    $zmiana16 = str_replace("Ś", "s", $zmiana15);
    $zmiana17 = str_replace("Ż", "z", $zmiana16);
    $zmiana18 = str_replace("Ź", "z", $zmiana17);
    $litery_male = strtolower($zmiana18);
    $str = str_replace(" ", "-", $litery_male);
    $litera = strtolower(chr(rand(65,91)));
    $generuj_indeks = rand(0,999999) . $litera;
    $strona = $str . "-" .$generuj_indeks. ".php";
    $link = "http://localhost/forum/produkty/". $strona;

    if(!empty($nazwa_zdjecia2) && isset($nazwa_zdjecia2)){
    
    if($rozszerzenie_zdjecia2 == "image/png" || $rozszerzenie_zdjecia2 == "image/jpg" || $rozszerzenie_zdjecia2 == "image/jpeg" || $rozszerzenie_zdjecia2 == "image/webp"){
        if(is_uploaded_file($zdjecietemp2)){
            //nowa nazwa z datą
            $zdjecie_bez_roz2 = explode(".",$nazwa_zdjecia2);
            $nowa_nazwa_zdjecia2 = date("Y-m-d-H-i-s") . "-2" . '.' . $zdjecie_bez_roz2[1];
            $sciezka2 = "zdjecia_produktow/";
            $sciezka_do_bazy2 = $sciezka2 . $nowa_nazwa_zdjecia2;
        }
    }

    }
    else{
        $sciezka_do_bazy2 = NULL;
    }
    if(!empty($nazwa_zdjecia3) && isset($nazwa_zdjecia3)){

    if($rozszerzenie_zdjecia3 == "image/png" || $rozszerzenie_zdjecia3 == "image/jpg" || $rozszerzenie_zdjecia3 == "image/jpeg" || $rozszerzenie_zdjecia3 == "image/webp"){
        if(is_uploaded_file($zdjecietemp3)){
            //nowa nazwa z datą
            $zdjecie_bez_roz3 = explode(".",$nazwa_zdjecia3);
            $nowa_nazwa_zdjecia3 = date("Y-m-d-H-i-s") . "-3" . '.' . $zdjecie_bez_roz3[1];
            $sciezka3 = "zdjecia_produktow/";
            $sciezka_do_bazy3 = $sciezka3 . $nowa_nazwa_zdjecia3;
        }
    }

    }
    else{
        $sciezka_do_bazy3 = NULL;
    }
    if(!empty($nazwa_zdjecia4) && isset($nazwa_zdjecia4)){

    if($rozszerzenie_zdjecia4 == "image/png" || $rozszerzenie_zdjecia4 == "image/jpg" || $rozszerzenie_zdjecia4 == "image/jpeg" || $rozszerzenie_zdjecia4 == "image/webp"){
        if(is_uploaded_file($zdjecietemp4)){
            //nowa nazwa z datą
            $zdjecie_bez_roz4 = explode(".",$nazwa_zdjecia4);
            $nowa_nazwa_zdjecia4 = date("Y-m-d-H-i-s") . "-4" . '.' . $zdjecie_bez_roz4[1];
            $sciezka4 = "zdjecia_produktow/";
            $sciezka_do_bazy4 = $sciezka4 . $nowa_nazwa_zdjecia4;
        }
    }

    }
    else{
        $sciezka_do_bazy4 = NULL;
    }
    if(is_uploaded_file($zdjecietemp1)){
        //nowa nazwa z datą
        $zdjecie_bez_roz = explode(".",$nazwa_zdjecia1);
        $nowa_nazwa_zdjecia = date("Y-m-d-H-i-s") . "-1" . '.' . $zdjecie_bez_roz[1];
        $sciezka = "zdjecia_produktow/";
        $sciezka_do_bazy = $sciezka . $nowa_nazwa_zdjecia;

        //dodanie produktu do bazy
        $suma = $ilosc_XS + $ilosc_S + $ilosc_M + $ilosc_L + $ilosc_XL + $ilosc_XXL + $ilosc_Uniwersalny; 
        $dodanie_produktu = $conn->prepare('INSERT INTO produkty (nazwa,cena,ilosc,rodzaj,opis,zdjecie1,zdjecie2,zdjecie3,zdjecie4,indeks_produktu,link) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $dodanie_produktu -> execute([$litery_male, $cena, $suma, $rodzaj, $opis, $sciezka_do_bazy, $sciezka_do_bazy2, $sciezka_do_bazy3, $sciezka_do_bazy4, $generuj_indeks,$link]);
        $pyt_id = $conn -> prepare('SELECT id FROM produkty WHERE indeks_produktu LIKE ?');
        $pyt_id -> execute([$generuj_indeks]);
        $id = $pyt_id -> fetch(PDO::FETCH_ASSOC);
        $i = $id["id"];
        if(!empty($ilosc_XS) && isset($ilosc_XS)){
            $dodaj_rozmiar1 = $conn->prepare('INSERT INTO rozmiary_produktow (id_produktu,rozmiar,ilosc) VALUES(?, ?, ?)');
            $dodaj_rozmiar1 -> execute([$i, "XS", $ilosc_XS]);
        }
        if(!empty($ilosc_S) && isset($ilosc_S)){
            $dodaj_rozmiar2 = $conn->prepare('INSERT INTO rozmiary_produktow (id_produktu,rozmiar,ilosc) VALUES(?, ?, ?)');
            $dodaj_rozmiar2 -> execute([$i, "S", $ilosc_S]);
        }
        if(!empty($ilosc_M) && isset($ilosc_M)){
            $dodaj_rozmiar3 = $conn->prepare('INSERT INTO rozmiary_produktow (id_produktu,rozmiar,ilosc) VALUES(?, ?, ?)');
            $dodaj_rozmiar3 -> execute([$i, "M", $ilosc_M]);
        }
        if(!empty($ilosc_L) && isset($ilosc_L)){
            $dodaj_rozmiar4 = $conn->prepare('INSERT INTO rozmiary_produktow (id_produktu,rozmiar,ilosc) VALUES(?, ?, ?)');
            $dodaj_rozmiar4 -> execute([$i, "L", $ilosc_L]);
        }
        if(!empty($ilosc_XL) && isset($ilosc_XL)){
            $dodaj_rozmiar5 = $conn->prepare('INSERT INTO rozmiary_produktow (id_produktu,rozmiar,ilosc) VALUES(?, ?, ?)');
            $dodaj_rozmiar5 -> execute([$i, "XL", $ilosc_XL]);
        }
        if(!empty($ilosc_XXL) && isset($ilosc_XXL)){
            $dodaj_rozmiar6 = $conn->prepare('INSERT INTO rozmiary_produktow (id_produktu,rozmiar,ilosc) VALUES(?, ?, ?)');
            $dodaj_rozmiar6 -> execute([$i, "XXL", $ilosc_XXL]);
        }
        if(!empty($ilosc_Uniwersalny) && isset($ilosc_Uniwersalny)){
            $dodaj_rozmiar7 = $conn->prepare('INSERT INTO rozmiary_produktow (id_produktu,rozmiar,ilosc) VALUES(?, ?, ?)');
            $dodaj_rozmiar7 -> execute([$i, "Uniwersalny", $ilosc_Uniwersalny]);
        }

        //dodanie zdjec do folderu
        if(move_uploaded_file($zdjecietemp2, $sciezka2 . $nowa_nazwa_zdjecia2)){

        }
        if(move_uploaded_file($zdjecietemp3, $sciezka3 . $nowa_nazwa_zdjecia3)){

        }
        if(move_uploaded_file($zdjecietemp4, $sciezka4 . $nowa_nazwa_zdjecia4)){

        }

        //nowe strona produktu
            
        if(move_uploaded_file($zdjecietemp1, $sciezka . $nowa_nazwa_zdjecia)) {
            $nowastrona = 'produkty/' . $strona;
            $nowa_strona_produktu = fopen($nowastrona,"w");
            copy('produkty/kod_strony_produktu.txt', $nowastrona);
            fclose($nowa_strona_produktu);
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
    $_SESSION['error'] = "Zdjęcie może być tylko w formacie jpg, jpeg, png, webp!";
    header("location: panel.php");
}
}
else{
    $_SESSION['error'] = "Dodaj zdjecie!"; 
}
$_SESSION['success'] = "Dodano produkt";
}

else{
    $_SESSION['error'] = "Wpisz wszystkie pola!";
    $conn = null;
    header("location: panel.php");
}

$conn = null;
header("location: panel.php");
?>