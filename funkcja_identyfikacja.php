<?php
    $mail = $_SESSION['email'];
    //identyfikacja
    $mail = $_SESSION['email'];
    $pyt_o_id = $conn->prepare("SELECT id FROM loginy WHERE login like ?");
    $pyt_o_id -> execute([$mail]);
    $wykonanie = $pyt_o_id->fetch(PDO::FETCH_ASSOC);
    $id = $wykonanie['id'];
?>