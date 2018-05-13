<?php

Class ProductController extends Controller
{

	public function index($slug)
	{
		$product = db('Product')->select('SELECT * FROM products WHERE slug = :slug', ['slug' => $slug])
			->first();

		return response()->view('product')
			->with('product', $product);
	}
}
