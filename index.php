<?php 
	require_once("zaglavlje.php");
	require_once("meni.php") ;
?>

	<div class="tijelo-sadrzaj">
		<h2 class="tijelo-naslov">Projektni zadatak: Planer arhitekture stambenih objekata</h2>
		<br>
		<p class="tijelo-tekst">Uloge: administrator, moderator, registrirani korisnik i anonimni/neregistrirani korisnici.</p>
		<br>
		<p class="tijelo-tekst">Sustav omogućuje upravljanje projektima arhitekture stambenih objekata. Sustav mora imati 
		mogućnost prijave i odjave korisnika sa sustava. U sustavu postoji jedan ugrađeni 
		administrator (korisničko ime: admin, lozinka: foi). Administrator je prijavljeni korisnik 
		koji ima vrstu jednaku jedan. Sustav obavezno sadrži stranicu o_autoru.html 
		(poveznica na stranicu mora biti u zaglavlju svake stranice) u kojoj se nalaze osobni 
		podaci autora (svi podaci su obavezni): ime, prezime, broj indeksa, mail (obavezno FOI mail), 
		centar, godina (akademska godina prvog upisa kolegija IWA) i slika JPG formata veličine 
		300x400px (npr. kao na osobnoj iskaznici ili indeksu).</p>
		<br>
		<p class="tijelo-tekst">Anonimni/neregistrirani korisnik može vidjeti kategorije koje je definirao administrator s informacijom 
		koliko ima projekata koji imaju stavku s tom kategorijom.</p>
		<p class="tijelo-tekst">Registrirani korisnik uz svoje funkcionalnosti ima i sve funkcionalnosti kao i neprijavljeni
		korisnik. Korisnik uz to može poslati zahtjev za novim projektnim planom. Prilikom slanja 
		zahtjeva mora odabrati moderatora kome šalje zahtjev, a automatski se unosi datum i vrijeme 
		kreiranja zahtjeva. Korisnik vidi popis svih svojih zahtjeva (obavezno se vide ime i prezime 
		moderatora, datum i vrijeme kreiranja, naziv projekta ako je postavljen te status). Ako je 
		projekt zaključan on se može odabrati i korisnik onda može vidjeti stavke projekta sa slikama 
		i video zapisom ukoliko je isti dodan.</p>
		<br>
		<p class="tijelo-tekst">Moderator uz svoje funkcionalnosti ima i sve funkcionalnosti kao i registrirani korisnik 
		te uz to može raditi planove za projekte. Moderator prilikom prijave vidi zahtjeve korisnika 
		za projektnim planom, a posebno su naznačeni zahtjevi za projektima koji još nisu prihvaćeni. 
		Može prihvatiti zahtjev za novi projektni plan tako da unese naziv projekta i opis 
		(ne može se mjenjati). Nakon što je unio naziv i opis može dodavati, pregledavati i ažurirati
		stavke projekta. Kod unosa stavke mora odabrati kategoriju, unijeti opis te dodati sliku 
		(URL do slike na Webu) i opcionalno video (URL do videa na Webu). Svaka kategorija može se 
		odabrati samo jednom u nekom projektu. Kada su unesene sve željene stavke projekta, moderator 
		ga zaključava i nakon toga promjene nisu moguće. Projekt se ne može zaključati ako nije unio 
		stavke za svaku kategoriju koja je u tom trenutku postavljena kao obavezna.</p>
		<br>
		<p class="tijelo-tekst">Administrator uz svoje funkcionalnosti ima i sve funkcionalnosti kao i moderator. Unosi, 
		ažurira i pregledava korisnike sustava te definira i ažurira njihove tipove. Unosi, 
		pregledava i ažurira kategorije elemenata (npr. temelji, krovište, ...) koje mora imati 
		projekt. Kod unosa kategorije mora unijeti naziv, opis i da li je ta kategorija obavezna u 
		svakom projektu. Vidi ukupan broj zahtjeva po moderatoru, a podatke može filtrirati na temelju 
		korisnika koji je poslao zahtjev i vremenskog razdoblja po datumu kreiranja zahtjeva. 
		Razdoblje se definira datumom i vremenom od i do.</p>
		<br>
		<p class="tijelo-tekst">Napomena: Svi datumi moraju se unositi od strane korisnika i prikazati korisniku u 
		formatu „d.m.Y“, a vrijeme (00:00:00 – 23:59:59) u obliku „H:i:s“ (ne koristiti date i time 
		HTML tip za input element). Format „d.m.Y” predstavlja kod PHP date funkciji i preslikava se 
		na hrvatski format „dd.mm.gggg”. Format „H:i:s” predstavlja kod PHP date funkciji i preslikava 
		se na hrvatski format „hh.mm.ss”. Poslužitelj se naziva localhost a baza podataka je 
		iwa_2019_zb_projekt. Korisnik za pristup do baze podataka naziva se iwa_2019, a lozinka je 
		foi2019. Kod izrade projektnog rješenja treba se točno držati uputa i NE SMIJE se mijenjati 
		(naziv poslužitelja, baze podataka, struktura tablica, korisnik i lozinka). 
		Završeno rješenje projektnog zadatka treba poslati kroz sustav za predaju rješenja nakon 
		čega slijedi obavijest i dogovor o obrani projekta. Obrana projektnog rješenja se obavlja na 
		računalu i bazi podataka nastavnika.</p>
	</div>


<?php require_once("podnozje.php")?>
