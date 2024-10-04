<?php
if(isset($_POST['pass']) && isset($_POST['passp'])){
    session_start();
    $goBack = $_POST['siteback'];
    $haslo = $_POST['pass'];
    $pass_powtorzone = $_POST['passp'];
    $url = $_SERVER["REQUEST_URI"];
    $ciecie_url = explode("?key=",$url);
    $token_strony = $ciecie_url[1];
    include_once("laczenieZbaza.php");
    $nowe_haslo = password_hash($haslo, PASSWORD_ARGON2I, );
        unset($_SESSION['email']);
        $patern = "/^(?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z])(?=\D*\d)(?=[^!@#$%^&*]*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,32}$/";
        $weryfikacja_hasla = preg_match($patern, $haslo);
        
        if($weryfikacja_hasla == TRUE){
        if( $haslo == $pass_powtorzone ){
                $pyt1 = $conn->prepare("SELECT token_hasla FROM loginy WHERE token_hasla = ?");
                $pyt1 -> execute([$token_strony]);
                $pyt1_liczba = $pyt1 -> fetchColumn();

                if($pyt1_liczba){
                    echo 1;
                    $data_zmiany_hasla = date("Y-m-d H:i:s");
                    $token = substr(sha1(mt_rand()),0,20);
                    //Zmiana hasla, daty i tokenu
                    $pyt2 = $conn->prepare("UPDATE loginy SET data_zmiany_hasla = ?, token_hasla = ?, pass = ? WHERE token_hasla = ?");
                    $pyt2 -> execute([$data_zmiany_hasla, $token, $nowe_haslo, $token_strony]);
                    header("location: logowanie.php");
                }
                else{
                    $_SESSION['error'] = "Sesja przedawniona!";
                    header("location:logowanie.php");
                }
             }

             else{
              $_SESSION['wiadomosc_hasla'] = "Hasła nie są takie same! ";
              header("location:$goBack");
             }
        }

        else{
          $_SESSION['wiadomosc_hasla'] = "Hasło nie zgadza się z wytycznymi!";
          header("location:$goBack");
        }
$conn = null; 
}
?>