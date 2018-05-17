<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="title" content="">
	<meta name="description" content="">
	<title>Webshop - product</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo asset('css/style.css'); ?>">
</head>
<body>

	<?php include "partials/menu.php"; ?>

	<section class="content">
		<h1>Betaling onderweg</h1>
		<p>Bedankt voor uw bestelling bij MyBikeShop.nl, uw betaling is onderweg.
		Zodra deze bij ons binnen is versturen wij de artikelen naar u toe.</p>
		<p><a href="<?php echo router()->name('home'); ?>">Klik hier om terug te keren naar het hoofdscherm</a></p>
	</section>

	<?php include "partials/footer.php"; ?>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="<?php echo asset('js/app.js'); ?>"></script>
</body>
</html>
