<header>

<div class='statusLogowania'>
<?php
include_once("laczenieZbaza.php");
if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
    
    //wyswietlanie email lub nicku użytkownika
    if(!empty($_SESSION['nickname'])){
        echo '<span>Zalogowano jako '. $_SESSION['nickname'] ."</span>";
    }
    else{
        echo '<span>Zalogowano jako '. $_SESSION['email'] ."</span>";
    }
}
?>
</div>

<div class="menu">
    
    <a href="index.php" class="linki">Strona główna</a>
<?php
    if( !isset( $_SESSION['email'] ) && empty( $_SESSION['email'] ) ){
        echo "<a href='logowanie.php' class='linki'>Zaloguj</a>";
    }

    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<a href='konto.php' class='linki'>Twoje konto</a>";
    }
?> 

</div>
<div class='wyloguj'>
<?php
    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<form  action='wyloguj.php'  method='POST'>
                <button id='wyloguj'><img src='svg/logout.svg' width='30px' height='30px' alt='&#9032'></button> </form>";
    }
?>
</div>




</header>
<br>