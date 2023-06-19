<?php
include_once('laczenieZbaza.php');
$produkty = array();
$szukaj1 = $conn->query('SELECT nazwa,cena,zdjecie FROM produkty')->fetchAll();
foreach($szukaj1 as $linia){
    $produkt = array($linia['nazwa'],$linia['cena'],$linia['zdjecie']);
    array_push($produkty,$produkt);
}

// get the q parameter from URL
$q = $_REQUEST["q"];

$nazwa = "";
$cena = "";
$zdj = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len =strlen($q);
  for($row = 0; $row < count($produkty); $row++){
    for($col = 0; $col < 3; $col++){
        if(stristr($q, substr($produkty[$row][$col], 0, $len))){
            if($nazwa === ""){
              $nazwa = $produkty[$row][0];
              $cena = $produkty[$row][1];
              $zdj = $produkty[$row][2];
              echo $nazwa === "" ? "Brak dopasowania" : $zdj . " " . $nazwa . " " . $cena . "<br>";
            } 
        }
    }
  }
  
}
// print_r($produkty);
$conn = null;
?>