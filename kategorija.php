<?php
	require_once("zaglavlje.php");
	require_once("meni.php") ;
	
	require_once("baza.php");
	$veza = spojiSeNaBazu();
	
	
	$upit="SELECT COUNT(*) FROM kategorija";
	$rezultat=izvrsiUpit($veza,$upit);
	
	$greska = "";
	
	if(isset($_POST['submit'])){
		foreach ($_POST as $k => $vr) {
			if(strlen($vr) == 0) {
				$greska = "Potrebno je ispuniti sva polja!"; }}
		if(empty($greska)){
			$id=$_POST['novi'];
			$naziv = $_POST['naziv'];
			$opis = $_POST['opis'];
			$obavezno = $_POST['obavezna'];
					
			if( $id == 0 ){
				list($kategorija)= mysqli_fetch_array($rezultat);
				$nova_kategorija = $kategorija + 1;
				$sql="INSERT INTO kategorija
				(kategorija_id,naziv,opis,obavezna)
				VALUES
				('$nova_kategorija','$naziv','$opis','$obavezno');
				";
			}
			else{
				$sql="UPDATE kategorija SET
					naziv='$naziv',
					opis='$opis',
					obavezna='$obavezno'
					WHERE kategorija_id='$id'
				";
			}
			izvrsiUpit($veza,$sql);
			header("Location:kategorije.php");
		}
	}
	if(isset($_GET['kategorija'])){
		$id=$_GET['kategorija'];
		$upit="SELECT * FROM kategorija WHERE kategorija_id='$id'";
		$rezultat=izvrsiUpit($veza,$upit);
		list($id,$naziv,$opis,$obavezno)= mysqli_fetch_array($rezultat);
	}
	else{
		$naziv = "";
		$obavezno = 1;
		$opis = "";
	}
	if(isset($_POST['reset'])){
		header("Location:kategorija.php");
	}
	zatvoriVezuNaBazu($veza);
?>

<section>	<br>
	<h3>
		<?php
			if(!empty($id))echo "<p style='text-align:center;'>UREDI KATEGORIJU</p>";
			else echo "<p style='text-align: center; margin: 10px;'>DODAJ KATEGORIJU</p>";
		?>
	</h3><br>
	<form class="forma-kategorija" method="POST" action="<?php if(isset($_GET['kategorija']))echo "kategorija.php?kategorija=$id";else echo "kategorija.php";?>">
		<input type="hidden" name="novi" value="<?php if(!empty($id))echo $id;else echo 0;?>"/>
		<label for="naziv">Naziv: &nbsp</label>
		<textarea rows="4" cols="48" name="naziv"  placeholder="Unesite naziv kategorije:" required><?php if(!isset($_POST['naziv']))echo $naziv; else echo $_POST['naziv'];?></textarea>
		<label for="opis">&nbsp&nbsp Opis:&nbsp</label>
		<textarea rows="4" cols="48" name="opis"  placeholder="Unesite opis kategorije:" required><?php if(!isset($_POST['opis']))echo $opis; else echo $_POST['opis'];?></textarea>
		<label for="obavezna">&nbsp&nbsp Obavezna:&nbsp</label>
		<input type="radio" name="obavezna" <?php if (isset($obavezno) && $obavezno=="1") echo "checked";?> value="1">Da&nbsp
		<input type="radio" name="obavezna" <?php if (isset($obavezno) && $obavezno=="0") echo "checked";?> value="0">Ne&nbsp
				<?php
					if(!empty($id)) {
						echo '<input class="forma-gumb" type="submit" name="submit" value="Pošalji"/>'; }
					else {
						echo '<input class="forma-gumb" type="submit" name="reset" value="Obriši"/>
							   <input class="forma-gumb" type="submit" name="submit" value="Pošalji"/>'; }
				?>
	</form>
	<p>	<?php echo $greska; ?> </p>
	
</section>
<?php
	require_once("podnozje.php");
?>