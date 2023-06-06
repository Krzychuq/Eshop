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
    <link rel="stylesheet" href="s.css?v=1.2">
    <title>Sesja</title>
</head>
<body>
<?php 
include_once("header.php");
include_once("laczenieZbaza.php");
?>
<main>

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
    <input type="text" maxlength="100" name="kraj" placeholder="..." >

    <label for="opis">Napisz o sobie: </label>
    <textarea name="opis" id="opis" rows="11"  maxlength='372' placeholder="..." style="resize:none;"></textarea>

<?php
    if(isset($_SESSION['wiadomosc_konta'])){
        echo $_SESSION['wiadomosc_konta'];
        unset($_SESSION['wiadomosc_konta']);
    }
?>
    <button id="przycisk_zapisz" type="submit"><img src="svg/save.svg" width='30px' height='30px' alt="Zapisz"></button>

</form>
   
    

</main>
</body>
</html>