<?php

Class Memory {

	// all the classes we want in memory
	public static $classes = [];
	public static $files = [];


	// check if a class excists
	public static function hasClass($class)
	{
		return array_key_exists($class, self::$classes);
	}


	// get the class we want
	public static function getClass($class)
	{
		if(! self::hasClass($class)) {
			self::createClass($class);
		}

		return self::$classes[$class];
	}


	// create the class and drop it in memory
	public static function createClass($class)
	{
		self::$classes[$class] = new $class;
	}

	public static function getFile($filename)
	{
		if(! array_key_exists($filename, self::$files)) {
			self::$files[$filename] = include_once $filename;
		}
		return self::$files[$filename];
	}
}
