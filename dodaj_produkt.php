<?php
session_start();
include_once('laczenieZbaza.php');
if(!empty($_POST["nazwa"])){

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

    if(is_uploaded_file($zdjecietemp)){
        //nowa nazwa z datą
        $zdjecie_bez_roz = explode(".",$nazwa_zdjecia);
        $nowa_nazwa_zdjecia = date("Y-m-d-H-i-s") . '.' . $zdjecie_bez_roz[1];
        $sciezka = "zdjecia_produktow/";
        $sciezka_do_bazy = $sciezka . $nowa_nazwa_zdjecia;

        //dodanie produktu do bazy
        $dodanie_produktu = $conn->prepare('INSERT INTO produkty (nazwa,cena,ilosc,rodzaj,opis,zdjecie,indeks_produktu,link) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $dodanie_produktu -> execute([$str, $cena, $ilosc, $rodzaj, $opis, $sciezka_do_bazy,$generuj_indeks,$link]);
        $pyt_id = $conn -> prepare('SELECT id FROM produkty WHERE indeks_produktu LIKE ?');
        $pyt_id -> execute([$generuj_indeks]);
        $id = $pyt_id -> fetch(PDO::FETCH_ASSOC);
        $i = $id["id"];
        $dodaj_rozmiar = $conn->prepare('INSERT INTO rozmiary_produktow (id_produktu,rozmiar) VALUES(?, ?)');
        $dodaj_rozmiar -> execute([$i, $rozmiar]);

        //nowe zdjecie
            
        if(move_uploaded_file($zdjecietemp, $sciezka . $nowa_nazwa_zdjecia)) {
            $dodanie_produktu = $conn->prepare('UPDATE produkty SET zdjecie = ? WHERE id = ?');
            $dodanie_produktu -> execute([$sciezka_do_bazy, $i]);
            // include_once("conf_nowa_strona.php");
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
    $_SESSION['error']= "Zdjęcie może być tylko w formacie jpg, jpeg, png, webp !";
    header("location: panel.php");
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