<?php
if(session_status() == PHP_SESSION_DISABLED){ session_start(); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    //submit
    if(isset($_POST['btnsubmit'])) {
        $indeks = $_POST['indeks'];
        $rozmiar = $_POST['rozmiar'];
        $limit = $_POST['ilosc_rozmiaru'];
        $ilosc = 1;
    //dodaj produkt    
        if(empty($_SESSION['koszyk'])){
            $koszyk= array($indeks, $rozmiar, $ilosc, $limit);
            $_SESSION['koszyk'] = array($koszyk);
        }
        else{ 
            //szuka powtorzenia by zwiekszyc ilosc
            for($i=0; $i < sizeof($_SESSION['koszyk']); $i++){
                $powtorzenie = in_array($indeks, $_SESSION['koszyk'][$i]);
                if($powtorzenie == TRUE){
                    $tablica = $i;
                    
                }
            }
            if($_SESSION['koszyk'][$tablica][2] < $_SESSION['koszyk'][$tablica][3]){
                $nowa_ilosc = $_SESSION['koszyk'][$tablica][2];
                $nowa_ilosc += 1;
                $_SESSION['koszyk'][$tablica][2] = $nowa_ilosc;
            }
            //dodaje nowy produkt
            if($powtorzenie == FALSE){
                $push_array = array($indeks, $rozmiar, $ilosc, $limit);
                array_push($_SESSION['koszyk'], $push_array);
            }
        }
        
        // print_r($_SESSION['koszyk']);
    }
  }

?>
