<header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class='menu1'>
    <a href="index.php"><img src="svg/logo1.svg" alt="logo" width="100px" height="auto"></a>

</div>

<div class="menu2">
    <form class="form-wyszukania">
        <input class="wyszukiwarka" type="text"  id="wyszukiwarka" onkeyup="wyszukanie(this.value)" placeholder="Wyszukaj...">
        <div>
            <p id="wyniki"></p>
        </div>
    </form>
</div>
<div class='wyloguj'>
<?php
    if( !isset( $_SESSION['email'] ) && empty( $_SESSION['email'] ) ){
        echo "<a href='logowanie.php' class='linki'>Zaloguj</a>";
    }

    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<a href='konto.php' id='konto'><img src='svg/account.svg' width='30px' height='30px' alt='konto'></a>";
    }

    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<form  action='wyloguj.php'  method='POST'>
                <button id='wyloguj'><img src='svg/logout.svg' width='30px' height='30px' alt='&#9032'></button> </form>";
    }
?>
</div>
<script>
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
    xmlhttp.open("GET", "wyszukiwarka.php?q=" + str);
    xmlhttp.send();
    }
}


</script>

</header>
<br>