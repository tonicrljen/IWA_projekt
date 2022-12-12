<?php 
	require_once("zaglavlje.php");
	require_once("meni.php") ;
	require_once("baza.php");
	
	$greska = "";
	$veza = spojiSeNaBazu();	
	if(empty($_SESSION["id"])) {
		header("Location: prijava.php");
	}
	$poruka = "";
	if(isset($_POST['submit']))	{
		$datum = date("Y-m-d H:i:s");	

		$kor_id = $_SESSION["id"];
		
		$mod = $_POST['moderator_id'];
		
		if ( empty($greska) ){
			$poruka="Zahtjev poslan!";
			$sql = "INSERT INTO projekt (korisnik_id, moderator_id, datum_vrijeme_kreiranja) 
						VALUES ('$kor_id','$mod','$datum')";
			izvrsiUpit($veza,$sql);		
		}
	}	
	$upitModerator = "SELECT * FROM korisnik WHERE tip_id=1";
	$rezultatModerator = izvrsiUpit($veza,$upitModerator);
	zatvoriVezuNaBazu($veza);
	
?>

	<section class="zahtjev-za-projekt"> <br>	
	
	<h2>Zahtjev za projektni plan</h2> <br>		
	<form name="forma"  method="POST" action="<?php echo $_SERVER["PHP_SELF"]?>" >
		<label for="tip">Moderator:</label>
		<select name="moderator_id" id="moderator_id">
			<?php
				while($red = mysqli_fetch_array($rezultatModerator))
				{
					echo "<option value='{$red['korisnik_id']}'>";
					echo $red["ime"]." " . $red["prezime"]."</option>"; }
					?>
		</select>
		<input class="forma-gumb" type="submit" name="submit"  value="Pošalji" />
	</form>
	<br>
	<p><?php echo $poruka ?></p>
	<p><?php echo $greska ?></p>
	
</section>

<?php require_once("podnozje.php") ?>