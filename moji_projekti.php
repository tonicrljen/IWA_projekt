<?php 

require_once("zaglavlje.php");
require_once("meni.php") ;
require_once("baza.php");
$veza = spojiSeNaBazu();

if(empty($_SESSION["id"])) {
	header("Location: prijava.php");
}
	$upit = "SELECT projekt.projekt_id, projekt.naziv, projekt.datum_vrijeme_kreiranja, projekt.zakljucan, projekt.opis,
			(SELECT ime FROM korisnik WHERE projekt.moderator_id=korisnik_id) as ime, 
			(SELECT prezime FROM korisnik WHERE projekt.moderator_id=korisnik_id) as prezime
			FROM projekt JOIN korisnik  WHERE  korisnik.korisnik_id = '{$_SESSION["id"]}' AND korisnik.korisnik_id=projekt.korisnik_id";
	$rezultat = izvrsiUpit($veza, $upit);
	
	zatvoriVezuNaBazu($veza);
?>
	<section class="kategorije" ><br>
		<h2 class="kategorije-naslov">Projekti</h2>
		<table class="tablica" border="1">
			<caption>Moji zahtjevi za projekte</caption>
			<thead>
				<th>ID projekta</th>
				<th>Moderator</th>
				<th>Status</th>
				<th>Naziv projekta</th>
				<th>Opis projekta</th>
				<th>Datum kreiranja</th>
				<th>Zaključan</th>
			</thead>
			<tbody>
				<?php 
					if(isset($rezultat)) {
						while($red = mysqli_fetch_array($rezultat)) {
							$projektID = $red["projekt_id"];
							echo "<tr>";
							echo "<td>{$red["projekt_id"]}</td>";
							echo "<td>{$red["ime"]} {$red["prezime"]}</td>";
							echo "<td>{$red["zakljucan"]}</td>";
							echo "<td>{$red["naziv"]}</td>";
							echo "<td>{$red["opis"]}</td>";
							echo "<td>" . date("d.m.Y H:i:s", strtotime($red['datum_vrijeme_kreiranja'])) . "</td>";
							if($red["zakljucan"]==1){
							echo "<td><a class='uredi' href='stavke_projekta.php?projekt=$projektID'>Zaključan</a></td>";} 
							else if($red["zakljucan"]==0) {
							echo "<td>Otključan</td>"; }
							echo "</tr>";
						}
					}
				?>
			</tbody>
		</table>
	</section>
<?php 
require_once("podnozje.php");

?>
