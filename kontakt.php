<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css?v1.3">
    <title>Sesja</title>
</head>
<body>
<?php 
include_once("header.php");
include_once("laczenieZbaza.php");
?>

<div class="contener">
<div class="kontakt">
    <h2 style="text-align:center;">Obsługa klienta</h2>
    <br>
    <form class="grid_kontakt" action="wyslij_wiadomosc.php" method="post">

        <div>
        <label for="imie">Imię</label>
        <input style="width:90%;" type="text" name="imie">
        </div>
        <div>
        <label for="nazwisko">Nazwisko</label>
        <input style="width:90%; text-align:right;" type="text" name="nazwisko">
        </div>
        <div>
        <label for="email">Email</label>
        <input type="text" name="email">
        </div>
        <div>
        <label for="zamowienie">Numer zamówienia</label>
        <input style="text-align:right;" type="text" name="zamowienie">
        </div>
<br>
    <div id="wiad">
        <label for="wiadomosc">Treść wiadomości</label>
        <textarea name="wiadomosc" maxlength="1100" style="resize:none; width:100%; height:300px;"></textarea>
    </div>

    <button type="submit">Wyślij</button>

    </form>
</div>

</div>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>
<script>
    
</script>