<?php
echo "<div class='podobne_produkty'>";
    $podobne_produkty = $conn -> query('SELECT nazwa, cena, zdjecie1,link FROM produkty LIMIT 5');
    while($linia = $podobne_produkty->fetch()){
        $nazwa = ucfirst($linia["nazwa"]);
        $link = "../" . $linia["zdjecie1"];
        echo "<div>";
        echo "<a style='color: black; text-decoration:none;' href=$linia[link]>";
        echo "<img src=$link>";
        echo "<p style='font-size: 1.2rem;'>$nazwa</p>";
        echo "<p style='font-size: 0.9rem; font-weight:bold;'>$linia[cena] PLN</p>";
        echo "</a>";
        echo "</div>";
    }
    echo "</div>";
?>