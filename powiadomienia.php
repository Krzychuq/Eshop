<?php
if( isset($_SESSION['success']) && isset($_SESSION['error']) ){

    echo "<div class='success' style='bottom: 73px;'>" . "&#10003 ". $_SESSION["success"] . "</div>";
    unset($_SESSION['success']);
    echo "<script src='powiadomienie.js'></script>";

    echo "<div class='error'>" . "&#10005 ". $_SESSION["error"] . "</div>";
    unset($_SESSION['error']);
    echo "<script src='blad.js'></script>";

}
else{
    if( isset($_SESSION['error']) ){
        echo "<div class='error'>" . "&#10005 ". $_SESSION["error"] . "</div>";
        unset($_SESSION['error']);
        echo "<script src='blad.js'></script>";
    }
    if( isset($_SESSION['success']) ){
        echo "<div class='success'>" . "&#10003 ". $_SESSION["success"] . "</div>";
        unset($_SESSION['success']);
        echo "<script src='powiadomienie.js'></script>";
    }
}

?>