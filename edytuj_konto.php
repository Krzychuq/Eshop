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

<form action="zapis_danych_konta.php" class="form_konta" enctype="multipart/form-data" method="POST">

    <label for="nazwa">Wpisz swój nick: </label>
    <input type="text" maxlength="50" name="nazwa" placeholder="..." >

    <label for="photo">Zmień zdjęcie profilowe:</label>
    <input type="file" name="photo">

    <label for="">Kiedy się urodziłeś? </label>
    <input type="date" name="data_uro">

    <label for="tel">Podaj numer telefonu: </label>
    <input type="tel" pattern="[0-9]{9}" maxlength="9" placeholder="np. 123456789" name="tel">

    <label for="miasto">Podaj z jakiego miasta jesteś: </label>
    <input type="text" maxlength="100" name="miasto" placeholder="..." >

    <label for="kraj">Podaj swoją narodowość: </label>
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
    </select>

    <label for="opis">Napisz o sobie: </label>
    <textarea name="opis" id="opis" rows="11"  maxlength='372' placeholder="..." style="resize:none;"></textarea>
    <button id="przycisk_zapisz" type="submit"><img src="svg/save.svg" width='30px' height='30px' alt="Zapisz"></button>

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