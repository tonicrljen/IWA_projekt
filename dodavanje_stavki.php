<?php
	require_once("zaglavlje.php");
	require_once("meni.php") ;
	
	require_once("baza.php");
	$veza = spojiSeNaBazu();
	
	$projektID=$_GET['projekt'];
	
	$poruka = "";
	
	$greska = "";
	
	if(isset($_POST['submit'])){
		foreach ($_POST as $k => $vr){
			if( empty($vr) ) {
				$greska = "Sva polja su obvezna"; 
			} 
		}
		$slika = $_POST['slika'];
		$kat = $_POST['kategorija_id'];
		$video = $_POST['video'];
		$opis = $_POST['opis'];
		
		if(empty($greska)){
			if( isset($_GET['projekt']) ){				
							
			$upit="SELECT projekt_id,kategorija_id FROM stavke_projekta 
				   WHERE projekt_id='$projektID' 
				   AND kategorija_id='$kat'";
			$rezultat=izvrsiUpit($veza,$upit);
			
			if(mysqli_num_rows($rezultat) == 0) {
				$sql="INSERT INTO stavke_projekta (projekt_id, kategorija_id, opis, slika, video)
						VALUES ('$projektID', '$kat', '$opis', '$slika', '$video'); 	";
				izvrsiUpit($veza,$sql);
				
				$poruka = "Dodana nova stavka u projekt: $projektID.";
			}
			else $greska = "Odabrana kategorija se može samo jednom odabrati.";			
			}			
		}
	}
	$upitKategorije = "SELECT * FROM kategorija;";
	$rezultatKategorije = izvrsiUpit($veza,$upitKategorije);
	
	zatvoriVezuNaBazu($veza);
?>

	<section class="dodavanje-stavki"><br>	
	<h4>DODAJ STAVKU PROJEKTU</h4><br>	
	<form class="dodavanje-stavki" name="forma" id="forma" method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?projekt=".$projektID; ?>" >
		<label for="kategorija">Kategorija:</label>
		<select name="kategorija_id" id="kategorija_id">
			<?php
				while($red = mysqli_fetch_array($rezultatKategorije)) {
					echo "<option value=\"".$red["kategorija_id"]."\"";
					echo ">".$red["naziv"]."</option>"; }
			?>
		</select><br>
		<label for="opis">Opis:</label>
		<textarea rows="4" cols="48" name="opis"  placeholder="Unesite opis:" required><?php echo $red['opis'] ?></textarea><br>
		<label for="slika">Slika (URL):</label>
		<textarea rows="4" cols="48" name="slika"  placeholder="Unesite URL slike:" required><?php echo $red['slika'] ?></textarea><br>
		<label for="video">Video (URL):</label>
		<textarea rows="4" cols="48" name="video"  placeholder="Unesite URL videa:" required><?php echo $red['video'] ?></textarea>
		<br>
		<input class="forma-gumb" type="submit" name="submit" value="Pošalji"/><br>
	</form>
	<p>	<?php echo $greska; ?></p>
	<p>	<?php echo $poruka; ?></p>
</section>


<?php
	require_once("podnozje.php");
?>