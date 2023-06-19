<?php
session_start();
include_once("laczenieZbaza.php");
$login = $_POST['login'];
$pass = $_POST['pass'];
$powtorzone_pass = $_POST['passp'];
$password = password_hash($pass, PASSWORD_ARGON2I);
if( isset($login) && !empty($login) && isset($pass) && !empty($pass) ){
    unset($_SESSION['email']);
    $patern = "/^(?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z])(?=\D*\d)(?=[^!@#$%^&*]*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,32}$/";
    $weryfikacja_hasla = preg_match($patern, $pass);
    
    if( $pass == $powtorzone_pass){
        if($weryfikacja_hasla == TRUE){
        $l="";
        $data = date("Y-m-d H:i:s");
        $czas_rejestracji = $data;
        $sprawdzenie = $conn -> prepare('SELECT login from loginy where login like ?');
        $sprawdzenie -> execute([$login]);
        $wykonaj_sprawdzenie = $sprawdzenie -> fetchColumn();
        if($wykonaj_sprawdzenie){ 
                $l = $wykonaj_sprawdzenie;
        }   
         if($login == $l){
            $_SESSION['wiadomosc_loginu'] = "Email jest zajety";
             header("location: logowanie.php");
             $conn = null;
         }
    
         else{
            $zapytanie1 = $conn -> prepare("INSERT INTO loginy (login, pass, data_rejestru) VALUES(?, ?, ?)");
            $zapytanie1 -> execute([$login, $password, $czas_rejestracji]);
        
             if ($zapytanie1 === TRUE) {
                 echo $login." ". $password. " ". $czas_rejestracji;
             } 
             else {
                 echo "Błąd tworzenia konta";
             }
            
                $zapytanie2 = $conn -> prepare("SELECT id FROM loginy WHERE login LIKE ?");
                $zapytanie2 -> execute([$login]);
                if($zapytanie2){
                    foreach($zapytanie2 as $linia){
                        $id_login = $linia['id'];
                    }
                }
                $dostep = 0;
                $zapytanie3 = $conn -> prepare("INSERT INTO dane_konta (id_loginu, dostep) VALUES(?,?)");
                $zapytanie3 -> execute([$id_login,$dostep]);

             if ($zapytanie3 === FALSE) {
                 echo "Błąd dodania konta";
             } 
            
             $conn = null;
             header("location: logowanie.php");
         }
        }
        else{
            $_SESSION['wiadomosc_rejestracji'] = "Hasło nie zgadza się z wytycznymi!";
            header("location: rejestracja.php");
        }
        
    }

    else{
        $_SESSION['wiadomosc_rejestracji'] = 'Hasła nie są takie same!';
        header("location: rejestracja.php");
    }
    
}

else{
    $_SESSION['wiadomosc_rejestracji'] = 'Wpisz email i hasło!';
    header("location: rejestracja.php");
}
?>