<?php
	require_once("zaglavlje.php");
	require_once("meni.php") ;

	require_once("baza.php");
	$pravaKorisnika = $_SESSION["tip"];
	
	if($pravaKorisnika == 2 || !isset($pravaKorisnika)) {
		header("Location: index.php");
	}

	$veza = spojiSeNaBazu();
	
	if (isset($_GET['zakljucaj_projekt'])){
		$upitZakljucaj = "UPDATE `projekt` SET `zakljucan`='1' WHERE projekt_id = {$_GET['zakljucaj_projekt']}";
		izvrsiUpit($veza, $upitZakljucaj);
	}

	$upit="SELECT projekt.projekt_id, projekt.naziv, projekt.datum_vrijeme_kreiranja, projekt.zakljucan,
			(SELECT ime FROM korisnik WHERE projekt.moderator_id=korisnik_id) as ime, 
			(SELECT prezime FROM korisnik WHERE projekt.moderator_id=korisnik_id) as prezime
			FROM projekt, korisnik WHERE  korisnik.korisnik_id = projekt.korisnik_id";
	$rezultat = izvrsiUpit($veza, $upit);
	
	$upit2 = "SELECT * FROM projekt";
	$rezultat2 = izvrsiUpit($veza,$upit2);
	
	$upit3="SELECT projekt.projekt_id, projekt.naziv, projekt.datum_vrijeme_kreiranja, projekt.zakljucan,
			(SELECT ime FROM korisnik WHERE projekt.moderator_id=korisnik_id) as ime, 
			(SELECT prezime FROM korisnik WHERE projekt.moderator_id=korisnik_id) as prezime
			FROM projekt, korisnik WHERE  korisnik.korisnik_id = projekt.korisnik_id AND projekt.moderator_id = {$_SESSION['id']}";
	$rezultat3 = izvrsiUpit($veza,$upit3);
	zatvoriVezuNaBazu($veza);
?>

<section class="kategorije"> <br>
		<table class="tablica" border="1">
			<caption>Zahtjevi korisnika za projekte</caption>
			<thead>
				<th>Projekt</th>
				<th>Datum kreiranja</th>
				<th>Moderator</th>
				<th>Prikaži detalje</th>
				<th>Status</th>
			</thead>
			<tbody>
				<?php 
					if(isset($rezultat) && $pravaKorisnika == 0) {
						while($red = mysqli_fetch_array($rezultat)) {
							echo "<tr>"; 
							echo "<td>{$red["naziv"]}</td>";
							echo "<td>" . date("d.m.Y H:i:s", strtotime($red['datum_vrijeme_kreiranja'])) . "</td>";
							echo "<td>{$red["ime"]} {$red["prezime"]}</td>";
							if(!empty($red["naziv"])) {
								echo "<td style='width:180px;text-align:center;'><a class='detalji-projekta' href='stavke_projekta.php?projekt={$red["projekt_id"]}' target='_blank'>Detalji projekta</a></td>";
							}
							else if (empty($red["naziv"])) {
								echo "<td style='width:180px;text-align:center;'><a class='detalji-projekta' href='odobrenje_projekta.php?projekt={$red["projekt_id"]}' target='_blank'>Odobri zahtjev</a></td>";
								
							}
							if ($red['zakljucan'] == 0 && !empty($red["naziv"])) {
								echo "<td style='width:180px;text-align:center;'><a class='detalji-projekta' href='{$_SERVER['PHP_SELF']}?zakljucaj_projekt={$red['projekt_id']}'>Zaključaj projekt</a></td>";
							}
							else if (empty($red["naziv"])) {
								echo "<td style='width:180px;text-align:center;'>Projekt nije odobren</td>";
							}
							else {
								echo "<td style='width:180px;text-align:center;'><p>Projekt je zaključan</p></td>";
							}

							echo "</tr>";
						}
					}
					else if(isset($rezultat3) && $pravaKorisnika == 1) {
						while($red = mysqli_fetch_array($rezultat3)) {
							echo "<tr>"; 
							echo "<td>{$red["naziv"]}</td>";
							echo "<td>" . date("d.m.Y H:i:s", strtotime($red['datum_vrijeme_kreiranja'])) . "</td>";
							echo "<td>{$red["ime"]} {$red["prezime"]}</td>";
							if(!empty($red["naziv"])) {
								echo "<td style='width:180px;text-align:center;'><a class='detalji-projekta' href='stavke_projekta.php?projekt={$red["projekt_id"]}' target='_blank'>Detalji projekta</a></td>";
							}
							else if (empty($red["naziv"])) {
								echo "<td style='width:180px;text-align:center;'><a class='detalji-projekta' href='odobrenje_projekta.php?projekt={$red["projekt_id"]}' target='_blank'>Odobri zahtjev</a></td>";
								
							}
							if ($red['zakljucan'] == 0 && !empty($red["naziv"])) {
								echo "<td style='width:180px;text-align:center;'><a class='detalji-projekta' href='{$_SERVER['PHP_SELF']}?zakljucaj_projekt={$red['projekt_id']}'>Zaključaj projekt</a></td>";
							}
							else if (empty($red["naziv"])) {
								echo "<td style='width:180px;text-align:center;'>Projekt nije odobren</td>";
							}
							else {
								echo "<td style='width:180px;text-align:center;'><p>Projekt je zaključan</p></td>";
							}

							echo "</tr>";
					}}
				?>
			</tbody>
			</table>
</section>

<?php
	require_once("podnozje.php");

?>