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
		<h1>Webshop</h1>
		<p>Hallo, welkom in mijn voorbeeld webshop</p>

		<h2>Producten</h2>
		<div class="row">

			<?php foreach($products as $product) { ?>

			<a href="<?php echo router()->name('product', ['slug' => $product->slug]); ?>" class="col-md-4 product">
				<img src="<?php echo asset('images/large/'.$product->image); ?>">
				<h3><?php echo $product->title; ?></h3>
				<?php echo $product->shortDescription(); ?>
				<div class="product-price">
					&euro; <?php echo $product->price; ?>
				</div>
				<button type="button" class="btn btn-warning add-to-cart" data-url="<?php echo router()->name('cart.add', ['id' => $product->id]); ?>">Voeg toe aan winkelmand!</button>
			</a>

			<?php } ?>
		</div>
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
