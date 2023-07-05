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
    <link rel="stylesheet" href="s.css?v=1.1">
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
        <input type="text" name="ilosc" placeholder="Ilość">
        <select name="rodzaj">
            <option value="">Rodzaj</option>
        <?php
            $pyt_rodz = $conn->query("SELECT * FROM rodzaj_produktu")->fetchAll();

            foreach($pyt_rodz as $linia){
                echo "<option value =". $linia["id"] .">" . $linia["nazwa"] . "</option>";
            }    
        ?>
        </select>

        <select name="rozmiar">
            <option value="">Rozmiar</option>
            <option value="Uniwersalny">Uniwersalny</option>
            <option value="XS">XS</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        </select>
        <input type="text" name="opis" placeholder="Opis">
        <input type="file" name="zdjecie" placeholder="Zdjecie">
        <button type="submit">Dodaj</button>
    </form>

</div>

<div class="panel" id="panel2">
    <!-- Usun produkt -->
    <h3 id="p2" >Usuń produkt</h3>
    <form action="usun_produkt.php" class="form_panel" method="post" id="form2">
        <input type="text" name="id" placeholder="ID">
        <button type="submit">Usuń</button>
    </form>
    <br>
    <h3 id="p3">Dodaj rozmiar</h3>
    <!-- Dodaj rozmiar -->
    <form action="dodaj_rozmiar.php" class="form_panel" method="post">
        <input type="text" name="id" placeholder="ID">
        <select name="rozmiar">
            <option value="">Rozmiar</option>
            <option value="Uniwersalny">Uniwersalny</option>
            <option value="XS">XS</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        </select>
        <button type="submit">Dodaj</button>
    </form>
</div>

<div class="panel" id="panel3">
    <!-- Aktualizuj produkt -->
    <h3  id="p4">Aktualizuj produkt</h3>
    <form action="akt_produkt.php" class="form_panel" method="post" id="form3" enctype="multipart/form-data">
        <input type="text" name="id"  placeholder="Podaj ID">
        <input type="text" name="nazwa" placeholder="Nazwa">
        <input type="text" name="cena" placeholder="Cena">
        <input type="text" name="ilosc" placeholder="Ilość">
        <select name="rodzaj">
            <option value="">Rodzaj</option>
        <?php
            foreach($pyt_rodz as $linia){
                echo "<option value =". $linia["id"] .">" . $linia["nazwa"] . "</option>";
            }    
        ?>
        </select>

        <select name="rozmiar">
            <option value="">Rozmiar</option>
            <option value="Uniwersalny">Uniwersalny</option>
            <option value="XS">XS</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
        </select>
        <input type="text" name="opis" placeholder="Opis">
        <input type="file" name="zdjecie" placeholder="Zdjecie">
        <button type="submit">Aktualizuj</button>
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
            <th>Rozmiar</th>
            <th>Opis</th>
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
    echo "<td>" . $linia["opis"] . "</td>";
    if( $linia["zdjecie"] == NULL ){
        echo "<td>" . "Brak" . "</td>";
    }
    else{
        echo "<td>" . "<img src=$linia[zdjecie] width=70px height=70px>" . "</td>";
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
$conn = null;
?>
</body>
</html>
