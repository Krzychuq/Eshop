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
    <h3 onclick="rozwin()" id="p1">Dodaj produkt</h3>
</div>

<div class="panel" id="panel2">
    <h3 onclick="rozwin()" id="p2">Usuń produkt</h3>
</div>

<div class="panel" id="panel3" >
    <h3 onclick="rozwin()" id="p3">Aktualizuj produkt</h3>
</div>

<div class="panel" id="panel4">
    <h3 id="p4">...</h3>
</div>

<div class="panel" id="panel5">
    <h3 id="p5">...</h3>
</div>
    
</div>
</div>
</body>
</html>
<script>
    function rozwin(){
        // document.getElementById("panel3")
    }
</script>