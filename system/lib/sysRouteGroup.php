<?php 

class sysRouteGroup extends App
{
	public static function route_group_security($str)
	{
		$server_url = self::parse_group_server_url($str);
		$client_url = self::parse_group_client_url($server_url);
		return self::group_url_check($server_url, $client_url);
	}

	private static function parse_group_server_url($str)
	{
		$server_url = trim($str, '/');
		$server_url = filter_var($server_url, FILTER_SANITIZE_URL);
		$server_url = explode('/', $server_url);
		return $server_url;
	}

	private static function parse_group_client_url($array_url)
	{
		$url = trim(self::url(), '/');
		$url = explode('/', $url);
		$new_url = [];
		for ($i = 0; $i < count($array_url); $i++) $new_url[] = $url[$i];
		return $new_url;
	}

	private static function group_url_check($server_url, $client_url)
	{
		if (count($server_url) == count($client_url)) 
		{
			for ($i = 0; $i < count($server_url); $i++) 
			{
				if (preg_match('/\{.+\}$/', $server_url[$i])) $server_url[$i] = $client_url[$i];
			}
			if ($server_url == $client_url) return true;
		}
		return false;
	}

	public static function route_group_callback_function($callback)
	{
		if (!is_string($callback)) 
		{
			$_callback = call_user_func($callback);
			if (is_string($_callback)) 
			{
				echo $_callback;
				exit();
			}
			return $_callback;
		}
	}

}