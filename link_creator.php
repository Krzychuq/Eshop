<?php
// This code create links for products. Whenever domain get change, it wont interfer with link

$splitUrl= explode("/",$_SERVER['PHP_SELF']);
//confirm url if has produkty page
if(in_array("produkty",$splitUrl)){
// create link product
    $urlP = strtolower($wynik['nazwa'])."-".$wynik['indeks_produktu'].".php";
}
else{
    $urlP = "produkty/".strtolower($wynik['nazwa'])."-".$wynik['indeks_produktu'].".php";
}
//rm current page
array_pop($splitUrl);

array_push($splitUrl, $urlP);
$link = implode("/",$splitUrl);
// activate
// include("link_creator.php");
?>