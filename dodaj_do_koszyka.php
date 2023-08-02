<?php
session_start();
$indeks = $_POST['indeks'];
$rozmiar = $_POST['rozmiar'];
$limit = $_POST['ilosc_rozmiaru'];
$ilosc = 1;
if(empty($_SESSION['koszyk'])){
    $koszyk= array($indeks, $rozmiar, $ilosc, $limit);
    $_SESSION['koszyk'] = array($koszyk);
}
else{    
    for($i=0; $i < sizeof($_SESSION['koszyk']); $i++){
        $powtorzenie = in_array($indeks, $_SESSION['koszyk'][$i]);
        if($powtorzenie == TRUE){
            $tablica = $i;
        }
    }
    if($powtorzenie == TRUE){
        $nowa_ilosc = $_SESSION['koszyk'][$tablica][2];
        $nowa_ilosc += 1;
        $_SESSION['koszyk'][$tablica][2] = $nowa_ilosc;
    }
    else{
        $push_array = array($indeks, $rozmiar, $ilosc, $limit);
        array_push($_SESSION['koszyk'], $push_array);
    }
}

print_r($_SESSION['koszyk']);
?>
