<?php 

class sysRouteGroup extends App
{
	public static function route_group_security($str)
	{
		$server_url = self::parse_group_server_url($str);
		$client_url = self::parse_group_client_url($server_url);
		return self::group_url_same_check($server_url, $client_url);
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
		$client_url     = parent::parseURL();
		$new_client_url = [];
		for ($i=0; $i < count($array_url); $i++) 
		{
			$new_client_url[] = $client_url[$i];
		}
		return $new_client_url;
	}

	private static function group_url_same_check($server_url, $client_url)
	{
		if (count($server_url) == count($client_url)) 
		{
			for ($i=0; $i < count($server_url); $i++) 
			{
				$first_symb = substr($server_url[$i], 0,1);
				$last_symb  = substr($server_url[$i], -1);
				if ($first_symb == '{' AND $last_symb == '}') 
				{
					$server_url[$i] = $client_url[$i];
				}
			}
			if ($server_url == $client_url) return true;
		}
		return false;
	}

	public static function route_group_callback_function($callback)
	{
		if (is_string($callback) == false) 
		{
			$_callback = call_user_func($callback);

			if (is_string($_callback) == true) 
			{
				echo $_callback;
				exit();
			}
			return $_callback;
		}
	}

}