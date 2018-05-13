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

		<form class="form-horizontal" action="<?php echo router()->name('pay.create'); ?>" method="POST">

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Naam
				</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="first_name" placeholder="Voornaam">
				</div>
				<div class="col-sm-2">
					<input class="form-control" type="text" name="suffix_name" placeholder="Tussenvoegsel">
				</div>
				<div class="col-sm-4">
					<input class="form-control" type="text" name="last_name" placeholder="Achternaam">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Land
				</label>
				<div class="col-sm-9">
					<select class="form-control" name="country" placeholder="Kies een land">
						<option value="NL">Nederland</option>
						<option value="BE">België</option>
						<option value="DE">Deutchland</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Stad
				</label>
				<div class="col-sm-5">
					<input class="form-control" type="text" name="city" placeholder="Stad">
				</div>
				<label class="col-sm-1 control-label">
					Postcode
				</label>
				<div class="col-sm-3">
					<input class="form-control" type="text" name="zipcode" placeholder="Postcode">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					Straat
				</label>
				<div class="col-sm-5">
					<input class="form-control" type="text" name="city" placeholder="Straat">
				</div>
				<div class="col-sm-2">
					<input class="form-control" type="text" name="city" placeholder="Huisnummer">
				</div>
				<div class="col-sm-2">
					<input class="form-control" type="text" name="city" placeholder="Toevoeging">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">
					E-mail adres
				</label>
				<div class="col-sm-9">
					<input class="form-control" type="email" name="email" placeholder="E-mail adres">
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
