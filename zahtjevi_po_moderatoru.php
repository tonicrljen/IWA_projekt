<?php
	require_once("zaglavlje.php");
	require_once("meni.php") ;
	require_once("baza.php");
	
	$veza = spojiSeNaBazu();
	
    $traziKorisnika = false;
	if (isset($_POST["korisnik"]) && $_POST["korisnik"] != -1) $traziKorisnika = true;
        
    if (!empty($_POST["doDatuma"])) { $doDatuma = date("Y-m-d H:i:s", strtotime($_POST["doDatuma"])); }
    else { 
        $do = "31.12.2022 23:59:00";       
        $doDatuma = date("Y-m-d H:i:s", strtotime($do)) ;}        
    if (!empty($_POST["odDatuma"])) $odDatuma = date("Y-m-d H:i:s", strtotime($_POST["odDatuma"]));
    else  { 
        $od = "01.01.2018 00:00:00";
        $odDatuma = date("Y-m-d H:i:s", strtotime($od));}

    $sql = "SELECT projekt.korisnik_id, projekt.moderator_id, projekt.datum_vrijeme_kreiranja, projekt.naziv, projekt.opis, 
    korisnik.ime, korisnik.prezime 
    FROM projekt 
    INNER JOIN korisnik ON projekt.korisnik_id = korisnik.korisnik_id
    WHERE ";
    
    if ($traziKorisnika) { $sql = $sql. " korisnik.korisnik_id = {$_POST['korisnik']} AND "; }
    $sql = $sql. "datum_vrijeme_kreiranja BETWEEN '{$odDatuma}' AND '{$doDatuma}' ";

    $rs = izvrsiUpit($veza, $sql);

    $upit = "SELECT korisnik.ime, korisnik.prezime, COUNT(projekt.moderator_id) as broj_zahtjeva FROM projekt, korisnik 
    WHERE projekt.moderator_id=korisnik.korisnik_id
    GROUP BY projekt.moderator_id;";
    $rezUkBr = izvrsiUpit($veza, $upit);

    echo "<br><br><table class=\"tablica\" border=1>
    <caption>Ukupan broj zahtjeva po moderatoru</caption>";
    
    while ($red = mysqli_fetch_array($rezUkBr)){
        echo "<tr>
                <td>{$red['ime']}</td>
                <td>{$red['prezime']}</td>
                <td>{$red['broj_zahtjeva']}</td>
            </tr>";
    }

    echo "</table><br><br>";

    echo '<table class="tablica" border=1>
        <tr>
        <td>Moderator ID</td>
        <td>Korisnik</td>
        <td>Datum kreiranja</td>
        <td>Naziv</td>
        <td>Opis</td>
        </tr>';
    echo "<caption>Zahtjevi po moderatoru</caption>";
    while ($red = mysqli_fetch_array($rs)) {
        $d = date('d.m.Y H:i:s', strtotime($red["datum_vrijeme_kreiranja"]));
        echo "<tr><td>{$red["moderator_id"]}</td><td>{$red["ime"]} {$red["prezime"]}</td></td><td>$d</td><td>{$red["naziv"]}</td><td>{$red["opis"]}</td></tr>";
    }
    echo '</table>';

    $upitIdKor = "SELECT DISTINCT projekt.korisnik_id, korisnik.ime, korisnik.prezime FROM projekt, korisnik WHERE projekt.korisnik_id = korisnik.korisnik_id;";
    $rezIdKor = izvrsiUpit($veza, $upitIdKor);
?>

<form class="forma-kategorija" id=form1 method=post name="form1" action="<?php echo $_SERVER["PHP_SELF"]?>">
<p>Filtriraj po korisniku:</p>
<select name="korisnik">
    <option value='-1'>-</option>
        <?php
            while($red = mysqli_fetch_array($rezIdKor)){
            echo "<option value='{$red['korisnik_id']}'>{$red['ime']} {$red['prezime']}</option>";
            }
        ?>
</select>
    <p>&nbsp Od datuma: <input name="odDatuma" placeholder="dd.mm.gggg"></p><br>
    <p>&nbsp Do datuma: <input name="doDatuma" placeholder="dd.mm.gggg"></p><br>
    <input class="forma-gumb" type="submit" name="submit" value="Šalji">
    <input class="forma-gumb" type="reset" name="reset" value="Obriši">
</form>
<?php
	require_once("podnozje.php");
	zatvoriVezuNaBazu($veza);
?>