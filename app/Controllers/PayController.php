<?php

Class PayController extends Controller
{

	public function index()
	{
		return response()->view('pay');
	}


	public function create()
	{
		return 'created';
	}
}
