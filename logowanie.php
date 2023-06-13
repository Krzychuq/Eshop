<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css?v=1.2">
    <title>Sesja</title>
</head>
<body>
<?php include_once("header.php")?>
<div class="contener">
<section class="wrap-sign-up-in">
    <form class='zaloguj' action="sign_in.php" method='POST'>
        <div class="divy">
            <label for="email"><img src="svg/email.svg" width="24px" height="auto" alt="Email: "></label>
            <input name='email' type="email" placeholder="Email">
        </div>

        
        <div class="divy">
            <label for="pass"><img src="svg/password.svg" width="24px" height="auto" alt="Hasło: "></label>
            <input name='pass' type="password" placeholder="Hasło">
        </div>

        <br>
        
        <button type='submit' class="przycisk_zaloguj_zarejestruj">Zaloguj się</button>
        <br>
        <?php
            if(isset($_SESSION['wiadomosc_loginu'])){
                echo $_SESSION['wiadomosc_loginu'];
                unset($_SESSION['wiadomosc_loginu']);
            }
        ?>
    </form>
    
    <div class="rejestracja">
        <p style="padding-bottom: 5px;">Nie pamiętasz hasła? <a href="reset_hasla.php"> Kliknij</a></p>
        <p>Nie masz konta? <a href="rejestracja.php"> Zarejestruj się</a></p>
        
        
    </div>
</section>
</div>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>