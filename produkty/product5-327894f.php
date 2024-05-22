<?php
session_start();
?>
<!DOCTYPE html>
<html lang='pl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="../flickity.min.js"></script>
    <link rel='stylesheet' href='../s.css?v1.2'>
    <title>Sesja</title>
</head>
<body>
<?php 
include_once('../header_produkty.php');
include_once('../laczenieZbaza.php');
include_once('../produkt.php');
?>

<?php include_once('../podobne_produkty.php');?>

</div>
<footer>
    <?php include_once('../footer_produkty.html'); $conn = null;?>
</footer>
</body>
</html>
<script src='skrypt_produktu.js'></script>
<?php include_once('../dodaj_do_koszyka.php');?>