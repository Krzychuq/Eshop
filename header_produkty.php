<header class="naglowek">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class='menu1'>
    <a href="../index.php"><img src="../svg/logo1.svg" alt="logo" width="100px" height="auto"></a>

</div>

<div class="menu2">
    <img src="../svg/search.svg" width="22px" height="22px" alt="U+1f60d">
    <form class="form-wyszukania">
        <input class="wyszukiwarka" onfocusin="powieksz_wyszukiwanie()" onfocusout="zmniejsz_wyszukiwanie()" type="text"  id="wyszukiwarka" onkeyup="wyszukanie(this.value)" placeholder="Szukaj">
    </form>
    <div>
        <p id="wyniki"></p>
    </div>
</div>
<div class='wyloguj'>
<?php
    if( !isset( $_SESSION['email'] ) && empty( $_SESSION['email'] ) ){
        echo "<a href='logowanie.php' id='log_in'><img src='svg/log_in.svg' width='36px' height='36px' alt='zaloguj'></a>";
    }

    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<a href='../konto.php' id='konto'><img src='../svg/account.svg' width='36px' height='36px' alt='konto'></a>";
    }

    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<form  action='../wyloguj.php'  method='POST'>
                <button id='wyloguj'><img src='../svg/logout.svg' width='36px' height='36px' alt='&#9032'></button> </form>";
    }
?>
</div>
<script>
wyszukiwarka = document.getElementsByClassName("menu2")[0];

function powieksz_wyszukiwanie(){
    wyszukiwarka.style.transform = "scale(1.1)";
}
function zmniejsz_wyszukiwanie(){
    wyszukiwarka.style.transform = "scale(1)";
}
function wyszukanie(str) {
    if (str.length == 0){
    document.getElementById("wyniki").innerHTML = "";
    return;
    } 
    else{
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
        document.getElementById("wyniki").innerHTML = this.responseText;
        }
    xmlhttp.open("GET", "../wyszukiwarka.php?q=" + str);
    xmlhttp.send();
    }
}


</script>

</header>
<br>