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
// ..............................FUNCTIONS..............................

function input_verification($dane, $nazwa_danych, $typ_inputu , &$incorrect_data){
    switch ($typ_inputu){
        case "abc":
            $dane = ucfirst($dane);
            $pattern1 = "/\s/i";
            $pattern2 = "/\d/i";
            $pattern3 = "/[^A-ZŻŹĆŁÓŚŃĘĄżźćłóśńęą]/i";
            if(preg_match($pattern1, $dane) || preg_match($pattern2, $dane) || preg_match($pattern3, $dane) ){
                array_push($incorrect_data, $nazwa_danych);
                $_SESSION['error'] = "Błędne dane";
            }
            else{
                return $dane;
            }
        break;

        case "nr_domu":
            $pattern1 = "/\d/i";
            $pattern2 = "/[!@#$%^&*()_=+?.,<>]/i";
            $pattern3 = "/\s/i";
            if(!preg_match($pattern1, $dane) || preg_match($pattern2, $dane) || preg_match($pattern3, $dane)){
                array_push($incorrect_data, $nazwa_danych);
                $_SESSION['error'] = "Błędne dane";
            }
            else{
                return $dane;
            }

        break;

        case "kraj":
            $dane = trim($dane);
            $dane = str_replace("_", " ", $dane);
            $pattern1 = "/\d/i";
            $pattern2 = "/[^A-ZŻŹĆŁÓŚŃĘĄżźćłóśńęą\s]/i";
            if(preg_match($pattern1, $dane) || preg_match($pattern2, $dane) ){
                array_push($incorrect_data, $nazwa_danych);
                $_SESSION['error'] = "Błędne dane";
            }
            else{
                return $dane;
            }
        break;

        case "kod_pocztowy":
            $chars = str_split($dane);
            $pattern1 = "[abc]";
            $pattern2 = "/\s/i";
            if( $chars[2] == "-" && !preg_match($pattern1 ,$dane) && !preg_match($pattern2 ,$dane) ){ return $dane; }
            else{ array_push($incorrect_data, $nazwa_danych); }
        break;   

        case "nr_tel":
            $pattern1 = "/\D/i";
            $pattern2 = "/\W/i";
            $pattern3 = "/\s/i";
            if(!preg_match($pattern1, $dane) || !preg_match($pattern2, $dane)|| !preg_match($pattern3, $dane)){
                return $dane;
            }
            else{ array_push($incorrect_data, $nazwa_danych); }
        break;   

        case "nr":
            $pattern1 = "/\D/i";
            $pattern2 = "/\W/i";
            $pattern3 = "/\s/i";
            if(!preg_match($pattern1, $dane) || !preg_match($pattern2, $dane)|| !preg_match($pattern3, $dane) || count($dane) > 4){
                return $dane;
            }
            else{ array_push($incorrect_data, $nazwa_danych); }
        break;  
    }

}
// tworzy zapytanie do aktualizacji
function send_data( $dane_kolumny, $dane_osobowe, &$id, $kolumna, &$conn ,&$incorrect_data, $typ){
    if(count($incorrect_data) == 0){
        if(!count($dane_kolumny) == 0 || !count($dane_osobowe) == 0){
            $kolumny = "";
            $i = 0;
            foreach($dane_kolumny as $rekord){
                if($i == 0){ $kolumny .= " ". $rekord; } 
                else{ $kolumny .= " , ". $rekord; }
        
                $i++;
            }
            // 
            // Sprawdza jakie dane
            // 
            if($typ == "faktura"){ $sql = "UPDATE dane_do_faktury SET " . $kolumny . " WHERE id_konta = :id"; }
            if($typ == "prywatny"){ $sql = "UPDATE dane_konta SET " . $kolumny . " WHERE id_loginu = :id"; }
                    
            
            $pyt = $conn->prepare($sql);
            $ilosc_kolumn = 0;
        
            foreach($dane_osobowe as &$rekord){
                $kol = ":". $kolumna[$ilosc_kolumn]; 
                $pyt->bindParam($kol, $rekord);
                $ilosc_kolumn++;
            }
            
            $pyt->bindParam(":id", $id);
            // \\\\\\\\\\\\\\\\\| Send query |/////////////////////
            if(!$pyt->execute()){
                $_SESSION['success'] = "Zapisano dane";
            }
            if(!$pyt->execute()) $_SESSION['error'] = "Nie zapisano danych";
        }
        else{
            $_SESSION['error'] = "Nie wprowadzono danych";
        }
    }
   
}

// \\\\\\\\\\\\\\\\\\\\| DANE KONTA |///////////////////


$incorrect_data = [];
$imie = '';
$nazwisko = '';
$nr_tel = '';
$kod_pocztowy = '';
$nr_domu = '';
$nr_mieszkania = '';
$miasto = '';
$kraj = '';
$dane_pyt = [];
$dane_osobowe = [];
$kolumna = [];
// imie
if(!empty($_POST["imie"])){
    $a = $_POST["imie"];
    $dane = input_verification( $a, "imie", "abc" , $incorrect_data );

    array_push($dane_pyt, "imie = :imie");
    array_push($kolumna, "imie");
    array_push($dane_osobowe, $dane);
}
// nazwisko
if(!empty($_POST["nazwisko"])){
    $a = $_POST["nazwisko"];
    $dane = input_verification( $a, "nazwisko", "abc" , $incorrect_data );

    array_push($dane_pyt, "nazwisko = :nazwisko");
    array_push($kolumna, "nazwisko");
    array_push($dane_osobowe, $dane);
}

// telefon
if(!empty($_POST["tel"])){
    $a = $_POST["tel"];
    $dane = input_verification( $a, "nr telefonu", "nr_tel" , $incorrect_data );

    array_push($dane_pyt, "nr_tel = :nr_tel");
    array_push($kolumna, "nr_tel");
    array_push($dane_osobowe, $dane);
}



// \\\\\\\\\\\\\\DANE DO WYSYLKI/////////////////

// kod pocztowy
if(!empty($_POST["kod_pocztowy"])){
    $a = $_POST["kod_pocztowy"];
    $dane = input_verification( $a, "kod pocztowy", "kod_pocztowy" , $incorrect_data );

    array_push($dane_pyt, "kod_pocztowy = :kod_pocztowy");
    array_push($kolumna, "kod_pocztowy");
    array_push($dane_osobowe, $dane);
}

// ulica
if(!empty($_POST["ulica"])){
    $a = $_POST["ulica"];
    $dane = input_verification( $a, "ulica", "abc" , $incorrect_data );

    array_push($dane_pyt, "ulica = :ulica");
    array_push($kolumna, "ulica");
    array_push($dane_osobowe, $dane);
}

// nr domu
if(!empty($_POST["nr_domu"])){
    $a = $_POST["nr_domu"];
    $dane = input_verification( $a, "nr domu/mieszkania", "nr_domu" , $incorrect_data );

    array_push($dane_pyt, "nr_domu = :nr_domu");
    array_push($kolumna, "nr_domu");
    array_push($dane_osobowe, $dane);
}

// miasto
if(!empty($_POST["miasto"])){
    $a = $_POST["miasto"];
    $dane = input_verification( $a, "miasto", "abc" , $incorrect_data );

    array_push($dane_pyt, "miasto = :miasto");
    array_push($kolumna, "miasto");
    array_push($dane_osobowe, $dane);
}

// kraj
if(!empty($_POST["kraj"])){
    $a = $_POST["kraj"];
    $dane = input_verification( $a, "kraj", "kraj" , $incorrect_data );

    array_push($dane_pyt, "kraj = :kraj");
    array_push($kolumna, "kraj");
    array_push($dane_osobowe, $dane);
}



// !!!!!!!!!!!!!!!!!!!!!! Wysyła do bazy dane klienta i wysylki za jednym  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if(count($dane_osobowe) > 0){ send_data($dane_pyt, $dane_osobowe, $id, $kolumna, $conn, $incorrect_data, "prywatny"); }



// \\\\\\\\\\\\\\\\\\\\\\\\\\\| DANE DO FAKTURY |//////////////////////
$url = explode("?",$_SERVER["REQUEST_URI"]);
$state = $url[1];
$state = $state[2];
if( $state == 0 ){
    // sprawdza czy istnieją dane do faktury u klienta. Jeśli nie tworzy rekord  
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
    else{
        $_SESSION['error'] = "Błąd";
    }
}
else{
// 
// \\\\\\\\\| Dane faktury |\\\\\\\\\\\
// 
$nip = '';
$nazwa_firmy = '';
$adres = '';
$kod_pocztowy = '';
$miasto = '';
$kraj = '';
$dane_pyt = [];
$dane_osobowe = [];
$kolumna = [];

// \\\\\\\\\\\\\\\\\\\\| Aktualizuje dane do faktury |\\\\\\\\\\\\\\\\
// 
    if(!empty($_POST["nip"])){
        $a = $_POST["nip"];
        $dane = input_verification( $a, "nip", "nr" , $incorrect_data );
    
        array_push($dane_pyt, "NIP = :NIP");
        array_push($kolumna, "NIP");
        array_push($dane_osobowe, $dane);
    }
    // nazwa firmy
    if(!empty($_POST["firma"])){
        $a = $_POST["firma"];
        $dane = input_verification( $a, "nazwa_firmy", "abc" , $incorrect_data );
    
        array_push($dane_pyt, "nazwa_firmy = :nazwa_firmy");
        array_push($kolumna, "nazwa_firmy");
        array_push($dane_osobowe, $dane);
    }
    // adres firmy
    if(!empty($_POST["adresf"])){
        $a = $_POST["adresf"];
        $dane = input_verification( $a, "adres", "abc" , $incorrect_data );
    
        array_push($dane_pyt, "adres = :adres");
        array_push($kolumna, "adres");
        array_push($dane_osobowe, $dane);
    }
    // kod firmy
    if(!empty($_POST["kod_pocztowyf"])){
        $a = $_POST["kod_pocztowyf"];
        $dane = input_verification( $a, "kod_pocztowy", "kod_pocztowy" , $incorrect_data );
    
        array_push($dane_pyt, "kod_pocztowy = :kod_pocztowy");
        array_push($kolumna, "kod_pocztowy");
        array_push($dane_osobowe, $dane);
    }
    // miasto firmy
    if(!empty($_POST["miastof"])){
        $a = $_POST["miastof"];
        $dane = input_verification( $a, "miasto", "abc" , $incorrect_data );
    
        array_push($dane_pyt, "miasto = :miasto");
        array_push($kolumna, "miasto");
        array_push($dane_osobowe, $dane);
    }
    // kraj firmy
    if(!empty($_POST["krajf"])){
        $a = $_POST["krajf"];
        $dane = input_verification( $a, "kraj", "kraj" , $incorrect_data );
    
        array_push($dane_pyt, "kraj = :kraj");
        array_push($kolumna, "kraj");
        array_push($dane_osobowe, $dane);
    }

    // Wykonanie zapytania
    // 
    if(count($dane_osobowe) > 0){ send_data($dane_pyt, $dane_osobowe, $id, $kolumna, $conn, $incorrect_data, "faktura"); }
}

if(!empty($incorrect_data)){
    $list = "";
    $i = 0;
    foreach($incorrect_data as $error){
        if($i==0){$list .= " " . $error;}
        else{$list .= ", " . $error;}
        
        $i++;
    }
    $_SESSION['error'] = "Błędne dane :" . $list;
}
if( empty($_SESSION['error']) ){
    $_SESSION['success'] = "Zapisano dane";
}
$conn = null;
if($url[2][2] == 1 && empty($incorrect_data)){ header('location:koszyk.php'); }
else{ header('location:konto.php'); }
?>