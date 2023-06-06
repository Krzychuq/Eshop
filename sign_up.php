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
        $data = date("Y-m-d H:i:s");
        $czas_rejestracji = $data;
        $l="";
        $sprawdzenie = "SELECT login from loginy where login like '$login'";
        $wykonaj_sprawdzenie= $conn->query($sprawdzenie);
        if($wykonaj_sprawdzenie ->num_rows > 0){
    
            while($linia = $wykonaj_sprawdzenie->fetch_assoc()) {
                    $l = $linia['login'];
            }
        }
         if($login == $l){
            $_SESSION['wiadomosc_loginu'] = "Email jest zajety";
             header("location: logowanie.php");
             $conn->close();
         }
    
         else{
             $zapytanie1 = "INSERT INTO loginy (login, pass, data_rejestru) VALUES('$login', '$password', '$czas_rejestracji')";
             $rejestracja = $conn->query($zapytanie1);
        
             if ($rejestracja === TRUE) {
                 echo $login." ". $password. " ". $czas_rejestracji;
             } 
             else {
                 echo "Błąd: " . $zapytanie1 . "<br>" . $conn->error;
             }
            
             $zapytanie2 = "SELECT id from loginy where login like '$login'";
             $id = $conn->query($zapytanie2);
             if($id ->num_rows > 0){
        
                 while($linia = $id->fetch_assoc()) {
                         $id_login = $linia['id'];
                 }
             }
        
             $zapytanie3 = "INSERT INTO dane_konta (id_loginu) VALUES('$id_login')";
        
             $dodajID = $conn->query($zapytanie3);
             if ($dodajID=== FALSE) {
                 echo "Błąd: " . $zapytanie3 . "<br>" . $conn->error;
             } 
            
             $conn->close();
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