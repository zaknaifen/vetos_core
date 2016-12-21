<head>
<title>WebServ</title>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-2">
<STYLE TYPE="text/css">
H1 {
	font-weight: bold;
	font-size: 18pt;
	line-height: 18pt;
	font-family: arial,helvetica;
	font-variant: normal;
	font-style: normal;
}
BODY {
	color: black;
	background-color: white;
	background: url("background.jpg") repeat-x;
  }


body,td {
	font-family: Verdana; 
	font-size: 10pt; 
	TEXT-DECORATION: none;
}

a {
	color: #000000; font-weight: normal; text-decoration: none;
}
a:link {
	COLOR: #76857E; TEXT-DECORATION: none;  font-family: Verdana; font-size: 8pkt;
}
a:visited {
	font-family: Verdana; font-size: 8pkt; COLOR: #76857E; TEXT-DECORATION: none;
}
a:hover {
	font-family: Verdana; font-size: 8pkt; COLOR: #94A397; TEXT-DECORATION: none;
}

hr {
	color: #CDD0CD; height: 1px; border: 0;
}
</STYLE>
</head>
<body>
<table>
<tr>
<td valign="top">
<img src="logo.jpg" align="left">
</td>
</tr>
</table>
	<PRE><font face="Verdana" size="4"><B>Info</B></font><br>Jeżeli strona ta jest widoczna, oznacza to poprawną instalację serwera. <br>Można już zamienić zawartość tej strony.<br>

<table cellPadding=3 bgColor=#f3f3f3 border=0 style="border: 1px solid #d0d0d0; background-color: #f0f0f0;">
<tr><td><b>Host:</b> <font style="color: #76857E;"><? echo $_SERVER["HTTP_HOST"] ?></font><br>
<b>Port:</b> <font style="color: #76857E;"><? echo $_SERVER["SERVER_PORT"] ?></font><br>
<br>
<b>Serwer HTTP:</b> <font style="color: #76857E;"><? echo $_SERVER["SERVER_SOFTWARE"] ?></font><br>
<b>Protokół serwera:</b> <font style="color: #76857E;"><? echo $_SERVER["SERVER_PROTOCOL"] ?></font><br>
<b>System operacyjny:</b> <font style="color: #76857E;"><? echo $_ENV["OS"] ?></font><br>
<br>
<b>Administrator:</b> <font style="color: #76857E;"><? echo $_SERVER["SERVER_ADMIN"] ?></font><br>
<br>
<b>Aktualna data:</b> <font color="red"><? echo date('d-m-Y, H:i:s') ?></font>
</td>
</tr>
</table>

	  <br>
	<a href="phpinfo.php"><font face="Verdana" size="4"><B>Apache & PHP</B></font></a>
	Informacje na temat konfiguracji serwera Apache oraz PHP ( <i><font color="red">phpinfo</font><font color="brown">()</font></i> ).
	  <br>
	<a href="http://<? echo $_SERVER['HTTP_HOST'] ?>/phpmyadmin/"><font face="Verdana" size="4"><B>MySQL & phpMyAdmin</B></font></a>
	Zarządzanie bazą danych MySQL poprzez skrypt phpMyAdmin.
	Adres do skryptu: <a href="http://<? echo $_SERVER['HTTP_HOST'] ?>/phpmyadmin/"><i>http://<? echo $_SERVER['HTTP_HOST'] ?>/phpmyadmin/</i></a>

	Domyślnie dane dostępowe:
	Login: <font style="color: #76857E;">root</font>
	Hasło: <font style="color: #76857E;">brak (zostawiamy puste pole)</font>
	  <br>
	<a href="http://<? echo $_SERVER['HTTP_HOST'] ?>"><font face="Verdana" size="4"><B>Konto główne</B></font></a>
	Przykładowe konto WWW <a href="http://<? echo $_SERVER['HTTP_HOST'] ?>/~przykladowe_konto/">http://<? echo $_SERVER['HTTP_HOST'] ?>/</a>
	Ścieżka do folderu z użytkownikami: <i><? echo $_SERVER["DOCUMENT_ROOT"] ?></i>
	  <br>
	<a href="http://<? echo $_SERVER['HTTP_HOST'] ?>/~przykladowe_konto/"><font face="Verdana" size="4"><B>Konta WWW</B></font></a>
	Przykładowe konto WWW <a href="http://<? echo $_SERVER['HTTP_HOST'] ?>/~przykladowe_konto/">http://<? echo $_SERVER['HTTP_HOST'] ?>/~przykladowe_konto/</a>
	Domyślna ścieżka do folderu z użytkownikami: <i>C:/Program Files/WebServ/httpd-users/</i>
	  <br>

	<a href="webserv_message.php">webserv_message.php</a> - plik z przykładem zewnętrznych komunikatów (gdy opcja aktywna w ustawieniach WebServ'a)<br>
</PRE><HR>

<b><font face="Verdana" size="2"><a href="http://www.webserv.pl" target="_blank"><b><font face="Verdana" size="2" color="#000000">WebServ</font></b></a> 2.1 (<a href="http://www.webserv.pl" target="_blank"><b><font face="Verdana" size="2" color="#000000"><? echo $_SERVER["SERVER_SOFTWARE"] ?></font></b></a> <a href="http://www.webserv.pl" target="_blank"><b><font face="Verdana" size="2" color="#000000">MySQL</font></b></a> 5.5.21)</font></b><br><br><br>

<a href="http://www.webserv.pl" target="_blank" alt="WebServ - WAMP - Windows, Apache, MySQL, PHP - Twój Domowy Serwer"><i>http://www.webserv.pl</i></a> <i>- Oficjalna strona programu</i><br>
<a href="http://forum.webserv.pl" target="_blank"><i>http://forum.webserv.pl</i></a> <i>- Pomoc techniczna</i>

<br><br><br><iframe id='aa1a5ca9' name='aa1a5ca9' src='http://webserv.pl/rotacja/webserv_banner_bottom.php' framespacing='0' frameborder='no' scrolling='no' width='468' height='60'><a href='http://rotacja.webserv.pl/adclick.php?n=aa1a5ca9' target='_blank'></iframe>

</body>
</html>