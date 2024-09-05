<?php
session_start();
    if( isset( $_SESSION['email'] ) && !empty( $_SESSION['email']) ){
        
        include_once("laczenieZbaza.php");
        $mail = $_SESSION['email'];
        //identyfikacja
        $mail = $_SESSION['email'];
        $pyt_o_id = $conn->prepare("SELECT id FROM loginy WHERE login like ?");
        $pyt_o_id -> execute([$mail]);
        $wykonanie = $pyt_o_id->fetch(PDO::FETCH_ASSOC);
        $id = $wykonanie['id'];

        //dane konta
        $pyt_o_dane = $conn->prepare("SELECT * FROM dane_konta WHERE id_loginu = ?");
        $pyt_o_dane -> execute([$id]);
        $wykonanie = $pyt_o_dane->fetchAll();

        foreach ($wykonanie as $wynik){
            $imie = $wynik['imie'];
            $nazwisko = $wynik['nazwisko'];
            $tel = $wynik['nr_tel'];
            $miasto = $wynik['miasto'];
            $ulica = $wynik['ulica'];
            $nr_domu = $wynik['nr_domu'];
            $nr_mieszkania = $wynik['nr_mieszkania'];
            $kod_pocztowy = $wynik['kod_pocztowy'];
            $kraj = $wynik['kraj'];
            $dostep = $wynik['dostep'];
        }

        // dane faktury
        $pyt_o_dane = $conn->prepare("SELECT * FROM dane_do_faktury WHERE id_konta = ?");
        $pyt_o_dane -> execute([$id]);
        $wykonanie = $pyt_o_dane->fetchAll();

        foreach ($wykonanie as $wynik2){
            $state = 1;
            $nip = $wynik2['NIP'];
            $nazwa_firmy = $wynik2['nazwa_firmy'];
            $miasto_firmy = $wynik2['miasto'];
            $adres_firmy = $wynik2['adres'];
            $kod_pocztowy_firmy = $wynik2['kod_pocztowy'];
            $kraj_firmy = $wynik2['kraj'];
        }
        if(empty($nip)){
            $state = 0;
            $nip = "...";
            $nazwa_firmy = "...";
            $miasto_firmy = "...";
            $adres_firmy = "...";
            $kod_pocztowy_firmy = "...";
            $kraj_firmy = "...";
        }
        $conn = null;
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
    <link rel="stylesheet" href="s.css?v1.1">
    <title>Sesja</title>
</head>
<body>
<?php 
include_once("header.php");
?>
<div class="contener">
<form action="<?php echo "zapis_danych_konta.php?d=$state";?>" class="form_konta" method="POST">
<div class="grid-right-column">
    <section>
        <h3 style="display: flex; align-items: center; gap:2px;"><img src="svg/person.svg" width="22px" height="22px">Dane konta:</h3>
    </section>
    <section>
        <div>
        <label for="imie">Imie: </label>
        <input type="text" maxlength="100" name="imie" placeholder="<?php echo $imie; ?>" >
        </div>

        <div>
        <label for="nazwisko">Nazwisko: </label>
        <input type="text" maxlength="100" name="nazwisko" placeholder="<?php echo $nazwisko; ?>">
        </div>

        <div>
        <label for="tel">Podaj numer telefonu: </label>
        <input type="tel" pattern="[0-9]{9}" maxlength="9" minlength='9' name="tel" placeholder="<?php echo $tel; ?>">
        </div>
    </section>
</div>
<div class="grid-mid-column">
    <h3 style="display: flex; align-items: center; gap:2px;"><img src="svg/house.svg" width="22px" height="22px">Dane do wysyłki:</h3>

    <label for="ulica">Ulica: </label>
    <input type="text" maxlength="100" name="ulica" placeholder="<?php echo $ulica; ?>" >

    <label for="nr_domu">Nr domu: </label>
    <input type="text" maxlength="6"  name="nr_domu" placeholder="<?php echo $nr_domu; ?>" >

    <label for="nr_mieszkania">Nr mieszkania: </label>
    <input type="text" maxlength="6" name="nr_mieszkania" placeholder="<?php echo $nr_mieszkania; ?>" >

    <label for="kod_pocztowy">Kod pocztowy: </label>
    <input type="text" name="kod_pocztowy" pattern="^[0-9]{2}(?:-[0-9]{3})?$" maxlength="6" minlength="6" placeholder="<?php echo $kod_pocztowy; ?>">

    <label for="miasto">Miasto: </label>
    <input type="text" maxlength="100" name="miasto" placeholder="<?php echo $miasto; ?>" >

    <!--///////////////////////////// select kraj////////////////////////////////////////// -->
    <label for="kraj">Kraj: </label>
    <select type="text" maxlength="100" name="kraj">
        <option value=""><?php echo $kraj; ?></option>
    <?php
    $file = fopen("kraje.txt", "r");
    while(! feof($file)) {
      $line = fgets($file);
      echo "<option value=$line>$line</option>";
    }
    
    fclose($file);
    ?>
    </select><br>
</div>
    <!-- //////////////////////////////select kraj //////////////////////////////////////-->
<div class="grid-left-column">
    <h3 style="display: flex; align-items: center; gap:2px;"><img src="svg/faktura.svg" width="22px" height="22px">Dane do faktury:</h3>
    <label for="nip">NIP: </label>
    <input type="text" pattern="[0-9]{10}" maxlength="10" minlength='10' name="nip" placeholder="<?php echo $nip; ?>">

    <label for="firma">Nazwa firmy: </label>
    <input type="text" maxlength="150" name="firma" placeholder="<?php echo $nazwa_firmy; ?>">

    <label for="adresf">Adres : </label>
    <input type="text" maxlength="100" name="adresf" placeholder="<?php echo $adres_firmy; ?>">

    <label for="kod_pocztowyf">Kod pocztowy: </label>
    <input type="text" pattern="^[0-9]{2}(?:-[0-9]{3})?$" maxlength="6" minlength='6' name="kod_pocztowyf" placeholder="<?php echo $kod_pocztowy_firmy; ?>">

    <label for="miastof">Miasto: </label>
    <input type="text" maxlength="100" name="miastof" placeholder="<?php echo $miasto_firmy; ?>">

    <label for="krajf">Kraj: </label>
    <select type="text" maxlength="100" name="krajf">
        <option value=""><?php echo $kraj_firmy; ?></option>
    <?php
    $file = fopen("kraje.txt", "r");
    while(! feof($file)) {
      $line = fgets($file);
      echo "<option value=$line>$line</option>";
    }
    
    fclose($file);
    ?>
    </select>
</div>


<div>
    <button type="submit" style="font-size: 19px;">Zapisz</button>
    <button type="button" style="font-size: 19px;" onclick='anuluj()'>Anuluj</button>
</div>
</form>

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
?>
<footer>
    <?php include_once("footer.html"); ?>
</footer>
</body>
</html>
<script>
    function anuluj(){
        window.location.href = "konto.php";
    }
</script>
<script src="loading.js"></script>