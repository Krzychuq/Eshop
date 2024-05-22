<?php
$indeks1 = explode("/", $_SERVER["REQUEST_URI"]);
$indeks2 = explode('.php',$indeks1[3]);
$indeks3 = explode('-',$indeks2[0]);
$pyt_prod= $conn -> prepare('SELECT nazwa,cena,ilosc,opis,zdjecie FROM produkty WHERE indeks_produktu like ?');
$indeks_produktu = end($indeks3);
$pyt_prod->execute([$indeks_produktu]);
$dane = $pyt_prod->fetch();
$pyt_rozmiar= $conn -> prepare('SELECT rozmiary_produktow.rozmiar, rozmiary_produktow.ilosc FROM rozmiary_produktow inner join produkty on rozmiary_produktow.id_produktu = produkty.id WHERE produkty.indeks_produktu like ? ORDER BY RIGHT (rozmiary_produktow.rozmiar,1) desc');
$pyt_rozmiar->execute([$indeks_produktu]);
$nazwa_prod = str_replace('-', ' ', $dane["nazwa"]);
$zdjecia_array = explode(",", $dane["zdjecie"]);
?>

<div class='contener'>

<div class='grid_produkt'>
    <div id='div2'>
        <!-- zdjecia do wyboru produktu -->
            <?php 
            if($dane["zdjecie"] != NULL){
                for($i=0; $i < sizeof($zdjecia_array); $i++){
                    $zdjecie_prod = "../zdjecia_produktow/" . $zdjecia_array[$i];
                    echo "<img class='pick_pic' src='$zdjecie_prod' id=prod$i style='width:auto; height:auto; max-width: 100px;' alt=zdjecie/produktu".$i.">";
                }  
            }
            else{
                echo "<img class='pick_pic' src='' id=prod1 style='width:auto; height:auto; max-width: 100px;' alt=brak_zdjecia>";
            }

            ?>
    </div>
    
    <div id='div1'>
    <!-- zdjecie głowne produktu -->
        <?php echo "<img src='". "../zdjecia_produktow/" .$zdjecia_array[0]. "' id=prod alt=zdjecie/produktu>"; ?>
    </div>

    <div id="div3">
    <!-- info -->
        <?php
        echo "<form action='' method=POST>";
        echo "<input id='ilosc_rozmiaru' name=ilosc_rozmiaru value=' ' type=hidden>";
        echo "<input name=indeks value=$indeks_produktu type=hidden>";
        echo "<p id=nazwa>".ucfirst($nazwa_prod)."</p>";
        echo "<p name=cena id=cena>".$dane["cena"]. " zł</p>";
        echo "<p name=ilosc id=ilosc>Dostepna ilość: ".$dane["ilosc"]."</p>";
        echo "<span>Rozmiary</span> "."<select id=rozmiar name=rozmiar >";
        echo "<option value=''>Wybierz</option>";
        while ($rozmiar = $pyt_rozmiar->fetch()) {
            echo "<option value=".$rozmiar["rozmiar"].">".$rozmiar["rozmiar"]. " |". $rozmiar["ilosc"] . "|".'</option>';
        }

        echo "</select>";
        echo "<button  class='button_kup'  name='btnsubmit' type=submit onclick='add_to_cart()' id='btnsubmit' disabled>Kup teraz</button></form>";
        ?>
    </div>

    <div id="div4">
    <!-- opis -->
        <?php
        echo "<h2>Opis produktu</h2><br>";
        echo "<p style=padding:1%; font-family:Segoe UI;>".$dane["opis"]."</p>";
        $conn = null;
        ?>
    </div>
</div>