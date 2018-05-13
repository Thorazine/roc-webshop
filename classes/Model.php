<?php

Class Model
{

	public $data;

	public function first()
	{
		return $this->data[0];
	}


	public function setData($data)
	{
		$this->data = $data;

		return $this;
	}

	public function __get($method)
	{
		return 'bla';
	}
}
