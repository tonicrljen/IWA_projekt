<?php 
	require_once("zaglavlje.php");
	require_once("meni.php") ;
	
	require_once("baza.php");
	$veza = spojiSeNaBazu();
	
	$upit = "SELECT * FROM kategorija";
	$rezultat = izvrsiUpit($veza, $upit);
	$upitStavke= "SELECT COUNT(stavke_projekta.projekt_id) 
				 FROM kategorija JOIN stavke_projekta 
				 WHERE kategorija.kategorija_id=stavke_projekta.kategorija_id 
				 GROUP BY kategorija.kategorija_id";
	$rezultatStavke = izvrsiUpit($veza, $upitStavke);
	zatvoriVezuNaBazu($veza);
	

?>
	<section class="kategorije" ><br>
		<h2 class="kategorije-naslov">Kategorije</h2>
		<table class="tablica" border="1">
			<thead>
				<th>ID kategorije</th>
				<th>Kategorija</th>
				<th>Opis</th>
				<th>Broj projekata</th>
			</thead>
			<tbody>
				<?php 
					if(isset($rezultat)) {
						while($red = mysqli_fetch_array($rezultat)) {
							echo "<tr>";
							echo "<td>{$red["kategorija_id"]}</td>";
							echo "<td>{$red["naziv"]}</td>";
							echo "<td>{$red["opis"]}</td>";
							list($zbrojProjekata) = mysqli_fetch_array($rezultatStavke);
							echo "<td>$zbrojProjekata</td>";
							if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0){
							echo "<td><a class='uredi' href='kategorija.php?kategorija={$red['kategorija_id']}'>Uredi</a></td>"; }
							else { 	echo "<td></td>";}
							echo "</tr>";
						}
					}
				?>
			</tbody>
		</table><br>
		
		<p><?php 
			if(isset($_SESSION["tip"]) && $_SESSION["tip"] == 0){
				echo "<a class='dodaj-stavku' href='kategorija.php'>Dodaj kategoriju</a>";
			}	
		?></p>
	</section>

<?php require_once("podnozje.php")?>