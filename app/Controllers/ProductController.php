<?php

Class ProductController extends Controller
{

	public function index($slug)
	{
		$product = db()->query('SELECT * FROM products WHERE slug = :slug', ['slug' => $slug])
			->first('Product');

		return response()->view('product')
			->with('product', $product);
	}
}
