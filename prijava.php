<?php 
	require_once("zaglavlje.php");
	require_once("meni.php") ;
	require_once("baza.php") ;
	
	if(isset($_GET["odjava"])) {
		session_unset();
		session_destroy();
		header("Location: prijava.php");
	}
	$veza = spojiSeNaBazu();	
	if(isset($_POST["submit"])){
		$greska = "";
		$poruka = "";
		$korime = $_POST["korisnicko_ime"];
		$lozinka = $_POST["lozinka"];
		
		if(isset($korime) && !empty($korime) && isset($lozinka) && !empty($lozinka) ){
			$upit = "SELECT * FROM korisnik 
				WHERE korisnicko_ime='{$korime}' 
				AND lozinka='{$lozinka}' ";
			$rezultat = izvrsiUpit($veza, $upit);
			$prijava = false;
			while($red = mysqli_fetch_array($rezultat)){
				$prijava = true;
				$_SESSION["id"] = $red[0];
				$_SESSION["ime"] = $red["ime"];
				$_SESSION["prezime"] = $red["prezime"];
				$_SESSION["tip"] = $red["tip_id"];
			}

			if ($_SESSION['tip'] == 1) {
				header("Location: zahtjevi_korisnika.php");
				exit();
				
			} 

			if($prijava){
				$poruka = "Korisnik je logiran.";
				header("Location: index.php");
				exit();
			}
			else {
				$greska = "Korisničko ime i/ili lozinka se ne podudaraju!";
			}
		}
		else {
			$greska = "Korisničko ime i/ili lozinka nisu uneseni!";
		}
	}
	zatvoriVezuNaBazu($veza);
?>
	<section class="prijava"> <br>
		<h2> Prijava korisnika </h2> <br>
		
		<form class="forma registracija" id="prijava-forma" name="prijava-forma" method="POST"
		action="<?php echo $_SERVER["PHP_SELF"] ?>"
		>
		<label for="korisnicko_ime" >Korisnicko ime:</label>
		<input class="forma-tekst" for="korisnicko_ime" name="korisnicko_ime" type="text" maxlength="20" ><br>
		<label for="lozinka" >Lozinka:</label>
		<input class="forma-tekst" for="lozinka" name="lozinka" type="password" maxlength="20" ><br>
		<input class="forma-gumb" for="submit" name="submit" type="submit" value="Prijavi se" />
		<input class="forma-gumb" for="reset" name="reset" type="reset" value="Obriši" />
		
		</form>
		<div>
				<?php
					if(isset($greska)){
						echo "<p>$greska</p>";
					}
					if(isset($poruka)){
						echo "<p>$poruka</p>";
					}
				?>
			</div>
	</section>
<?php require_once("podnozje.php")?>