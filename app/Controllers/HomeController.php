<?php

Class HomeController extends Controller
{

	public function index()
	{
		// dd(router()->name('product.test', ['product' => 'fiets', 'nogiets' => 'bla']));
		$products = db()->query('SELECT * FROM products')
			->orderBy('id', 'DESC')
			->limit(3)
			->select('Product');

		return response()->view('home')
			->with('products', $products);
	}
}
