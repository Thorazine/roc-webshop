<?php

Class Router {

	public $protocol = null;
	public $domainName = null;
	public $domain = null;
	public $publicPath = null;
	public $path = null;
	public $parts = [];
	public $parameters = [];
	private $notFound = true;
	private $bestMatch = null;
	private $matchLength = 0;
	private $namedRoutes = [];
	private $controller = null;
	private $arguments = null;
	private $function = null;
	private $name = null;
	private $redirect = false;


	public function __construct()
	{

		// get the protocol
		$this->protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

	    // get the domain name
	    $this->domainName = $_SERVER['HTTP_HOST'];

	    // merge protocol and domain
	    $this->domain = $this->protocol.$this->domainName;

		// extract the public path
		$this->publicPath = str_replace('index.php', '', $_SERVER['PHP_SELF']);

		// get the current path by removing the public path from it
		$from = '/'.preg_quote($this->publicPath, '/').'/';
    	$this->path = preg_replace($from, '', parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), 1);

    	// get all the parts of the url
    	$this->parts = explode('/', $this->path);

    	// add "/" to beginning of url so that we always match
    	$this->path = '/'.$this->path;

    	// get the parameters
    	if(count($_GET)) {
	    	$this->parameters = $_GET;
	    }
	    elseif(count($_POST)) {
	    	$this->parameters = $_POST;
	    }
	}


	public function run()
	{
		// include the routing file
		require "../routes.php";

		// load the requested controller
		include_once '../app/Controllers/'.$this->controller.'.php';

		// instantiate the wanted controller
		$controllerClass = new $this->controller;

		// get the content from the wanted function
		$response = call_user_func_array([$controllerClass, $this->function], $this->arguments);

		// check if we are returning a string or response
		if(is_object($response)) {
			$response->print();
		}
		else {
			echo $response;
		}

		// make sure we only load 1 route ever. The first that we find
		$this->notFound = false;

		if($this->notFound) {
			echo response()->view('error/404', 404)->print();
		}
	}


	public function get($path, $controller, $function, $name = false)
	{
		$this->handleUrl($path, $controller, $function, $name);
	}


	public function post($path, $controller, $function, $name)
	{
		$this->handleUrl($path, $controller, $function, $name);
	}


	private function pathRegex($path)
	{
		// escape the slashes
		$path = '/'.str_replace('/', '\/', $path).'/';

		// replace the arguments for regex
		return preg_replace('/[{].*[}]/U' , '([^\/]+)', $path);
	}


	private function handleUrl($path, $controller, $function, $name)
	{
		if($name) {
			$this->addNamed($name, $path);
		}

		// match the arguments and path
		preg_match($this->pathRegex($path), $this->path, $arguments);

		// check if it matches the current path
		if(@$arguments[0] && $arguments[0] == $this->path) {

			// remove the path, leaves us with arguments
			array_shift($arguments);

			$this->function = $function;
			$this->path = $path;
			$this->controller = $controller;
			$this->name = $name;
			$this->arguments = $arguments;
		}

		$this->resetRouterSession();
	}


	private function addNamed($name, $path)
	{
		$this->namedRoutes[$name] = $path;
	}


	public function name($name, $parameters = [])
	{
		$url = preg_replace_callback('/[{].*[}]/U', function($matches) use ($parameters) {
			$argument = trim($matches[0], '{}');
			return $parameters[$argument];
		}, $this->namedRoutes[$name]);

		if($this->redirect) {
			header('Location: '.$this->domain.$this->publicPath.trim($url, '/'));
			die();
		}

		return $this->domain.$this->publicPath.trim($url, '/');
	}


	public function parameters()
	{
		return $this->parameters;
	}


	public function back($values = false, $errors = false)
	{
		if($values) {
			$_SESSION['router']['values'] = $values;
		}
		if($errors) {
			$_SESSION['router']['errors'] = $errors;
		}

		header('Location: '.$_SERVER['HTTP_REFERER']);

		die();
	}


	public function value($key)
	{
		if(@$_SESSION['router']['values'][$key]) {
			return $_SESSION['router']['values'][$key];
		}
	}


	public function errors($key = false)
	{
		if($key) {
			if(@$_SESSION['router']['errors'][$key]) {
				return $_SESSION['router']['errors'][$key];
			}
		}
		else {
			return $_SESSION['router']['errors'];
		}

	}


	public function resetRouterSession()
	{
		empty($_SESSION['router']);
		empty($_SESSION['values']);
	}


	public function redirect()
	{
		$this->redirect = true;
		return $this;
	}
}
