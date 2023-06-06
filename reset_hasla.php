<?php
session_start();
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
<?php include_once("header.php");?>
<section class="wrap-sign-up-in">
    <form class='zaloguj' action="wyslanie_linka_z_haslem.php" method='POST'>
        <div class="divy-grid">
			<p>Wpisz email konta, do którego nie pamiętasz hasła.</p>
            <label for="email"><img src="svg/email.svg" width="24px" height="auto" alt="Email: "></label>
            <input name='email' type="email" placeholder="Email">
        </div>
        <br>
<?php 
	if(isset($_SESSION['error'])){
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
?>
<br>
        <button type='submit' class="przycisk_zaloguj_zarejestruj">Wyślij</button>
		
    </form>

</section>
</body>
</html>