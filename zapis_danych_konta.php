<?php
session_start();
//połączenie
include_once("laczenieZbaza.php");

//identyfikacja
$mail = $_SESSION['email'];
$pyt_o_id = $conn->prepare("SELECT id FROM loginy WHERE login like ?");
$pyt_o_id -> execute([$mail]);
$wykonanie = $pyt_o_id->fetch(PDO::FETCH_ASSOC);
$id = $wykonanie['id'];

//Zapis danych
if(!empty($_POST["nazwa"])){
    $nazwa = $_POST["nazwa"];
    $pyt_o_nazwe = $conn->prepare("UPDATE dane_konta SET nazwa = ? WHERE id_loginu = ?");
    $pyt_o_nazwe -> execute([$nazwa, $id]);
    $_SESSION['nickname'] = $nazwa;
}

if(!empty($_POST["data_uro"])){
    $data_uro = $_POST["data_uro"];
    $pyt_o_uro = $conn->prepare("UPDATE dane_konta SET data_urodzenia = ? WHERE id_loginu = ?");
    $pyt_o_uro -> execute([$data_uro, $id]);
}

if(!empty($_POST["tel"])){
    $tel = $_POST["tel"];
    $pyt_o_tel = $conn->prepare("UPDATE dane_konta SET nr_tel = ? WHERE id_loginu = ?");
    $pyt_o_tel -> execute([$tel, $id]);
}

if(!empty($_POST["miasto"])){
    $miasto = $_POST["miasto"];
    $pyt_o_miasto = $conn->prepare("UPDATE dane_konta SET miasto = ? WHERE id_loginu = ?");
    $pyt_o_miasto -> execute([$miasto, $id]);
}

if(!empty($_POST["kraj"])){
    $kraj = $_POST["kraj"];
    $pyt_o_kraj = $conn->prepare("UPDATE dane_konta SET kraj = ? WHERE id_loginu = ?");
    $pyt_o_kraj -> execute([$kraj, $id]);
}

if(!empty($_POST["opis"])){
    $opis = $_POST["opis"];    
    $pyt_o_opis = $conn->prepare("UPDATE dane_konta SET opis_konta = ? WHERE id_loginu = ?");
    $pyt_o_opis -> execute([$opis, $id]);
}

if(!empty($_FILES['photo']['name']) && isset($_FILES['photo']['name'])){
//nazwa zdjecia i rozszerzenie
$nazwa_zdjecia = $_FILES["photo"]["name"];
$zdjecietemp = $_FILES["photo"]["tmp_name"];
$rozszerzenie_zdjecia = mime_content_type($zdjecietemp);

//sprawdzanie formatu
if($rozszerzenie_zdjecia == "image/png" || $rozszerzenie_zdjecia == "image/jpg" || $rozszerzenie_zdjecia == "image/jpeg"){

    if(is_uploaded_file($zdjecietemp)) {

        //nowa nazwa z datą
        $zdjecie_bez_roz = explode(".",$nazwa_zdjecia);
        $nowa_nazwa_zdjecia = date("Y-m-d-H-i-s") . '.' . $zdjecie_bez_roz[1];
        $sciezka = "avatary/";
        $sciezka_do_bazy = $sciezka . $nowa_nazwa_zdjecia;

        //stare zdjecie
        $pyt_zdjecie_z_bazy = $conn->prepare("SELECT avatar FROM dane_konta WHERE id_loginu = ?");
        $pyt_zdjecie_z_bazy -> execute([$id]);

        if($pyt_zdjecie_z_bazy){
            $wykonanie = $pyt_zdjecie_z_bazy->fetch(PDO::FETCH_ASSOC);
            $stare_zdjecie = $wykonanie['avatar'];
        }

        $zdjecie_do_usuniecia = $stare_zdjecie;

        //usuniecie starego zdjecia
        if(file_exists($zdjecie_do_usuniecia)) {
            unlink($zdjecie_do_usuniecia);
        } 
        else{
            $_SESSION['wiadomosc_o_zdjeciu'] = 'Błąd zdjecie nie nadpisuje się! ';
        }

        //nowe zdjecie
            
            if(move_uploaded_file($zdjecietemp, $sciezka . $nowa_nazwa_zdjecia)) {
                $pyt_o_zdjecie = $conn->prepare("UPDATE dane_konta SET avatar = ? WHERE id_loginu = ?");
                $pyt_o_zdjecie -> execute([$sciezka_do_bazy, $id]);
            }
            else {
                $_SESSION['wiadomosc_o_zdjeciu'] = "Nie udało sie umieścić zdjecia!";
        }
    }
    else {
        $_SESSION['wiadomosc_o_zdjeciu']= "Nie udało sie zapisać zdjecia!";
    }
}
else{
    $_SESSION['wiadomosc_o_zdjeciu']= "Zdjęcie może być tylko w formacie jpg, jpeg, png !";
}

}
$conn = null;
header('location:konto.php');
?>