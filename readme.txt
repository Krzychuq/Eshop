//wysyłanie maili
sendmail.ini
linia 14 smtp.gmail.com
linia 18 465
linia 46 i 47 email i haslo

php.ini linia 1100
sendmail_path zmien np. "\"C:\xampp\sendmail\sendmail.exe\" -t"

przykladowy skrypt:
<?php
//
// *** To Email ***
$to = 'martinkowal66@gmail.com';
//
// *** Subject Email ***
$subject = 'Tytuł';
//
// *** Content Email ***
$content = 'Hej';
//
//*** Head Email ***
$headers = "From: $to\r\n";
//
//*** Show the result... ***
if (mail($to, $subject, $content, $headers))
{
	echo "Success !!!";
} 
else 
{
   	echo "ERROR";
}
