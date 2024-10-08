<?php
session_start();
    if( isset( $_SESSION['koszyk'] ) && !empty( $_SESSION['koszyk']) && !isset( $_SESSION['email'] ) && empty( $_SESSION['email'])){
        header("location: logowanie.php");
    }
    elseif( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        // nic
    }
    else{
        header("location: koszyk.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="s.css?v=1.1">
    <title>Sesja</title>
</head>
<body>
<div class="contener">
<?php include_once("header.php");?>
<?php include_once("laczenieZbaza.php");?>

<div class="order">

<!-- header -->
<div class="order_naglowek">
    <p>Podsumowanie</p>
</div>

<!-- Lewa -->
<div class="left_order">
 
<section class="left_item_order_checkout">
    <div class='title'><span>Twoje dane</span></div>
<?php

$pyt = $conn -> prepare("SELECT dane_konta.imie,dane_konta.nazwisko,dane_konta.ulica,dane_konta.nr_domu,dane_konta.nr_tel,dane_konta.miasto,dane_konta.kod_pocztowy,dane_konta.kraj, dane_do_faktury.NIP,dane_do_faktury.nazwa_firmy,dane_do_faktury.adres,dane_do_faktury.kod_pocztowy,dane_do_faktury.miasto,dane_do_faktury.kraj FROM loginy
INNER JOIN dane_konta on dane_konta.id_loginu = loginy.id
INNER JOIN dane_do_faktury on dane_do_faktury.id_konta = dane_konta.id_loginu
WHERE loginy.login = ?;");
$pyt -> execute(["$_SESSION[email]"]);

$wynik = $pyt->fetch(PDO::FETCH_NUM);

// *Sprawdza czy użytkownik ma podstawowe dane, jeśli nie, musi wprowadzic
// 0=imie | 1=nazwisko | 2=ulica | 3=nr_domu | 4=nr_tel | 5=miasto | 6=kod_pocztowy | 7=kraj 
// 8=NIP | 9=nazwa_firmy | 10=adres | 11=kod_pocztowy (firmowy) | 12=miasto (firmowy) | 13=kraj (firmowy) 
if(is_null($wynik[0]) || is_null($wynik[1]) || is_null($wynik[2]) || is_null($wynik[3]) || is_null($wynik[4]) || is_null($wynik[5]) || is_null($wynik[6]) || is_null($wynik[7]) ){header("location: edytuj_konto.php?dane=1");}

    echo "<div class='name'><p>".$wynik[0]. " " . $wynik[1] . " " . $wynik[4]."</p></div>";
    echo "<div class='address'><p>".$wynik[2]. " " . $wynik[3] . ", " . $wynik[6] . " " . $wynik[5] ."</p></div>";
?>
</section>

<?php
if(!is_null($wynik[8])){
    echo "<section class='left_item_order_checkout'> <div class='title'><span>Dane do fakturki</span></div>";

    echo "<div class='name'><p>".$wynik[9]. "</p><p>". " NIP " . $wynik[8] ."</p></div>";
    echo "<div class='address'><p>".$wynik[10]. ", " . $wynik[11] . " " . $wynik[12] . " " . $wynik[13] . "</p></div>";

    echo "</section>";
}
if(isset($_POST["kurier"])){
    $kurier = explode("/",$_POST["kurier"]);
    $kurier = $kurier[0];
}

// !null
  $conn = null;
?>

<section class="left_item_order_checkout_options">
    <div class='title'><span>Dostawa</span></div>
    <div class='checkout_choice_main'>
        <div class='checkout_choice_left'>
            <input type="radio" name='dostawa' id='inpost_paczkomat' class='custom_radio'>
            <!-- <span class='custom_radio'></span> -->

        </div>
        <div class='checkout_choice_img'>
            <img src='photos/inpost_paczkomat.png' alt='tytul' width='130px' height='auto'>
        </div>
        <div class='checkout_choice_right'>
            <p>tytul</p>
            <p> 2-4 dni roboczych</p>
            <p>10,99 PLN</p>
        </div>
        <div class='checkout_choice_bottom'>
            <div class='left_item_order_checkout_options_title'><h4>Wybierz punkt</h4></div>
            <p class='name'>Paczkomat XYZ</p>
            <p class='address'>ulica 1/1, 11-111 miasto</p>
            <button>Zmień</button>
        </div>



    </div>
</section>

<section class="left_item_order_checkout_options">
    <span>Płatność</span>
    <ul>
        <li>BLIK</li>
        <li>Szybki przelew</li>
        <li>Karta</li>
        <li>Google Pay</li>
        <li>PayPo</li>
        <li>PayPal</li>
    </ul>
</section>

</div>
<!-- /Lewa -->
    <!-- ///////////////////////////// -->
<!-- Prawa -->
<div class='right_order'>

<form action='' method='POST'>
<div>
    <br><p>Koszt dostawy: <span id=koszt_dostawy><?php echo $kurier; ?></span> zł</p>
    <p>Łączny koszt: <span id='suma'><?php echo $_POST["suma"]; ?></span> zł</p>
    <input type='hidden' id='koszt_calkowity' name='suma' value='<?php echo $_POST["suma"]; ?>'>

    <div class='kup' style='text-align: center;'>
        <button class='button_podsumowanie' type='submit' disabled>Kupuje i płacę</button>
        <p>Klikając w przycisk „Kupuję i płacę” złożysz zamówienie. Kontynuując zgadzasz się z 
            <a href="regulamin.html"><b>Regulaminem</b></a>
        sklepu.</p>
    </div>
</div>
</form>

</div>


<!-- /Prawa -->



</div>

<!-- \\\\\\\\\\\\\\\\\\\\\\| Powiadomienia |///////////////////// -->
<?php include_once("powiadomienia.php");?>
<!-- \\\\\\\\\\\\\\\\\\\\\\| /Powiadomienia |///////////////////// -->


<footer>
    <?php include_once("footer.html"); ?>
</footer>
<?php $conn=null;?>
</body>
</html>