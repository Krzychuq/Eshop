<?php
session_start();
    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email']) ){
        //nic
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
    <link rel="stylesheet" href="s.css?v=1.3">
    <title>Sesja</title>
</head>
<body>
<div class="contener">
<?php include_once("laczenieZbaza.php");?>
<div style="text-align:center; margin-bottom:20px;">
    <a href="index.php"><img src="svg/logo1.svg" alt="logo" width="100px" height="auto"></a>
</div>
<div class="menu_panelu">

<div class="panel" id="panel1">
    <!-- Dodaj produkt -->
    <h3   id="p1">Dodaj produkt</h3>
    <form action="dodaj_produkt.php" class="form_panel" method="post" id="form1" enctype="multipart/form-data">
        <input type="text" name="nazwa" placeholder="Nazwa">
        <input type="text" name="cena" placeholder="Cena">

        <select name="rodzaj"> 
        <option value="">Rodzaj</option>
        <?php
            $pyt_rodz = $conn->query("SELECT * FROM rodzaj_produktu")->fetchAll();

            foreach($pyt_rodz as $linia){
                echo "<option value =". $linia["id"] .">" . $linia["nazwa"] . "</option>";
            }    
        ?>
        </select>
        <textarea type="text" name="opis" placeholder="Opis" style="resize: vertical; min-height:60px;"></textarea>
        <input type="file" name="zdjecie" placeholder="Zdjecie">
        <p style="font-weight:bold;">Rozmiary:</p>

        <div class="rozmiary">

        <label for="XS">XS</label>
        <input type="number" name="XS" placeholder="Ilość">
        <label for="S">S</label>
        <input type="number" name="S" placeholder="Ilość">
        <label for="M">M</label>
        <input type="number" name="M" placeholder="Ilość">
        <label for="L">L</label>
        <input type="number" name="L" placeholder="Ilość">
        <label for="XL">XL</label>
        <input type="number" name="XL" placeholder="Ilość">
        <label for="XXL">XXL</label>
        <input type="number" name="XXL" placeholder="Ilość">
        <label for="Uniwersalny">Uni</label>
        <input type="number" name="Uniwersalny" placeholder="Ilość">

        </div>
        <button type="submit" class="zielony_przycisk">Dodaj</button>
    </form>

</div>

<div class="panel" id="panel2">
    <!-- Usun produkt -->
    <h3 id="p2" >Usuń produkt</h3>
    <form action="usun_produkt.php" class="form_panel" method="post" id="form2">
        <input type="text" name="id" placeholder="ID" >
        <button type="submit" class="czerwony_przycisk">Usuń</button>
    </form>
    <br>
    <!-- Usuń rozmiar -->
    <h3 style="font-weight:bold;">Usuń rozmiar</h3>
        <form action="usun_rozmiar.php" class="form_panel" method="post" id="form5">
            <input type="text" name="id" placeholder="ID" >
            <select name="rozmiar" >
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
                <option value="Uniwersalny">Uni</option>
            </select>
            <button type="submit" class="czerwony_przycisk">Usuń</button>
        </form>
    <br>
    <!-- Dodaj rozmiar -->
    <br>
    <h3>Dodaj rozmiar</h3>
    <form action="dodaj_rozmiar.php" class="form_panel" method="post" id="form6">
        <input type="text" name="id" placeholder="ID">
        <select name="rozmiar">
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
                <option value="Uniwersalny">Uni</option>
            </select>
            <button type="submit" class="zielony_przycisk">Dodaj</button>
    </form>
</div>

<div class="panel" id="panel3">
    <!-- Aktualizuj produkt -->
    <h3  id="p4">Aktualizuj produkt</h3>
    <form action="akt_produkt.php" class="form_panel" method="post" id="form3" enctype="multipart/form-data">
        <input type="text" name="id"  placeholder="Podaj ID">
        <input type="text" name="nazwa" placeholder="Nazwa">
        <input type="text" name="cena" placeholder="Cena">
        <select name="rodzaj">
            <option value="">Rodzaj</option>
        <?php
            foreach($pyt_rodz as $linia){
                echo "<option value =". $linia["id"] .">" . $linia["nazwa"] . "</option>";
            }    
        ?>
        </select>

        <textarea name="opis" placeholder="Opis" style="resize: vertical; min-height:60px;"></textarea>
        <input type="file" name="zdjecie" placeholder="Zdjecie">
        <p style="font-weight:bold;">Rozmiary:</p>

        <div class="rozmiary">
            
        <label for="XS">XS</label>
        <input type="number" name="XS" placeholder="Ilość">
        <label for="S">S</label>
        <input type="number" name="S" placeholder="Ilość">
        <label for="M">M</label>
        <input type="number" name="M" placeholder="Ilość">
        <label for="L">L</label>
        <input type="number" name="L" placeholder="Ilość">
        <label for="XL">XL</label>
        <input type="number" name="XL" placeholder="Ilość">
        <label for="XXL">XXL</label>
        <input type="number" name="XXL" placeholder="Ilość">
        <label for="Uniwersalny">Uni</label>
        <input type="number" name="Uniwersalny" placeholder="Ilość">

        </div>
        <button type="submit" class="zielony_przycisk">Aktualizuj</button>
    </form>
</div>

<div class="panel" id="panel4">
    <!-- Lista produktów -->
    <div class="lista_produktow">
    <h3 id="p5">Lista Produktów</h3>
    <button class="button_refresh" onClick="window.location.reload();"><img src="svg/refresh.svg" alt="&#10227" width="20px" height="20px"></button>
    </div>
    <table class="tabela_produktow">
        <tr>
            <th>ID</th>
            <th>Indeks</th>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Ilosc</th>
            <th>Rodzaj</th>
            <th>Rozmiary</th>
            <th>Zdjecie</th>
        </tr>
<?php
$pyt_produkt = $conn->query("SELECT * FROM produkty")->fetchAll();

foreach($pyt_produkt as $linia){  
    $pyt_rozmiar = $conn->prepare("SELECT rozmiar FROM rozmiary_produktow WHERE id_produktu = ?");
    $pyt_rozmiar->execute([$linia["id"]]);
    echo "<tr>";
    echo "<td>" . $linia["id"] . "</td>";
    echo "<td>" . $linia["indeks_produktu"] . "</td>";
    echo "<td>" . "<a style='color:black;' href=" .$linia["link"].">".$linia["nazwa"] . "</a></td>";
    echo "<td>" . $linia["cena"] . "</td>";
    echo "<td>" . $linia["ilosc"] . "</td>";
    echo "<td>" . $linia["rodzaj"] . "</td>";
    echo "<td>";
    while($kolejny = $pyt_rozmiar->fetch()){
        echo  " |".$kolejny['rozmiar'] ."| ";
    }
    echo "</td>";
    if( $linia["zdjecie"] == NULL ){
        echo "<td>" . "Brak" . "</td>";
    }
    else{
        echo "<td>" . "<img src=$linia[zdjecie] width=90px height=90px>" . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
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
