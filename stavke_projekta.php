<?php
	require_once("zaglavlje.php");
	require_once("meni.php") ;
	
	require_once("baza.php");
	
	if(!isset($_SESSION["id"]) || $_SESSION["tip"] > 2) {
		header("Location: index.php");
		exit();
	}
	$veza = spojiSeNaBazu();
	if(isset($_GET['projekt'])){
		$id_projekt = $_GET['projekt'];			
		
		$upit="SELECT stavke_projekta.*, projekt.zakljucan FROM stavke_projekta, projekt WHERE stavke_projekta.projekt_id='$id_projekt' AND stavke_projekta.projekt_id = projekt.projekt_id ORDER BY stavke_projekta.kategorija_id;";
		
		$rezultat=izvrsiUpit($veza,$upit);
	}
	zatvoriVezuNaBazu($veza);
?>
<section class="kategorije"><br>
		<h2>Stavke projekta</h2>
		<table class="tablica" border="1"><br>
			<thead>
				<th>Kategorija ID</th>
				<th>Opis</th>
				<th>Slika</th>
				<th>Video</th>
			</thead>
			<tbody>
				<?php 
					$zakljucan = NULL ;
					if( isset($rezultat) ) {
						while($red = mysqli_fetch_array($rezultat)) {
							if ($red["zakljucan"] == 1) { $zakljucan = true; }
							else  { $zakljucan = false; }
						echo "<tr>";
						echo "<td>{$red["kategorija_id"]}</td>";
						echo "<td>{$red["opis"]}</td>";
						if (!empty($red["slika"])) {
							echo "<td><img class='stavke-projekta-slika' src={$red["slika"]} alt='Slika'> </td>";
							}
							else {
								echo "<td>Stavka nema sliku</td>";
							}
						if (!empty($red["video"])) {
							echo "<td><video class='stavke-projekta-video' controls><source src={$red["video"]} alt='Video' ></video></td>";
							}
							else {
								echo "<td>Stavka nema video</td>";
							}
						if( $_SESSION["tip"] < 2 && $zakljucan == false ) {
						echo "<td style='width:80px;text-align:center;'><a class='uredi' href='uredivanje_stavki.php?projekt=$id_projekt&kategorija={$red['kategorija_id']}'>Uredi</a></td>"; 
						}
						echo "</tr>"; 
							
						}
					}
				?>
			</tbody>
			</table>
			<br>
			<div>
				<?php
					if($zakljucan == false && $_SESSION["tip"] < 2) {
						echo "<p><a class='dodaj-stavku' href='dodavanje_stavki.php?projekt=$id_projekt'>Dodaj stavku</a></p>";
					} 
					?>
			</div>
</section>

<?php
	require_once("podnozje.php")
?>