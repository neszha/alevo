<?php

/**
 * alevo Route System
 *
 * Lorem ipsum dolor sit amet, consectetur adipisicing elit.
 *
 * @package		alevo
 * @author		Fanesa Hadi Pramana
 */

class Route extends App
{
	/**
	 * Lorem ipsum dolor sit amet, consectetur adipisicing elit.
	 *
	 * @var	string
	 */
	private static $group_url;

	/**
	 * Route group
	 *
	 * Lorem ipsum dolor sit amet, consectetur adipisicing elit.
	 *
	 * @param	string	Route url
	 * @param	object	callback
	 * @return  object	
	 */

	public static function group($str, $callback)
	{
		require_once 'system/lib/sysRouteGroup.php';
		$str = self::$group_url . $str;
		if (sysRouteGroup::route_group_security($str) == true) 
		{
			self::$group_url = $str;
			return sysRouteGroup::route_group_callback_function($callback);
		}
	}

	/**
	 * Route get
	 *
	 * Lorem ipsum dolor sit amet, consectetur adipisicing elit.
	 *
	 * @param	string	Route url
	 * @param	object	callback
	 * @todo  			To get controller code or view string with GET method
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

	/**
	 * Route redirect
	 *
	 * Lorem ipsum dolor sit amet, consectetur adipisicing elit.
	 *
	 * @param	string	url
	 * @param	string	url
	 * @todo  			Redirect to other url
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

	/**
	 * Route post
	 *
	 * Lorem ipsum dolor sit amet, consectetur adipisicing elit.
	 *
	 * @param	string	Route url
	 * @param	object	callback
	 * @todo  			To get controller code or view string with POST method
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

	/**
	 * Route match
	 *
	 * Lorem ipsum dolor sit amet, consectetur adipisicing elit.
	 *
	 * @param	array	Method
	 * @param	string	Route url
	 * @param	object	callback
	 * @todo  			To match method
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

	/**
	 * Route view
	 *
	 * lorem other location as required by the application or its packages.
	 *
	 * @param	string	Route url
	 * @param	string	View name
	 * @todo			Get view file and open it
	 */

	public static function view($route, $view)
	{
		require_once 'system/lib/sysRouteUrl.php';
		if (sysRouteUrl::route_security($route) == true)
		{
			require_once 'system/lib/sysView.php';
			$obj = new sysView();
			$path = $obj->view_engine($view);
			if(is_file($path)) require_once $path;
			exit();
		}
	}

	/**
	 * Route data
	 *
	 * lorem other location as required by the application or its packages.
	 *
	 * @param	string	Key to get data (optional)
	 * @return 	array	Return array or string
	 */

	public static function data($param = false)
	{
		$data = parent::$data_route;
		if (!$param) return $data;
		if (isset($data[$param])) return $data[$param];
		return $data[$param];
	}

	/**
	 * Route _get
	 *
	 * lorem other location as required by the application or its packages.
	 *
	 * @param	string	Key to get data (optional)
	 * @return 	array	Return array or string
	 */

	public static function _get($param = false)
	{
		$data = parent::$data_get;
		if (!$param) return $data;
		if (isset($data[$param])) return $data[$param];
		return null;
	}

}
