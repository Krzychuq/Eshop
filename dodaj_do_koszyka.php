<?php
if(session_status() == PHP_SESSION_DISABLED){ session_start(); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    //submit
    if(!empty($_POST['ilosc_rozmiaru'])){

    if(isset($_POST['btnsubmit'])) {
        $indeks = $_POST['indeks']; //[0]
        $rozmiar = $_POST['rozmiar']; //[1]
        $limit = $_POST['ilosc_rozmiaru']; //[3]
        $ilosc = 1; //[2]
    //dodaj produkt    
        if(empty($_SESSION['koszyk'])){
            $koszyk= array($indeks, $rozmiar, $ilosc, $limit);
            $_SESSION['koszyk'] = array($koszyk);
        }
        else{ 
            //szuka powtorzenia by zwiekszyc ilosc
            for($i=0; $i < sizeof($_SESSION['koszyk']); $i++){
                $powtorzenie = in_array($indeks, $_SESSION['koszyk'][$i]);
                $powtorzenie_r = in_array($rozmiar, $_SESSION['koszyk'][$i]);
                if($powtorzenie == $powtorzenie_r){
                    $tablica = $i;
                    break;
                }
                
            }
            //dodaje pierwszy produkt
            if($_SESSION['koszyk'][$tablica][0] != $indeks ){
                $push_array = array($indeks, $rozmiar, $ilosc, $limit);
                array_push($_SESSION['koszyk'], $push_array);
            }
            //dodaje ten sam ze zwiekszona liczba produkt
            elseif($_SESSION['koszyk'][$tablica][0] == $indeks && $_SESSION['koszyk'][$tablica][1] == $rozmiar && $_SESSION['koszyk'][$tablica][2] < $_SESSION['koszyk'][$tablica][3]){
                $nowa_ilosc = $_SESSION['koszyk'][$tablica][2];
                $nowa_ilosc += 1;
                $_SESSION['koszyk'][$tablica][2] = $nowa_ilosc;
            }
            //dodaje nowy produkt
            elseif($_SESSION['koszyk'][$tablica][0] == $indeks && $_SESSION['koszyk'][$tablica][1] != $rozmiar){
                $push_array = array($indeks, $rozmiar, $ilosc, $limit);
                array_push($_SESSION['koszyk'], $push_array);
            }
            else{
                //nic
            }
        }
        
        print_r($_SESSION['koszyk']);
    }
  }
  else{
    $_SESSION['error'] ='Wybierz rozmiar';
  }
}

?>
