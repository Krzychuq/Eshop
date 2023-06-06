<?php
session_start();
include_once("laczenieZbaza.php");
$email = $_POST['email'];
$pass = $_POST['pass'];
$pytanieEmail = "SELECT pass FROM loginy WHERE login like '$email'";
$czasZalogowania = date("Y-m-d H:i:s");
$userLog = "UPDATE loginy set ostatnie_logowanie = '$czasZalogowania' WHERE login like '$email'";
$pass_baza = $conn->query($pytanieEmail);
$log = $conn->query($userLog);

if($pass_baza->num_rows > 0){
        while($linia = $pass_baza->fetch_assoc()) {
                $hash = $linia['pass'];
        }
}

$validation = password_verify($pass, $hash);

        if($validation == true){
                $_SESSION['email'] = $email;

                //identyfikacja
                $mail = $_SESSION['email'];
                $pyt_o_id="SELECT id FROM loginy WHERE login like '$mail'";
                $wykonanie = $conn->query($pyt_o_id);

                if($wykonanie->num_rows > 0){
                        while($linia = $wykonanie->fetch_assoc()) {
                                $id = $linia['id'];
                        }
                }
                //dane konta
                $pyt_o_dane = "SELECT * FROM dane_konta WHERE id_loginu = '$id'";
                $dane = $conn->query($pyt_o_dane);
                if($dane->num_rows > 0){
                        while($linia = $dane->fetch_assoc()) {
                                $nick = $linia['nazwa'];
                        }
                }
                $_SESSION['nickname'] = $nick;
                // $sesja = $_SESSION['email'];
                // $czas_sesji = time() + ();
                // setcookie($sesja,"/");
                header("location: index.php");
        }
        else{
                $_SESSION['wiadomosc_loginu'] = "Błedny email lub hasło!";
                header("location: logowanie.php");
        }
$conn->close();
?>