<?php
include_once('laczenieZbaza.php');
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
if($rozszerzenie_zdjecia == "image/png" || $rozszerzenie_zdjecia == "image/jpg" || $rozszerzenie_zdjecia == "image/jpeg" || $rozszerzenie_zdjecia == "image/webp"){
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
    $dodanie_produktu = $conn->prepare('INSERT INTO produkty (nazwa,cena,ilosc,rodzaj,rozmiar,opis,zdjecie,indeks_produktu,link) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $dodanie_produktu -> execute([$nazwa, $cena, $ilosc, $rodzaj, $rozmiar, $opis, $sciezka_do_bazy,$generuj_indeks,$link]);
    if(is_uploaded_file($zdjecietemp)){
        //nowa nazwa z datą
        $zdjecie_bez_roz = explode(".",$nazwa_zdjecia);
        $nowa_nazwa_zdjecia = date("Y-m-d-H-i-s") . '.' . $zdjecie_bez_roz[1];
        $sciezka = "zdjecia_produktow/";
        $sciezka_do_bazy = $sciezka . $nowa_nazwa_zdjecia;
        //nowe zdjecie
            
        if(move_uploaded_file($zdjecietemp, $sciezka . $nowa_nazwa_zdjecia)) {
            $dodanie_produktu = $conn->prepare('UPDATE produkty SET zdjecie = ? WHERE id = ?');
            $dodanie_produktu -> execute([$sciezka_do_bazy, $id]);
            include_once("conf_nowa_strona.php");
            $nowa_strona_produktu = fopen($strona,"w");
            $fwrite($nowa_strona_produktu, $kod_strony);
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
    $_SESSION['error']= "Zdjęcie może być tylko w formacie jpg, jpeg, png, webp !";
    header("location: panel.php");
}
header("location: panel.php");
$conn = null;

?>