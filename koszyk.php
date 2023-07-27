<?php
session_start();

foreach($_SESSION['koszyk'] as $kod => $rozmiar) {
    if(!empty($kod)){
        
    }
  }
print_r($_SESSION['koszyk']);
// echo $_SESSION['koszyk']['996025d'][0];


?>