<?php
include_once "Validation.php";

class PayValidationCreate extends Validation {


	public function validate()
	{
		return [
			'first_name' => 'required|name',
			'suffix_name' => 'name',
			'last_name' => 'required|name',
			'country' => 'required|name',
			'city' => 'required|name',
			'zipcode' => 'required|nlZipcode',
			'street' => 'required|name',
			'street_number' => 'required|numeric',
			'street_number_suffix' => '',
			'email' => 'required|email|dbUnique',
			'password' => 'required|confirm',
		];
	}

	public function nlZipcode()
	{

	}

	// different users cannot have the same email address
	public function dbUnique($key, $rule)
	{
		if(db()->query('SELECT id FROM users WHERE email = :email', ['email' => $this->parameters[$key]])->first('User'))
		{
			$this->addErrorToResultByKey($key, $this->getError($rule));
		}
	}

}

new PayValidationCreate;
