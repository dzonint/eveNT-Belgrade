<div>
	<h4>Filter</h4>
	<div class="form-group">
		<label>Grupa</label>
		<div class="btn-group">
		  <a href="020-radnici-spisak.php"  class="btn btn-success">Zaposleni</a>
		  <a href="020-radnici-spisak-kpo.php" class="btn btn-default">Korisnik pocetne obuke</a>
		</div>
	</div>
	<div class="form-group">
		<label>Radno mesto</label>
		<select class="form-control chosen" multiple>
			<option></option>
			<option>Sekretar</option>
			<option>Administrator</option>
			<option>Korisnik pocetne obuke (kao radno mesto)</option>
			<option>Spisak je izmenjiv kroz sifarnik</option>
		</select>
	</div>
	<div class="form-group">
		<label>Vrsta radnog odnosa<label>
		<select class="form-control chosen" multiple>
			<option></option>
			<option>Ugovor na Odredjeno vreme</option>
			<option>Ugovor na Neodredjeno vreme</option>
			<option>-Ugovor o delu</option>
			<option>-Van radnog odnosa</option>
			<option>fiksno, bez slobodne izmene, nema crud</option>
		</select>
	</div>
	<div class="form-group">
		<label>Stepen strucne spreme</label>
		<select class="form-control chosen" multiple>
			<option></option>
			<option>SSS</option>
			<option>VII1/Master</option>
			<option>VII</option>
			<option>Dr</option>
			<option>izmenjivo, po sifarniku</option>
		</select>
	</div>
	<div class="form-group">
		<label>Znanja</label>
		<select class="form-control chosen" multiple>
			<option></option>
			<option>Office</option>
			<option>Excel</option>
			<option>Neuro-lingvisticko programiranje</option>
			<option>izmenjivo, po sifarniku (unos kroz profil)</option>
		</select>
	</div>
	<div class="form-group">
		<label>Strani jezici</label>
		<select class="form-control chosen" multiple>
			<option></option>
			<option>Engleski</option>
			<option>Francuski</option>
			<option>Nemacki</option>
			<option>izmenjivo, po sifarniku</option>
		</select>
	</div>
	
	<div class="form-group">
		<label>Pretraga za dan</label>
		<input type="date" class="form-control" value="<?= date("Y-m-d") ?>" />
	</div>
</div>