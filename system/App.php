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

	public static function url()
	{
		if (isset($_GET['url'])) return $_GET['url'];
		if (isset($_SERVER['PATH_INFO'])) 
		{
			$url = preg_replace('/^\//', null, $_SERVER['PATH_INFO']);
			return $url;
		}
		return '';
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

	public static function this_url()
	{
		$protocol = 'http';
		if(isset($_SERVER['HTTPS_ON'])) $protocol = 'https';
		$host = $_SERVER['HTTP_HOST'];
		$path = self::url();
		$this_url = "$protocol://$host/$path";
		return $this_url;
	}

}