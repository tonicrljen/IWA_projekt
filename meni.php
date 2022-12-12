<nav>
	<?php	
			echo "<a href='index.php' class='navigacija-tekst'>Naslovna</a>";
			echo "<a href='o_autoru.html' class='navigacija-tekst'>Autor</a>";
			echo "<a href='kategorije.php' class='navigacija-tekst'>Kategorije</a>"; 

			if( isset($_SESSION["tip"]) ) {
				 
				echo "<a href='novi_zahtjev.php' class='navigacija-tekst'>Novi zahtjev</a>"; 
				echo "<a href='moji_projekti.php' class='navigacija-tekst'>Moji projekti</a>";
				if ($_SESSION["tip"] < 2) {
					echo "<a href='zahtjevi_korisnika.php' class='navigacija-tekst'>Zahtjevi korisnika</a>"; 
				} 
				if ($_SESSION["tip"] < 1) {
					echo "<a href='zahtjevi_po_moderatoru.php' class='navigacija-tekst'>Zahtjevi po moderatoru</a>"; 
					echo "<a href='korisnici.php?odjava=1' class='navigacija-tekst'>Korisnici</a>"; 
				}
				echo "<a href='prijava.php?odjava=1' class='navigacija-tekst'>Odjava</a>"; 
				
			}
			else {
				echo "<a href='prijava.php' class='navigacija-tekst'>Prijava</a>"; 
			}
	?>
		
</nav>