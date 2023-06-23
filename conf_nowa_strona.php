<?php
$kod_strony = "
<?php
session_start();
?>
<!DOCTYPE html>
<html lang=pl>
<head>
    <meta charset=UTF-8>
    <meta name=viewport content=width=device-width, initial-scale=1.0>
    <link rel=stylesheet href=s.css?v1.3>
    <title>Sesja</title>
</head>
<body>
<?php 
include_once(header.php);
include_once(laczenieZbaza.php);
?>

<div class=contener>


</div>
<footer>
    <?php include_once(footer.html); ?>
</footer>
</body>
</html>
";
?>