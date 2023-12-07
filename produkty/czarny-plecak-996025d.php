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
<script>


$(".pick_pic").click(function(){
    zdjecie = document.getElementById(this.id);
    const zrodlo = zdjecie.getAttribute("src");
    var glowne_zdjecie = document.getElementById("prod");
    const zmiana_zdjecia = $(glowne_zdjecie).attr('src', zrodlo);
    
});

$('#rozmiar').click(function(){
    $('#rozmiar option').each(function() {
    if($(this).is(':selected')){
        if($(this).val()){
            $('#btnsubmit').prop("disabled", false);
            tekst = $(this).text();
            przerobka = tekst.split("|");
            $('#ilosc_rozmiaru').val(przerobka[1]);
        }
        else{
            $('#btnsubmit').prop("disabled",true);
        }
    }
});
});


</script>
<?php include_once('../dodaj_do_koszyka.php');?>