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
    <link rel="stylesheet" href="s.css?v=1.4">
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
    <h3 onclick="rozwin1()"  id="p1">Dodaj produkt</h3>
    <form action="dodaj_produkt.php" class="form_panel" method="post" id="form1" enctype="multipart/form-data">
        <input type="text" name="nazwa" placeholder="Nazwa">
        <input type="text" name="cena" placeholder="Cena">
        <input type="text" name="ilosc" placeholder="Ilość">
        <input type="text" name="rodzaj" placeholder="Rodzaj">
        <select name="rozmiar">
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
    <h3 id="p2" onclick="rozwin2()">Usuń produkt</h3>
    <form action="usun_produkt.php" class="form_panel" method="post" id="form2">
        <input type="text" name="id" placeholder="ID"><br>
        <button type="submit">Usuń</button>
    </form>
</div>

<div class="panel" id="panel3" >
    <h3 onclick="rozwin3()" id="p3">Aktualizuj produkt</h3>
    <form action="akt_produkt.php" class="form_panel" method="post" id="form3" enctype="multipart/form-data">
        <input type="text" name="id"  placeholder="Podaj ID">
        <input type="text" name="nazwa" placeholder="Nazwa">
        <input type="text" name="cena" placeholder="Cena">
        <input type="text" name="ilosc" placeholder="Ilość">
        <input type="text" name="rodzaj" placeholder="Rodzaj">
        <input type="text" name="rozmiar" placeholder="Rozmiar">
        <input type="text" name="opis" placeholder="Opis">
        <input type="file" name="zdjecie" placeholder="Zdjecie">
        <button type="submit">Aktualizuj</button>
    </form>
</div>

<div class="panel" id="panel4">
    <div style="display:flex; flex-direction:row; gap:2%; justify-content:center;">
    <h3 id="p4">Lista Produktów</h3>
    <button class="button_refresh" onClick="window.location.reload();"><img src="svg/refresh.svg" alt="&#10227" width="20px" height="20px"></button>
    </div>
    <table class="tabela_produktow">
        <tr>
            <th>ID</th>
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
    echo "<tr>";
    echo "<td>" . $linia["id"] . "</td>";
    echo "<td>" . $linia["nazwa"] . "</td>";
    echo "<td>" . $linia["cena"] . "</td>";
    echo "<td>" . $linia["ilosc"] . "</td>";
    echo "<td>" . $linia["rodzaj"] . "</td>";
    echo "<td>" . $linia["rozmiar"] . "</td>";
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
}
?>
</body>
</html>