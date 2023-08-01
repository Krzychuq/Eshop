<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['expire']);
unset($_SESSION['koszyk']);
unset($_SESSION['dostep']);
session_destroy();
header("location: index.php");
?>