<?php 

class sysRouteUrl extends App
{

	public static function route_security($str)
	{
		$server_url = self::parse_server_url($str);
		$client_url = self::parse_client_url();
		var_dump($server_url);
		var_dump($client_url);
		return self::url_same_check($server_url, $client_url);
	}

	private function parse_server_url($str)
	{
		$server_url = trim($str, '/');
		$server_url = filter_var($server_url, FILTER_SANITIZE_URL);
		$server_url = explode('/', $server_url);
		return $server_url;
	}

	private function parse_client_url()
	{
		$url = trim(self::url(), '/');
		$url = explode('/', $url);
		return $url;
	}

	private function url_same_check($server_url, $client_url)
	{
		if (count($server_url) == count($client_url)) 
		{
			$new_data_get = [];
			for ($i=0; $i < count($server_url); $i++) 
			{ 
				$first_symb = substr($server_url[$i], 0,1);
				$last_symb  = substr($server_url[$i], -1);
				if ($first_symb == '{' AND $last_symb == '}') 
				{
					$replace                 = [ '{' => '', '}' => '' ];
					$data_key                = str_replace(array_keys($replace), array_values($replace), $server_url[$i]);
					$new_data_get[$data_key] = $client_url[$i];
					$server_url[$i]          = $client_url[$i];
				}
			}
			parent::$data_route = $new_data_get;
			if ($server_url == $client_url)
			{
				self::set_data_get();
				return true;
			}
		}
		return false;
	}

	private function set_data_get()
	{
		$data_get = null;
		if (isset($_SERVER['REQUEST_URI'])) 
		{
			$data_get = [];
			$get_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
			$query_string = null;
			if(isset($get_uri[1])) $query_string = $get_uri[1];
			$array_level_1 = explode('&', $query_string);
			foreach ($array_level_1 as $x) 
			{
				$array_level_2 = explode('=', $x, 2);
				$value = null;
				if(isset($array_level_2[1])) $value = $array_level_2[1];
				$data_get[$array_level_2[0]] = $value;
			}
		}
		parent::$data_get = $data_get;
	}

	public function route_callback_function($callback)
	{
		if (is_string($callback) == false) 
		{
			$_callback = call_user_func($callback);
			if (is_null($_callback)) exit();
			if (is_string($_callback) == true) 
			{
				echo $_callback;
				exit();
			}
			return $_callback;
		}
	}

	public static function open_controller($callback)
	{
		$array      = $callback = explode('@', $callback, 2);
		$controller = $array[0];
		$method     = $array[1];
		if (count($array) != 2) $method = 'index';
		$file_location = $_ENV['path']['CONTROLLERS_DIR'] . $controller . '.php';
		if (is_file($file_location)) 
		{
			require_once $file_location;
			$object_controller = new $controller();
			if (method_exists($object_controller, $method) == false) 
			{
				$res_code = 406;
				http_response_code($res_code);
				/*@alevo-dev*/
				if (alevo_dev()) 
				{	
					require_once 'system\development\debug\init.php';
					alevoDebug::method_not_found($controller, $method, $res_code);
				}
				/*@end-alevo-dev*/
				exit();
			}
			$object_controller->$method();
			exit();
		}else{
			$res_code = 406;
			http_response_code($res_code);
			/*@alevo-dev*/
			if (alevo_dev()) 
			{
				require_once 'system\development\debug\init.php';
				alevoDebug::controller_not_found($controller, $res_code);
				exit();
			}
			/*@end-alevo-dev*/
		}
	}

	public static function method_not_allowed($_this_method, $req_method)
	{
		$res_code = 405;
		http_response_code($res_code);
		/*@alevo-dev*/
		if (alevo_dev()) 
		{
			require_once 'system\development\debug\init.php';
			alevoDebug::scurity_access_method($_this_method, $req_method, $res_code, App::url());
			exit();
		}
		/*@end-alevo-dev*/
	}

}