<?php
session_start();
//połączenie
include_once("laczenieZbaza.php");

//identyfikacja
$mail = $_SESSION['email'];
$pyt_o_id = $conn->prepare("SELECT id FROM loginy WHERE login like ?");
$pyt_o_id -> execute([$mail]);
$wykonanie = $pyt_o_id->fetch(PDO::FETCH_ASSOC);
$id = $wykonanie['id'];

//Zapis danych
// \\\\\\\\\\\\\\\\\\\\DANE KONTA////////////////

// imie
$incorrect_data = [];
$imie = '';
$nazwisko = '';
$telOS = '';
$kodpocztowy = '';
$nrdomu = '';
$nrmieszkania = '';
$miasto = '';
$kraj = '';

if(!empty($_POST["imie"])){
    $dane = $_POST["imie"];
    $pattern1 = "/\d/i";
    $pattern2 = "/\W/i";
    if(preg_match($pattern1, $dane) || preg_match($pattern2, $dane)){
        array_push($incorrect_data, "imie");
    }
    else{
        $imie = $dane;
    }
}

// nazwisko
if(!empty($_POST["nazwisko"])){
    $dane = $_POST["nazwisko"];
    $pattern1 = "/\d/i";
    $pattern2 = "/\W/i";
    if(preg_match($pattern1, $dane) || preg_match($pattern2, $dane)){
        array_push($incorrect_data, "nazwisko");
    }
    else{
        $nazwisko = $dane;
    }
}

// telefon
if(!empty($_POST["tel"])){
    $dane = $_POST["tel"];
    $pattern1 = "/\d/i";
    $pattern2 = "/\W/i";
    if(preg_match($pattern1, $dane) || preg_match($pattern2, $dane)){
        array_push($incorrect_data, "numer telefonu");
    }
    else{
        $telOS = $dane;
    }
}
// \\\\\\\\\\\\\\DANE DO WYSYLKI/////////////////

// kod pocztowy
if(!empty($_POST["kod_pocztowy"])){
    $dane = $_POST["kod_pocztowy"];
    $pyt = $conn->prepare("UPDATE dane_konta SET kod_pocztowy = ? WHERE id_loginu = ?");
    $pyt -> execute([$dane, $id]);
}

// ulica
if(!empty($_POST["ulica"])){
    $dane = $_POST["ulica"];
    $pyt = $conn->prepare("UPDATE dane_konta SET ulica = ? WHERE id_loginu = ?");
    $pyt -> execute([$dane, $id]);
}

// nr domu
if(!empty($_POST["nr_domu"])){
    $dane = $_POST["nr_domu"];
    $pyt = $conn->prepare("UPDATE dane_konta SET nr_domu = ? WHERE id_loginu = ?");
    $pyt -> execute([$dane, $id]);
}

// nr mieszkania
if(!empty($_POST["nr_mieszkania"])){
    $dane = $_POST["nr_mieszkania"];
    $pyt = $conn->prepare("UPDATE dane_konta SET nr_mieszkania = ? WHERE id_loginu = ?");
    $pyt -> execute([$dane, $id]);
}

// miasta
if(!empty($_POST["miasto"])){
    $dane = $_POST["miasto"];
    $pyt = $conn->prepare("UPDATE dane_konta SET miasto = ? WHERE id_loginu = ?");
    $pyt -> execute([$dane, $id]);
}

// kraj
if(!empty($_POST["kraj"])){
    $dane = $_POST["kraj"];
    $pyt = $conn->prepare("UPDATE dane_konta SET kraj = ? WHERE id_loginu = ?");
    $pyt -> execute([$dane, $id]);
    $_SESSION['success'] = "Zapisano dane";
}


// !!!!!!!!!!!!!!!!!!!!!! Wysyła do bazy dane klienta i wysylki za jednym  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// inprogressssssssssssssssssssss
// if(){

//     $pyt = $conn->prepare("UPDATE dane_konta SET imie = ? WHERE id_loginu = ?");
//     $pyt -> execute([, $id]);
// }
// 



// \\\\\\\\\\\\\\\\\\\\\\\\\\\DANE DO FAKTURY//////////////////////
$url = explode("=",$_SERVER["REQUEST_URI"]);
$state = $url[1];
if( $state == 0 ){
    // nip
    if( !empty($_POST["nip"]) && !empty($_POST["firma"]) && !empty($_POST["adresf"]) && !empty($_POST["kod_pocztowyf"]) && !empty($_POST["miastof"]) && !empty($_POST["krajf"]) ){
        $nip = $_POST["nip"];
        $firma = $_POST["firma"];
        $adresf = $_POST["adresf"];
        $kod_pocztowyf = $_POST["kod_pocztowyf"];
        $miastof = $_POST["miastof"];
        $krajf = $_POST["krajf"];
        $pyt = $conn->prepare("INSERT INTO dane_do_faktury(id_konta, nip, nazwa_firmy, adres, kod_pocztowy, miasto, kraj) VALUES(?,?,?,?,?,?,?)");
        $pyt -> execute([$id, $nip, $firma, $adresf, $kod_pocztowyf, $miastof, $krajf]);
    }
}
else{
    // nip
    if(!empty($_POST["nip"])){
        $dane = $_POST["nip"];
        $pyt = $conn->prepare("UPDATE dane_do_faktury SET NIP = ? WHERE id_konta = ?");
        $pyt -> execute([$dane, $id]);
    }
    // nazwa firmy
    if(!empty($_POST["firma"])){
        $dane = $_POST["firma"];
        $pyt = $conn->prepare("UPDATE dane_do_faktury SET nazwa_firmy = ? WHERE id_konta = ?");
        $pyt -> execute([$dane, $id]);
    }
    // adres firmy
    if(!empty($_POST["adresf"])){
        $dane = $_POST["adresf"];
        $pyt = $conn->prepare("UPDATE dane_do_faktury SET adres = ? WHERE id_konta = ?");
        $pyt -> execute([$dane, $id]);
    }
    // kod firmy
    if(!empty($_POST["kod_pocztowyf"])){
        $dane = $_POST["kod_pocztowyf"];
        $pyt = $conn->prepare("UPDATE dane_do_faktury SET kod_pocztowy = ? WHERE id_konta = ?");
        $pyt -> execute([$dane, $id]);
    }
    // miasto firmy
    if(!empty($_POST["miastof"])){
        $dane = $_POST["miastof"];
        $pyt = $conn->prepare("UPDATE dane_do_faktury SET miasto = ? WHERE id_konta = ?");
        $pyt -> execute([$dane, $id]);
    }
    // kraj firmy
    if(!empty($_POST["krajf"])){
        $dane = $_POST["krajf"];
        $pyt = $conn->prepare("UPDATE dane_do_faktury SET kraj = ? WHERE id_konta = ?");
        $pyt -> execute([$dane, $id]);
    }
}

if( empty($_SESSION['error']) ){
    $_SESSION['success'] = "Zapisano dane";
}
$conn = null;
header('location:konto.php');
?>