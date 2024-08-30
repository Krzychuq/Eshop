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
            $nip = $wynik['NIP'];
            $tel = $wynik['nr_tel'];
            $miasto = $wynik['miasto'];
            $ulica = $wynik['ulica'];
            $nr_domu = $wynik['nr_domu'];
            $nr_mieszkania = $wynik['nr_mieszkania'];
            $kod_pocztowy = $wynik['kod_pocztowy'];
            $kraj = $wynik['kraj'];
            $dostep = $wynik['dostep'];
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
<form action="zapis_danych_konta.php" class="form_konta" method="POST">

    <label for="nip">NIP: </label>
    <input type="text" pattern="[0-9]{10}" name="nip" placeholder="<?php echo $nip; ?>">

    <label for="imie">Imie: </label>
    <input type="text" maxlength="100" name="imie" placeholder="<?php echo $imie; ?>" >

    <label for="nazwisko">Nazwisko: </label>
    <input type="text" maxlength="100" name="nazwisko" placeholder="<?php echo $nazwisko; ?>">

    <label for="tel">Podaj numer telefonu: </label>
    <input type="tel" pattern="[0-9]{9}" maxlength="9" name="tel" placeholder="<?php echo $tel; ?>">

    <label for="ulica">Ulica: </label>
    <input type="text" maxlength="100" name="ulica" placeholder="<?php echo $ulica; ?>" >

    <label for="nr_domu">Nr domu: </label>
    <input type="text" maxlength="6" name="nr_domu" placeholder="<?php echo $nr_domu; ?>" >

    <label for="nr_mieszkania">Nr mieszkania: </label>
    <input type="text" maxlength="6" name="nr_mieszkania" placeholder="<?php echo $nr_mieszkania; ?>" >

    <label for="kod_pocztowy">Kod pocztowy: </label>
    <input type="text" name="kod_pocztowy" maxlenght="6" placeholder="<?php echo $kod_pocztowy; ?>">

    <label for="miasto">Miasto: </label>
    <input type="text" maxlength="100" name="miasto" placeholder="<?php echo $miasto; ?>" >

    <label for="kraj">Kraj: </label>
    <select type="text" maxlength="100" name="kraj">
        <option value="">...</option>
    <?php
    $file = fopen("kraje.txt", "r");
    while(! feof($file)) {
      $line = fgets($file);
      echo "<option value=$line>$line</option>";
    }
    
    fclose($file);
    ?>
    </select><br>
    <button type="submit" style="font-size: 19px;">Zapisz</button>
    <button type="button" style="font-size: 19px;" onclick='anuluj()'>Anuluj</button>

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