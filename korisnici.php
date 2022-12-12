<?php
	require_once("zaglavlje.php");
	require_once("meni.php") ;
	require_once("baza.php");
	
	if( $_SESSION["tip"] != 0) {
		header("Location: index.php");
		exit();
	}
	$veza = spojiSeNaBazu();

	$upit="SELECT * FROM korisnik ORDER BY korisnik_id ";
	$rezultat=izvrsiUpit($veza,$upit);
	
	echo "<div style='margin: 0 auto; text-align: center; padding: 30px'>";
	echo "<br/>";
	echo '<a class="link" href="korisnik.php">DODAJ KORISNIKA</a>';
	echo '<a class="link" href="korisnik.php?korisnik='.$_SESSION["id"].'">UREDI MOJE PODATKE</a>';
	echo '</div>';

	echo "<table class='tablica' >";
	echo "<caption>Popis korisnika sustava</caption>";
	echo "<thead><tr>
		<th>Korisničko ime</th>
		<th>Ime</th>
		<th>Prezime</th>
		<th>E-mail</th>
		<th>Lozinka</th>
		<th>Slika</th>
		<th></th>";
	echo "</tr></thead>";

	echo "<tbody>";
	while($red =mysqli_fetch_array($rezultat)){
		$id = $red["korisnik_id"];
		$tipKorisnika = $red["tip_id"];
		$korisnicko = $red["korisnicko_ime"];
		$lozinka = $red["lozinka"];
		$imeKorisnika = $red["ime"];
		$prezimeKorisnika = $red["prezime"];
		$email = $red["email"];
		$slika = $red["slika"];
		
		echo "<tr>
			<td>$korisnicko</td>
			<td>$imeKorisnika</td>";
		echo "<td>".(empty($prezimeKorisnika)?"&nbsp;":"$prezimeKorisnika")."</td>
			<td>".(empty($email)?"&nbsp;":"$email")."</td>
			<td>$lozinka</td>
			<td><figure><img src='$slika' width='70' alt='Slika korisnika $imeKorisnika $prezimeKorisnika'/></figure></td>";
			if($_SESSION["id"]==0||$_SESSION["tip"]==0)echo "<td><a class='link' href='korisnik.php?korisnik=$id'>UREDI</a></td>";
			else if(isset($_SESSION["id"]) && $_SESSION["id"]==$id) echo '<td><a class="link" href="korisnik.php?korisnik='.$_SESSION["id"].'">UREDI</a></td>';
			else echo "<td></td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
?>
<?php
	zatvoriVezuNaBazu($veza);
	require_once("podnozje.php");
?>