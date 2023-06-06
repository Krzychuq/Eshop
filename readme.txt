//wysyłanie maili
sendmail.ini
linia 14 smtp.gmail.com
linia 18 465

php.ini linia 1098
daj email i haslo skrzynki
path zmien np. "\"C:\xampp\sendmail\sendmail.exe\" -t"

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
