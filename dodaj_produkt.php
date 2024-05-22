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

        //dodanie produktu do bazy
        $suma = $ilosc_XS + $ilosc_S + $ilosc_M + $ilosc_L + $ilosc_XL + $ilosc_XXL + $ilosc_Uniwersalny; 
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

        //nowe strona produktu
        $nowastrona = 'produkty/' . $strona;
        $nowa_strona_produktu = fopen($nowastrona,"w");
        copy('produkty/kod_strony_produktu.txt', $nowastrona);
        fclose($nowa_strona_produktu);

    
$_SESSION['success'] = "Dodano produkt";

}

}
else{
    $_SESSION['error'] = "Wpisz wszystkie pola!";
    $conn = null;
    header("location: panel.php");
}

$conn = null;
header("location: panel.php");
?>