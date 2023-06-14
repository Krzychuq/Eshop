<header>

<div class='menu1'>
    <a href="index.php"><img src="svg/logo1.svg" alt="logo" width="100px" height="auto"></a>

</div>

<div class="menu2">
    <input type="text" placeholder="Wyszukaj..." >
<?php
    if( !isset( $_SESSION['email'] ) && empty( $_SESSION['email'] ) ){
        echo "<a href='logowanie.php' class='linki'>Zaloguj</a>";
    }
?> 

</div>
<div class='wyloguj'>
<?php


    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<a href='konto.php'><img src='svg/account.svg' width='30px' height='30px' alt='konto'></a>";
    }

    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<form  action='wyloguj.php'  method='POST'>
                <button id='wyloguj'><img src='svg/logout.svg' width='30px' height='30px' alt='&#9032'></button> </form>";
    }
?>
</div>




</header>
<br>