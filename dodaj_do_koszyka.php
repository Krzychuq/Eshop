<?php
session_start();
$indeks = $_POST['indeks'];
$rozmiar = $_POST['rozmiar'];
$limit = $_POST['ilosc_rozmiaru'];
$_SESSION['indeks_produktu'] = $indeks;
$_SESSION['rozmiar_produktu'] = $rozmiar;
$indeks = $_SESSION['indeks_produktu'];
$rozmiar = $_SESSION['rozmiar_produktu'];
$ilosc = 1;
if(empty($_SESSION['koszyk'])){
    $koszyk= array($indeks, $rozmiar, $ilosc, $limit);
    $_SESSION['koszyk'] = array($koszyk);
}
elseif(!empty($_SESSION['koszyk'])){    
    for($i=0; $i < sizeof($_SESSION['koszyk']); $i++){
        if(in_array($indeks,$_SESSION['koszyk'][$i])){
            $nowa_ilosc = $_SESSION['koszyk'][$i][2];
            $nowa_ilosc += 1;
            $_SESSION['koszyk'][$i][2] = $nowa_ilosc;
        }
        else{
            $push_array = array($indeks, $rozmiar, $ilosc,$limit);
            array_push($_SESSION['koszyk'], $push_array);
            break;
        }

    }

}
print_r($_SESSION['koszyk']);
?>
