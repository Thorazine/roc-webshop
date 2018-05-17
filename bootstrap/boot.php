<?php
session_start();

require "../classes/Memory.php";
require "../classes/Router.php";
require "../classes/Respond.php";
require "../classes/DB.php";
require '../classes/Model.php';
require '../classes/Cart.php';
require '../app/Controllers/Controller.php';

// load the composer packages
require '../vendor/autoload.php';


// load all the base functions
function dd($text)
{
	if(is_array($text) || is_object($text)) {
		var_dump($text);
		die();
	}
	else {
		die($text);
	}
}

function asset($filepath)
{
	return router()->domain.router()->publicPath.trim($filepath, '/');
}

function response($content = '', $httpResponseCode = 200)
{
	return Memory::getClass('Respond')->response($content, $httpResponseCode);
}


function router()
{
	return Memory::getClass('Router');
}


function db()
{
	return Memory::getClass('DB');
}


function lang($filename)
{
	return Memory::getFile('../lang/nl/'.$filename);
}


// reset the cart if it's empty
if(! isset($_SESSION['cart'])) {
	Cart::reset();
}


// Load the route and run the route we want
router()->run();
