<?php

class Respond {

	private $httpResponseCode = 200;
	private $header = 'Content-Type: text/html';
	private $hasContent = false;
	private $defaultViewPath = '../views/';
	public $content = null;
	private $values = [];
	private $view = null;


	public function response($content = '', $httpResponseCode = 200)
	{
		if($content) {
			$this->hasContent = true;
			$this->content = $content;
		}
		return $this;
	}


	public function view($file = false, $httpResponseCode = 200)
	{
		if(! $file) {
			throw new Exception('No file provided');
		}

		$this->httpResponseCode = $httpResponseCode;
		http_response_code($httpResponseCode);

		if(pathinfo($file, PATHINFO_EXTENSION) != 'php') {
			$file = $file.'.php';
		}

		if(! file_exists($this->defaultViewPath . $file)) {
			throw new Exception('File does not exist');
		}

		$this->view = $file;

		return $this;
	}


	public function json($data, $httpResponseCode = 200)
	{
		$this->httpResponseCode = $httpResponseCode;

		if($this->hasContent) {
			throw new Exception('Headers already sent');
		}

		header('Content-Type: application/json');
		$this->content = json_encode($data);

		return $this;
	}


	public function print()
	{
		if($this->view) {
			// load the view into a variable

			try {
				foreach($this->values as $name => $value) {
					${$name} = $value;
				}

			    require($this->defaultViewPath . $this->view);

			}
			catch(Exception $e) {
				dd($e->getMessage());
			}
		}

		return $this->content;
	}


	public function with($name, $value)
	{
		$this->values[$name] = $value;

		return $this;
	}
}
