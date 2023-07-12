<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css?v1.2">
    <title>Sesja</title>
</head>
<body>
<?php 
include_once("header.php");
include_once("laczenieZbaza.php");
?>

<div class="contener">
<div class="kontakt">
    <h3 style="text-align:center;">Zapisz sie do newslettera</h3>
    <br>
    <form class="grid_kontakt" style="display:block;" action="newsletter.php" method="POST">
        <div>
        <label for="imie">Twój email</label>
        <input style="width:100%;" type="email" name="email">
        </div>
<br>
    <button type="submit" style="margin-left: auto; margin-right: auto;" class="przycisk_zaloguj_zarejestruj">Zapisz się</button>

    </form>
</div>
<?php
if(isset($_SESSION['error'])){
    echo "<div class='error'>" . "&#10005 ". $_SESSION["error"] . "</div>";
    unset($_SESSION['error']);
    echo "<script src='blad.js'></script>";
}
if(isset($_SESSION['success'])){
    echo "<div class='success'>" . "&#10003 ". $_SESSION["success"] . "</div>";
    unset($_SESSION['success']);
    echo "<script src='powiadomienie.js'></script>";
}
?>
</div>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>