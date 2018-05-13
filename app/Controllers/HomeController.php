<?php

Class HomeController extends Controller
{

	public function index()
	{
		// dd(router()->name('product.test', ['product' => 'fiets', 'nogiets' => 'bla']));
		$products = db('Product')->select('SELECT * FROM products')
			->orderBy('id', 'DESC')
			->limit(3)
			->get();

		return response()->view('home')
			->with('products', $products);
	}
}
