<?php session_start();?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css?v=1.2">
    <title>Sesja</title>
</head>
<body>
<?php include_once("header.php");?>
<section class="wrap-sign-up-in">

<form id="formularz" class='zaloguj' action="" method='POST'>
    <div class="divy">
        <p style="font-size:22px;">Wpisz nowe hasło</p>
    </div><br>
<!-- haslo -->
    <div class="divy">
      <label for="pass"><img src="svg/password.svg" width="24px" height="auto" alt="Hasło: "></label>
      <input name='pass' minlength="8" maxlength="32" id="haslo" type="password" placeholder="Hasło" required>
    </div>

<!-- powtorzone haslo -->
    <div class="divy">
      <label for="passp"><img src="svg/password.svg" width="24px" height="auto" alt="Powtórz hasło: "></label>
      <input name='passp' id="haslop" type="password" minlength="8" maxlength="32" placeholder="Powtórz hasło" required>
    </div>
<!-- pokaz haslo -->
    <label for="">Pokaż hasła</label>
    <input type="checkbox" class="pokaz_haslo" onclick="pokazhasla()" width="16" height="16"></input>

    <br>
<!-- wyslij -->
    <button id="przycisksub"  class="przycisk_zaloguj_zarejestruj" type="submit">Zapisz</button>

    <br style="margin-bottom: 1rem; margin-top: 0.3rem;">
<?php
// wyswietl blad
if(isset($_SESSION['wiadomosc_hasla'])){
  echo $_SESSION['wiadomosc_hasla'];
  unset($_SESSION['wiadomosc_hasla']);
  echo "<br>";
}

?>
<!-- wytyczne hasla -->
    <div id="alert_haslo"> 
      <span>&#x1F6C8</span>
      <span>Hasło musi zawierać: wielką literę, długość min 8 znaków i max 32 znaków i jeden znak specjalny !@#$%^&*</span> 
    </div>
    <br>
</form>

</section>
</body>
</html>
<script>

function pokazhasla() {
var haslo = document.getElementById("haslo");
var haslop = document.getElementById("haslop");

  //haslo pokaz
  if (haslo.type === "password" && haslop.type === "password") {
    haslo.type = "text";
    haslop.type = "text";
  } 
  else {
    haslo.type = "password";
    haslop.type = "password";
  }
}

</script>
<?php
if(isset($_POST['pass']) && isset($_POST['passp'])){
    $pass = $_POST['pass'];
    $pass_powtorzone = $_POST['passp'];
    $url = $_SERVER["REQUEST_URI"];
    $ciecie_url = explode("?key=",$url);
    $token_strony = $ciecie_url[1];
    include_once("laczenieZbaza.php");
    $nowe_haslo = password_hash($pass, PASSWORD_ARGON2I);
        unset($_SESSION['email']);
        $patern = "/^(?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z])(?=\D*\d)(?=[^!@#$%^&*]*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,32}$/";
        $weryfikacja_hasla = preg_match($patern, $pass);
        
        if( $pass == $pass_powtorzone){
            if($weryfikacja_hasla == TRUE){
                $pyt1 = "SELECT token_hasla FROM loginy WHERE token_hasla = '$token_strony'";
                $query1 = $conn->query($pyt1);

                if( $query1->num_rows > 0 ){
                    $data_zmiany_hasla = date("Y-m-d H:i:s");
                    $token = substr(sha1(mt_rand()),0,20);
                    //Zmiana hasla, daty i tokenu
                    $pyt2 = "UPDATE loginy SET data_zmiany_hasla = '$data_zmiany_hasla', token_hasla = '$token', pass = '$nowe_haslo' WHERE token_hasla = '$token_strony'";
                    $query2 = $conn->query($pyt2);
                    header("location: logowanie.php");
                }
                else{
                    $_SESSION['wiadomosc_hasla'] = "Sesja przedawniona za 2 sekundy wrócisz do logowania!";
                    header("refresh:2; location:logowanie.php");
                }
             }

             else{
                $_SESSION['wiadomosc_hasla'] = "Hasło nie zgadza się z wytycznymi!";
             }
        }

        else{
            $_SESSION['wiadomosc_hasla'] = "Hasła nie są takie same!";
        }
            
$conn->close();
}
?>