<?php
session_start();
include_once("laczenieZbaza.php");
$email = $_POST['email'];
$pass = $_POST['pass'];
$pytanieEmail = $conn->prepare('SELECT pass FROM loginy WHERE login like ?');
$pytanieEmail->execute([$email]);
$pass_baza = $pytanieEmail->fetch(PDO::FETCH_ASSOC);
$hash = $pass_baza['pass'];
$czasZalogowania = date("Y-m-d H:i:s");
$userLog = $conn->prepare('UPDATE loginy SET ostatnie_logowanie = ? WHERE login LIKE ?');
$userLog->execute([$czasZalogowania, $email]);

$validation = password_verify($pass, $hash);

        if($validation == true){
                $_SESSION['email'] = $email;

                //identyfikacja
                $mail = $_SESSION['email'];
                $pyt_o_id = $conn->prepare("SELECT id FROM loginy WHERE login like ?");
                $pyt_o_id -> execute([$mail]);
                $wykonanie = $pyt_o_id->fetch(PDO::FETCH_ASSOC);
                $id = $wykonanie['id'];

                //dane konta
                $pyt_o_dane = $conn->prepare("SELECT nazwa, dostep FROM dane_konta WHERE id_loginu = ?");
                $pyt_o_dane -> execute([$id]);
                $wykonanie = $pyt_o_dane->fetchAll();
                foreach ($wykonanie as $linia){
                        $nick = $linia['nazwa'];
                        $dostep = $linia['dostep'];
                }

                $_SESSION['nickname'] = $nick;
                $_SESSION['dostep'] = $dostep;
                // $sesja = $_SESSION['email'];
                // $czas_sesji = time() + ();
                // setcookie($sesja,"/");
                header("location: index.php");
        }
        else{
                $_SESSION['wiadomosc_loginu'] = "Błedny email lub hasło!";
                header("location: logowanie.php");
        }
$conn = null;
?>