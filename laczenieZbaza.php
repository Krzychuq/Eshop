<?php
$hostname='localhost';
$username='root';
$pass='';
$bazaD ='shop';

$conn = new mysqli($hostname, $username, $pass, $bazaD);

if ($conn->connect_error) {
    die("Połączenie sie nie powiodło: " . $conn->connect_error);
}


?>