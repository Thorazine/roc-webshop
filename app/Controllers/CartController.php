<?php

Class CartController extends Controller
{

	public function add($id)
	{

		Cart::addToCart($id);

		return response()->view('partials/bucket');
	}

	public function remove($id)
	{
		Cart::removeFromCart($id);

		return response()->view('partials/bucket');
	}
}
