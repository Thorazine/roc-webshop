<?php

abstract class Validation {

	private $rules = [];
	private $result = [];
	private $error;

	public function __construct()
	{
		$this->rules = $this->validate();

		$this->rulesToArray()->runRules()->get();
	}

	abstract function validate();


	private function rulesToArray()
	{
		foreach($this->rules as &$rules) {
			$rules = explode('|', $rules);
		}

		return $this;
	}

	private function runRules()
	{
		$this->parameters = router()->parameters();

		foreach($this->rules as $key => $rules) {

			foreach($rules as $rule) {
				if($rule) {
					$this->{$rule}($key, $rule);
				}
			}
		}

		return $this;
	}

	private function required($key, $rule)
	{
		if(! in_array($key, array_keys($this->parameters)) || @$this->parameters[$key] == '') {
			$this->addErrorToResultByKey($key, $this->getError($rule));
		}
	}

	private function name()
	{

	}

	private function email()
	{

	}

	private function numeric()
	{

	}

	private function confirm($key, $rule)
	{
		if(! in_array($key.'_confirm', array_keys($this->parameters)) || $this->parameters[$key] != $this->parameters[$key.'_confirm']) {
			$this->addErrorToResultByKey($key, $this->getError($rule));
		}
	}

	public function addErrorToResultByKey($key, $error)
	{
		if(array_key_exists($key, $this->result)) {
			array_push($this->result[$key], $error);
		}
		else {
			$this->result[$key] = [$error];
		}
	}

	public function get()
	{
		if(count($this->result)) {
			router()->back($this->parameters, $this->result);
			return $result;
		}
	}

	public function getError($rule)
	{
		return lang('validation.php')[$rule];
	}
}
