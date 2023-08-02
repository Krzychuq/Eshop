<?php
session_start();
    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email']) ){
        if($_SESSION['dostep'] !== 1){
            header("location: index.php");
        }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Sesja</title>
</head>
<body>
<header class="naglowek">
<?php include_once("laczenieZbaza.php");?>
<div class='menu1'>
    <a href="index.php"><img src="svg/logo1.svg" alt="logo" width="100px" height="auto"></a>
</div>
<div class='wyloguj'>
    <a href="panel.php" id='wiadomosc'><img src="svg/panel.svg" alt="panel" width="36px" height="36px"></a>
<?php

    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<a href='konto.php' id='konto'><img src='svg/account.svg' width='36px' height='36px' alt='konto'></a>";
    }

    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email'] ) ){
        echo "<form  action='wyloguj.php'  method='POST'>
                <button id='wyloguj'><img src='svg/logout.svg' width='36px' height='36px' alt='&#9032'></button> </form>";
    }
?>
</div>

</header>
<br>
<div class="contener">
<div class="menu_panelu">

<div class="panel" id="panel4">
    <!-- Lista produktów -->
    <div class="lista_produktow">
    <h3 id="p5">Wiadomości klientów</h3>
    <button class="button_refresh" onClick="window.location.reload();"><img src="svg/refresh.svg" alt="&#10227" width="20px" height="20px"></button>
    </div>
    <table class="tabela_produktow">
        <tr>
            <th>ID</th>
            <th>Imie</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Nr zamówienia</th>
            <th>Wiadomość</th>
            <th></th>
        </tr>
<?php
$pyt_wiadomosci = $conn->query("SELECT * FROM wiadomosci_klientow")->fetchAll();
$id_maila = 0;

$usun = $conn -> prepare('DELETE FROM wiadomosci_klientow WHERE id = ?');

foreach($pyt_wiadomosci as $linia){  

    $mailID = "klik" . $id_maila;
    echo "<tr>";
    echo "<td>" . $linia["id"] . "</td>";
    echo "<td>" . $linia["imie"] . "</td>";
    echo "<td>" . $linia["nazwisko"] . "</td>";
    echo "<td>" . "<button  class=klik id=$mailID data-em = '$linia[email]' style='border:none; background: transparent; font-weight:bold; font-size:14px; cursor:pointer; color: green;'>" . $linia["email"] . "</button>" . "</td>";
    echo "<td>" . $linia["nr_zamowienia"] . "</td>";
    echo "<td>" . $linia["wiadomosc"] . "</td>";
    echo "<td>" . "<form method='POST'>" . "<button name=".$mailID." onclick=usun() class=przycisk_usun_mały >Usuń</button>" . "</form>" . "</td>"; //do zrobienia
    echo "</tr>";
    if(isset($_POST[$mailID])) {
        $usun -> execute([$linia["id"]]);
        header("Refresh:0");
    }
    $id_maila += 1;
}
echo "</table>";
?>
</div>

</div>
<div class="modal" id="popup">
<div class="dymek">
    <span class="close_button">&times;</span>

    <form action="wyslij_wiadomosc_email_klientowi.php" method="POST" class="form_dymek">
    <label for="email">Email klienta</label>
    <input type="email" name="email" value="" placeholder="..." id="input_mail">
    <label for="tekst">Wiadomość</label>
    <textarea name="tekst" style="min-height:100px; resize: vertical;" maxlength="1100" placeholder="Napisz wiadomość zwrotną"></textarea>
    <div>
        <button type="submit" class="przycisk_zaloguj_zarejestruj">Wyślij</button>
    </div>
    </form>
</div>
</div>

</div>
<?php 
if(isset($_SESSION['error'])){
    echo "<div class='error'>" . "&#10005 ". $_SESSION["error"] . "</div>";
    unset($_SESSION['error']);
    echo "<script src='blad.js'></script>";
}
if(isset($_SESSION['success'])){
    echo "<div class='success'>" . "&#10003 ". $_SESSION["success"] . "</div>";
    unset($_SESSION['success']);
    echo "<script src='powiadomienie.js'></script>";
}
$conn = null;
?>
</body>
</html>
<script>
    function usun(){
        return confirm('Potwierdź');
    }
    // Get the modal
    var modal = document.getElementById("popup");

    // Get the button that opens the modal
    $(".klik").click(function(){
    var btn = $(this).attr("id");

    var email = $(this).attr("data-em");
    document.getElementById("input_mail").value = email;
    document.getElementById("input_mail").innerHTML = email;
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close_button")[0];

    // When the user clicks the button, open the modal 
    modal.style.display = "block";

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
    });
</script>
