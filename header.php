<head>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<?php
    $dostep = $_SESSION['dostep'];
    if($dostep > 0){
        echo "<div id='panel'><a href='panel.php' id='zmien_dane'><button id='panel_button'>Panel</button></a></div>";
    }

?>
<header class="naglowek">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="wyszukiwarka.js"></script>

<div class='menu1'>
    <a href="index.php"><img src="svg/logo1.svg" alt="logo" width="100px" height="auto"></a>

</div>

<div class="menu2">
    <img src="svg/search.svg" width="22px" height="22px" alt="U+1f60d">
    <form class="form-wyszukania" action=''>
        <input class="wyszukiwarka" name onfocusin="powieksz_wyszukiwanie()" onfocusout="zmniejsz_wyszukiwanie()" type="text" name='wyszukiwarka' id="wyszukiwarka" onkeyup='wyszukanie(this.value)' placeholder="Szukaj">
    </form>
</div>

<div class='wyloguj'>
<?php
    if( !isset( $_SESSION['email'] ) && empty( $_SESSION['email'] ) ){
        echo "<a href='logowanie.php' id='log_in'><img src='svg/log_in.svg' width='36px' height='36px' alt='zaloguj'></a>";
    }

    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<a href='koszyk.php' id='koszyk'> <img src='svg/shopping_cart.svg' width='36px' height='36px' alt='koszyk'> </a>";
        echo "<a href='konto.php' id='konto'><img src='svg/account.svg' width='36px' height='36px' alt='konto'></a>";
        echo "<form  action='wyloguj.php'  method='POST'>
        <button id='wyloguj'><img src='svg/logout.svg' width='36px' height='36px' alt='&#9032'></button> </form>";
    }
?>
</div>

<script>
wyszukiwarka = document.getElementsByClassName("menu2")[0];
function powieksz_wyszukiwanie(){
    if(window.innerWidth > 1100){ wyszukiwarka.style.transform = "scale(1.1)"; }
    else{ wyszukiwarka.style.transform = "scale(1.04)"; }
}
function zmniejsz_wyszukiwanie(){
    wyszukiwarka.style.transform = "scale(1)";
}
function ustawValue(){
    inpTekst = document.getElementById('wyszukiwarka').value;
    document.getElementById('wyszukiwarka').setAttribute('value', inpTekst);
}
</script>

</header>
<div class='wyniki_wyszukiwania' id="wyniki">
</div>
<br>