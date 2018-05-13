<?php
session_start();

createDefaultSession();

require "../classes/Memory.php";
require "../classes/Router.php";
require "../classes/Respond.php";
require "../classes/DB.php";
require '../classes/Model.php';
require '../classes/Cart.php';
require '../app/Controllers/Controller.php';


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


function db($class)
{
	return new DB($class);
}

function createDefaultSession()
{
	if(! isset($_SESSION['cart'])) {
		// default cart create
		$_SESSION['cart'] = [
			'products' => [],
			'total' => 0.00,
		];
	}
}


// Load the route and run the route we want
router()->run();


