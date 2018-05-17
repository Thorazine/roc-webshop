<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="title" content="">
	<meta name="description" content="">
	<title>Betalen</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo asset('css/style.css'); ?>">
</head>
<body>

	<?php include "partials/menu.php"; ?>

	<section class="content">
		<h1>Betalen</h1>

		<?php if(router()->errors()) { ?>
			<div class="alert alert-danger">
				Oeps, niet alles is correct ingevuld.
			</div>
		<?php } ?>

		<form class="form-horizontal" action="<?php echo router()->name('pay.create'); ?>" method="POST">

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Naam
				</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="first_name" placeholder="Voornaam" value="<?php echo router()->value('first_name'); ?>">
					<?php echo (router()->errors('first_name')) ? '<p class="text-danger">'.router()->errors('first_name')[0].'</p>' : ''; ?>
				</div>
				<div class="col-sm-2">
					<input class="form-control" type="text" name="suffix_name" placeholder="Tussenvoegsel" value="<?php echo router()->value('suffix_name'); ?>">
					<?php echo (router()->errors('suffix_name')) ? '<p class="text-danger">'.router()->errors('suffix_name')[0].'</p>' : ''; ?>
				</div>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="last_name" placeholder="Achternaam" value="<?php echo router()->value('last_name'); ?>">
					<?php echo (router()->errors('last_name')) ? '<p class="text-danger">'.router()->errors('last_name')[0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Land
				</label>
				<div class="col-sm-9">
					<select class="form-control" name="country" placeholder="Kies een land">
						<?php foreach([
							'NL' => 'Nederland',
							'BE' => 'België',
							'DE' => 'Deutchland'
						] as $iso => $country) { ?>
						<option value="<?php echo $iso; ?>" <?php echo (router()->value('country')) ? 'selected="selected"' : ''; ?>><?php echo $country; ?></option>
						<?php } ?>
					</select>
					<?php echo (router()->errors('country')) ? '<p class="text-danger">'.router()->errors('country')[0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Stad
				</label>
				<div class="col-sm-5">
					<input class="form-control" type="text" name="city" placeholder="Stad" value="<?php echo router()->value('city'); ?>">
					<?php echo (router()->errors('city')) ? '<p class="text-danger">'.router()->errors('city')[0].'</p>' : ''; ?>
				</div>
				<label class="col-sm-1 control-label">
					Postcode
				</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="zipcode" placeholder="Postcode" value="<?php echo router()->value('zipcode'); ?>">
					<?php echo (router()->errors('zipcode')) ? '<p class="text-danger">'.router()->errors('zipcode')[0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Straat
				</label>
				<div class="col-sm-5">
					<input class="form-control" type="text" name="street" placeholder="Straat" value="<?php echo router()->value('street'); ?>">
					<?php echo (router()->errors('street')) ? '<p class="text-danger">'.router()->errors('street')[0].'</p>' : ''; ?>
				</div>
				<div class="col-sm-2">
					<input class="form-control" type="text" name="street_number" placeholder="Huisnummer" value="<?php echo router()->value('street_number'); ?>">
					<?php echo (router()->errors('street_number')) ? '<p class="text-danger">'.router()->errors('street_number')[0].'</p>' : ''; ?>
				</div>
				<div class="col-sm-2">
					<input class="form-control" type="text" name="street_suffix" placeholder="Toevoeging" value="<?php echo router()->value('street_suffix'); ?>">
					<?php echo (router()->errors('street_suffix')) ? '<p class="text-danger">'.router()->errors('street_suffix')[0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					E-mail adres
				</label>
				<div class="col-sm-9">
					<input class="form-control" type="email" name="email" placeholder="E-mail adres" value="<?php echo router()->value('email'); ?>">
					<?php echo (router()->errors('email')) ? '<p class="text-danger">'.router()->errors('email')[0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Wachtwoord
				</label>
				<div class="col-sm-9">
					<input class="form-control" type="password" name="password" placeholder="Wachtwoord" value="">
					<?php echo (router()->errors('password')) ? '<p class="text-danger">'.router()->errors('password')[0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Herhaal wachtwoord
				</label>
				<div class="col-sm-9">
					<input class="form-control" type="password" name="password_confirm" placeholder="Wachtwoord bevestigen" value="">
					<?php echo (router()->errors('password_confirm')) ? '<p class="text-danger">'.router()->errors('password_confirm')[0].'</p>' : ''; ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3">
					<button type="submit" class="btn btn-primary">Verstuur</button>
				</div>
			</div>

		</form>
	</section>

	<aside class="bucket" id="bucket">
		<?php include "partials/bucket.php"; ?>
	</aside>

	<?php include "partials/footer.php"; ?>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="<?php echo asset('js/app.js'); ?>"></script>
</body>
</html>
