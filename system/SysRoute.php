<?php

/*
|--------------------------------------------------------------------------
| Route System
|--------------------------------------------------------------------------
|
| This value is the name of your application. This value is used when the
| framework needs to place the application's name in a notification or
| any other location as required by the application or its packages.
|
*/

class Route extends App
{
	private $string;
	private $callback;
	private static $group_url = '';

	/*
	|--------------------------------------------------------------------------
	| Route::group(url, callback)
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	public static function group($str, $callback)
	{
		require_once 'system/lib/sysRouteGroup.php';
		$str = self::$group_url . $str;
		if (sysRouteGroup::route_group_security($str) == true) 
		{
			self::$group_url = $str;
			return sysRouteGroup::route_group_callback_function($callback);
			exit();
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Route::get(url, callback)
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	public static function get($str, $callback)
	{
		require_once 'system/lib/sysRouteUrl.php';
		$str = self::$group_url . $str;
		if (sysRouteUrl::route_security($str) == true) 
		{
			$method     = strtolower('GET');
			$req_method = strtolower($_SERVER['REQUEST_METHOD']);
			if ($req_method == 'get') 
			{
				sysRouteUrl::route_callback_function($callback);
				sysRouteUrl::open_controller($callback);
			}else{
				sysRouteUrl::method_not_allowed($method, $req_method);
			}
			exit();
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Route::redirect(from, to)
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	public static function redirect($from, $to)
	{
		require_once 'system/lib/sysRouteUrl.php';
		$url = self::$group_url . $from;
		if (sysRouteUrl::route_security($url) == true) 
		{
			$url = $_ENV['app']['BASE_URL'] . self::$group_url . $to;
			header("Location: {$url}");
			exit();
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Route::post(url, callback)
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	public static function post($str, $callback)
	{
		require_once 'system/lib/sysRouteUrl.php';
		$str = self::$group_url . $str;
		if (sysRouteUrl::route_security($str) == true) 
		{
			$method     = strtolower('POST');
			$req_method = strtolower($_SERVER['REQUEST_METHOD']);
			if ($req_method == $method) 
			{
				sysRouteUrl::route_callback_function($callback);
				sysRouteUrl::open_controller($callback);
			}else{
				sysRouteUrl::method_not_allowed($method, $req_method);
			}
			exit();
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Route::match(methods, url, callback)
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	public static function match($methods, $str, $callback)
	{
		require_once 'system/lib/sysRouteUrl.php';
		$str    = self::$group_url . $str;
		if (sysRouteUrl::route_security($str) == true) 
		{
			$req_method = strtolower($_SERVER['REQUEST_METHOD']);
			$methods = array_map('strtolower', $methods);
			if (in_array($req_method, $methods))
			{
				sysRouteUrl::route_callback_function($callback);
				sysRouteUrl::open_controller($callback);
			}else{
				sysRouteUrl::method_not_allowed($method, $req_method);
			}
			exit();
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Route::view(url, view)
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	public static function view($string, $view_name)
	{
		require_once 'system/lib/sysRouteUrl.php';
		if (sysRouteUrl::route_security($string) == true)
		{
			require_once 'system/lib/sysView.php';
			$obj = new sysView();
			require_once $obj->view_engine($view_name);
			exit();
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Route::data(string)
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	public static function data($param = false)
	{
		$data = parent::$data_route;
		if ($param == false) return $data;
		if(isset($data[$param])) return $data[$param];
		return $data[$param];
	}

	/*
	|--------------------------------------------------------------------------
	| Route::_get(string)
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	public static function _get($param = false)
	{
		$data = parent::$data_get;
		if ($param == false) return $data;
		if(isset($data[$param])) return $data[$param];
		return null;
	}

}
