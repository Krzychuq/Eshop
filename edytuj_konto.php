<?php
session_start();
        if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email']) ){
            //nic
        }
        else{
            header("location: index.php");
        }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css?v1.1">
    <title>Sesja</title>
</head>
<body>
<?php 
include_once("header.php");
include_once("laczenieZbaza.php");
?>
<div class="contener">

<form action="zapis_danych_konta.php" class="form_konta" method="POST">

    <label for="imie">Imie: </label>
    <input type="text" maxlength="50" name="imie" placeholder="..." >

    <label for="nazwisko">Nazwisko: </label>
    <input type="text" name="nazwisko">

    <label for="kod_pocztowy">Kod pocztowy: </label>
    <input type="text" name="kod_pocztowy">

    <label for="tel">Podaj numer telefonu: </label>
    <input type="tel" pattern="[0-9]{9}" maxlength="9" placeholder="np. 123456789" name="tel">

    <label for="miasto">Miasto: </label>
    <input type="text" maxlength="100" name="miasto" placeholder="..." >

    <label for="kraj">Kraj: </label>
    <select type="text" maxlength="100" name="kraj">
        <option value="">...</option>
    <?php
    $file = fopen("kraje.txt", "r");
    while(! feof($file)) {
      $line = fgets($file);
      echo "<option value=$line>$line</option>";
    }
    
    fclose($file);
    ?>
    </select><br>
    <button type="submit" style="font-size: 19px;">Zapisz</button>

</form>

</div>
<?php 
if(isset($_SESSION['wiadomosc_konta'])){
    echo "<div class='error'>" . "&#10005 ". $_SESSION["wiadomosc_konta"] . "</div>";
    unset($_SESSION['wiadomosc_konta']);
}
?>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>