<?php
include('laczenieZbaza.php');
  $slowo = 'bluza';
  $szukaj1 = $conn->query('SELECT nazwa, cena, zdjecie1 FROM produkty');
  while($wynik = $szukaj1->fetch()){
    $produkty[] = $wynik['nazwa'];
  }

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($produkty as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}

// Output "no suggestion" if no hint was found or output correct values
if($hint === ""){
    echo "Brak dopasowania";
}
else{
    while($wynik = $szukaj1->fetch()){
        $wiersz_produktu = "<div><img src=$wynik[zdjecie1] alt='produkt' width='80px' height='100px'></div><div><p>$hint</p><p>$wynik[cena]</p></div>";
        echo $wiersz_produktu;
    }


}
$conn = null;
?>