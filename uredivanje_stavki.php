<?php
	require_once("zaglavlje.php");
	require_once("meni.php") ;
	
	require_once("baza.php");
	$veza = spojiSeNaBazu();
	
	$projektID=$_GET['projekt'];
	$kategorijaID = $_GET["kategorija"];
	$greska = "";
	$poruka = "";
		
	$upitKategorija = "SELECT * FROM kategorija;";
	$rezultatKategorija = izvrsiUpit($veza,$upitKategorija);
	
	if($_SESSION["tip"] == 2  || !isset($_SESSION["id"]) ) {
		header("Location: index.php");
		exit();
	}
	
	if(isset($_GET['submit'])){
		
		$slika=$_GET['slika'];
		$opis=$_GET['opis'];
		$video=$_GET['video'];
		
		if(empty($greska)){
			if( isset( $_GET['projekt']) && isset($_GET["kategorija"]) ){				

				$upitBrisi = "DELETE FROM stavke_projekta WHERE projekt_id = {$_GET['projekt']} AND kategorija_id = {$_GET['staraKategorija']}";
				izvrsiUpit($veza, $upitBrisi);

				$upitDodaj = "INSERT INTO `stavke_projekta`(`projekt_id`, `kategorija_id`, `opis`, `slika`, `video`) VALUES ('{$_GET['projekt']}','{$_GET['kategorija']}','{$opis}','{$slika}','{$video}')";
				izvrsiUpit($veza, $upitDodaj);

				$poruka = "Stavke uređene";
			}
			else $greska = "Kategorija se može odabrati samo jednom";			
			}			
	}

	$upitPodaci = "SELECT * FROM stavke_projekta WHERE projekt_id = $projektID AND kategorija_id = $kategorijaID";
	$rezPodaci = izvrsiUpit($veza, $upitPodaci);
	$redPodaci = mysqli_fetch_array($rezPodaci);

	zatvoriVezuNaBazu($veza);
?>
<section class="uredivanje-stavki"><br>
	<p>UREĐIVANJE STAVKI PROJEKTA</p><br>
	<form class="forma uredivanje-stavki" name="forma"  method="get" action="<?php echo $_SERVER["PHP_SELF"]?>" >

				<label for="kategorija">Kategorija:</label>
				<select name=kategorija>
				<?php
							while($red = mysqli_fetch_array($rezultatKategorija)) {
								if ($kategorijaID == $red['kategorija_id']) echo "
								<option value='{$red['kategorija_id']}' selected>{$red['naziv']}</option>";
							}
						
						?>
				</select>
					<br>
				<label for="opis">Opis:</label>
				<textarea rows="4" cols="48" name="opis"  placeholder="Unesite opis:" required><?php echo $redPodaci['opis'] ?></textarea> <br>
				<label for="slika">Slika(URL):</label>
				<textarea rows="4" cols="48" name="slika"  placeholder="Unesite URL slike:" required><?php echo $redPodaci['slika'] ?></textarea> <br>
				<label for="video" >Video(URL):</label>
				<textarea rows="4" cols="48" name="video"  placeholder="Unesite URL videa:"><?php echo $redPodaci['video'] ?></textarea> <br><br>
				<input type="hidden" name="projekt" value="<?php echo $projektID ?>">
				<input type="hidden" name="staraKategorija" value="<?php echo $kategorijaID?>">
				 
				<input class="forma-gumb" type="submit" name="submit" value="Pošalji"/>
	</form><br>
	<p><?php echo $greska ?></p>
	<p><?php echo $poruka ?></p>
</section>

<?php
	require_once("podnozje.php");
?>