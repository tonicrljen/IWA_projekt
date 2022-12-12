<?php 
	require_once("zaglavlje.php");
	require_once("meni.php") ;

	require_once("baza.php");
	$veza = spojiSeNaBazu();
	
	$greska = "";
	$projektID=$_GET['projekt'];
	
	if( isset($_POST['submit']) ){
		foreach ($_POST as $k => $vr) {
			if(empty($vr)) {
				$greska = "Potrebno je ispuniti sva polja!"; 
			} 
		}
		if ( empty($greska) ){
			if(isset($_GET['projekt'])){				
				$opisProjekta=$_POST['opis'];
				$nazivProjekta=$_POST['naziv'];
				$sql="UPDATE projekt SET
						naziv='$nazivProjekta',
						opis='$opisProjekta'
						WHERE projekt_id=$projektID";
				izvrsiUpit($veza,$sql);
				header("Location:zahtjevi_korisnika.php");
				exit();
			}			
		}
	}  
	
	zatvoriVezuNaBazu($veza);
?>

<section class="odobrenje-projekta"><br>
	<h3 style="text-align: center;">Odobrenje projekta</h3><br>
	<form name="forma" id="forma" method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?projekt=" . $projektID; ?>" >
		<label for="naziv">Naziv:</label>
		<input name="naziv" id="naziv" type="text"  size="60%"  maxlength="60" placeholder="Upiši naziv projekta" />
		<br>
		<label for="opis">Opis: &nbsp</label>
		<input name="opis" id="opis" type="text"  size="60%"   maxlength="60" placeholder="Upiši opis projekta" />
		<br>
		<input class="forma-gumb" type="submit" name="submit" value="Pošalji"/>
	</form>
	<p><?php echo $greska; ?></p>
</section>


<?php
	require_once("podnozje.php");
?>