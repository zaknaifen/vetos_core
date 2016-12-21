Jest to przyklad wysylania komunikatów do aplikacji WebServ.<br>
<br>
UWAGA!<br>
Aby komunikaty dzia³aly poza zaznaczeniem w Ustawieniach opcji "Pokazuj wysuwane informacje zewnetrzne z PHP",<br>powinnismy wejsc w Ustawienia, zak³adka PHP z listy "zaawansowana konfiguracja" wybrac plik php.ini, odnalesc linie ";extension=php_sockets.dll" i usunac z niej pierwszy znak (";"), nastepnie zapisujemy zmiany!
<hr>
<?php
//Jezeli nie instalowales w standartowym katalogu zmien sciezke do glownego katalogu WebServ'a
$dir = 'C:/Program Files/WebServ';

//WCZYTANIE OBSLUGI KOMUNIKATOW WEBSERV
include($dir . '/php/webserv_message.php');

//WIADOMOSC
//Haslo, jesli nie podales w ustawieniach WebServa zostaw puste
$haslo = '';
//Typ 1 - informacja, 2 - uwaga, 3 blad
$typ = 3;
//Czas wyswietlania komunikatu w sec. lub 0 - bez limitu czasu, -1 - czas ustawiony w ustawieniach WebServa
$czas = 2;
//Wiadomosc
$wiadomosc = 'To jest test !';

//WYSLANIE WIADOMOSCI
if (send_message($haslo,$typ, $czas, $wiadomosc) == 0)
{
	echo 'Komunikat nie zostal wyslany.';
}
else
{
	echo 'Komunikat zostal wyslany.';
}
?>