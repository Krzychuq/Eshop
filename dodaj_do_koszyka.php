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
        $if1=0;
        $if2=0;
        //szuka powtorzenia
        for($i=0; $i < sizeof($_SESSION['koszyk']); $i++){
            if($indeks == $_SESSION['koszyk'][$i][0] && $rozmiar == $_SESSION['koszyk'][$i][1] && $limit == $_SESSION['koszyk'][$i][3]){
                if($_SESSION['koszyk'][$i][2] < $_SESSION['koszyk'][$i][3]){
                    $nowa_ilosc = $_SESSION['koszyk'][$i][2];
                    $nowa_ilosc += 1;
                    $_SESSION['koszyk'][$i][2] = $nowa_ilosc;
                }
                $if1 = true;
                // debbug
                // echo "1"; 
                break;
            }  
            //dodaje ten sam produkt z innym rozmiarem
            elseif($_SESSION['koszyk'][$i][0] == $indeks && $limit == $_SESSION['koszyk'][$i][3] && $_SESSION['koszyk'][$i][1] != $rozmiar){
                $push_array = array($indeks, $rozmiar, $ilosc, $limit);
                array_push($_SESSION['koszyk'], $push_array);
                $if2 = true;
                // debbug
                // echo "2"; 
                break;
            }
        }
        // dodaje nowy
        if($if1 == FALSE && $if2 == FALSE){
            $push_array = array($indeks, $rozmiar, $ilosc, $limit);
            array_push($_SESSION['koszyk'], $push_array);
            // debbug
            // echo '3';
        }
    }
    // debbug
    // print_r($_SESSION['koszyk']);
}
}

else{
    $_SESSION['error'] ='Wybierz rozmiar';
}
}

?>
