<?php 
	session_start();
	error_reporting(E_ALL);
	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="stil.css" type="text/css" rel="stylesheet" />
<title>Planer arhitekture stambenih objekata</title>
</head>
<body>
<header>
	<h1 class="naslov">Planer arhitekture stambenih objekata</h1>
	<?php
			if(isset($_SESSION["id"])) {
				echo "<p class='dobrodosli'>Korisnik - {$_SESSION['ime']}</p>"; }
			
		?>
</header>