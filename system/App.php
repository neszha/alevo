<?php

/*
|--------------------------------------------------------------------------
| App System
|--------------------------------------------------------------------------
|
| Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
| aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
| cupidatat non proident, sunt in culpa qui officia deserunt.
|
*/

class App
{
	public static $data_route = null;
	public static $data_get   = null;

	// public static function remove_sub_url($url)
	// {
	// 	global $config;
	// 	$base_url_array = explode('/', $config['base_url']);
	// 	$url            = str_replace(array_values($base_url_array), '', $url);
	// 	return $url;
	// }

	public static function url()
	{
		if (isset($_GET['url'])) return $_GET['url'];
		// if (isset($_SERVER['PATH_INFO'])) 
		// {
		// 	$url = $_SERVER['PATH_INFO'];
		// 	$url = self::remove_sub_url($url);
		// 	return $url;
		// }
		return '';
	}

	public static function parseURL()
	{
		if (self::url()) 
		{
			$url = trim(self::url(), '/');
			$url = explode('/', $url);
			return $url;
		}
		return [''];
	}

	public static function dev()
	{
		$path = 'app/config/Development.php';
		if(is_file($path))
		{
			if(!isset($_ENV['development'])) $_ENV['development'] = require_once $path;
			return $_ENV['development']['DEVELOPMENT'];
		}
		return false;
	}

	public static function from_cli()
	{
		if (isset($_ENV['FROM_CLI'])) return $_ENV['FROM_CLI'];
		return false;
	}

}