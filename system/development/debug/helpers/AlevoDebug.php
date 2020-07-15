<?php 

class alevoDebug extends DebugThemes
{
	public static function model_not_found($model, $res_code)
	{
		$model_dir = $_ENV['path']['MODELS_DIR'];
		$error = "Error {$res_code}!";
		$title = "File model not found!";
		$problem = "File <i @color-orange>{$model}.php</i> not found in directory models";
		$solutions = [
			"Check file name",
			"Check model file in directiory <span @color-orange>{$model_dir}</span>",
		];
		DebugThemes::theme_01($error, $title, $problem, $solutions);
	}

	public static function controller_not_found_from_run($controller, $res_code)
	{
		$controller_dir = $_ENV['path']['CONTROLLERS_DIR'];
		$error = "Error {$res_code}!";
		$title = "File controller not found!";
		$problem = "File <i @color-orange>{$controller}.php</i> not found in directory controllers";
		$solutions = [
			"Check file name",
			"Check controller file in directiory <span @color-orange>{$controller_dir}</span>",
		];
		DebugThemes::theme_01($error, $title, $problem, $solutions);
	}

	public static function controller_not_found($controller, $res_code)
	{
		$controller_dir = $_ENV['path']['CONTROLLERS_DIR'];
		$error = "Error {$res_code}!";
		$title = "File controller not found!";
		$problem = "File <i @color-orange>{$controller}.php</i> not found in directory controllers";
		$solutions = [
			"Check file name",
			"Check callback name in routes",
			"Check callback name when call the controller file",
			"Check controller file in directiory <span @color-orange>{$controller_dir}</span>",
		];
		DebugThemes::theme_01($error, $title, $problem, $solutions);
	}

	public static function method_not_found($controller, $method, $res_code)
	{
		$error = "Error {$res_code}!";
		$title = "Method not found!";
		$problem = "<i @color-orange>{$method}</i> method is't found in <i @color-orange>{$controller}.php</i>";
		$solutions = [
			"Check method name",
			"Check method existence in <i @color-orange>{$controller}.php</i>",
			"Check callback name in routes file",
		];
		DebugThemes::theme_01($error, $title, $problem, $solutions);
	}

	public static function scurity_access_method($_this_method, $req_method, $res_code, $url)
	{
		$error = "Error {$res_code}!";
		$title = "Request method {$req_method} not allowed!";
		$problem = "You can't access <i @color-orange>{$url}</i> with request method <i @color-orange>{$req_method}</i>!";
		$solutions = [
			"Check request method",
			"Only <i @color-orange>{$_this_method}</i> method is allowed",
			"Check request and response headers",
		];
		DebugThemes::theme_01($error, $title, $problem, $solutions);
	}

	public static function database_is_off()
	{
		$error = "Database Error!";
		$title = "Database is Off!";
		$problem = "The use database configuration is <i @color-orange>false</i>";
		$solutions = [
			"Check database configuration",
			"Change <i @color-orange>'DATABASE' => false</i> to <i @color-orange>'DATABASE' => true</i> if using database",
		];
		DebugThemes::theme_01($error, $title, $problem, $solutions);
	}

	public static function view_not_found($view_name, $view_dir)
	{
		$view_path = str_replace(".", "/", $view_name) . ".php";
		$error = "View Error!";
		$title = "View not found!";
		$problem = "<i @color-orange>{$view_path}</i> file view was't found in the directory <i @color-orange>{$view_dir}</i>";
		$solutions = [
			"Check your view file name.",
			"Check your view name <span @color-yellow>=> {$view_name}</span>",
		];
		DebugThemes::theme_01($error, $title, $problem, $solutions);
	}

	public static function file_not_exists($file_path)
	{
		$error = "File Error!";
		$title = "File not exists!";
		$problem = "Can't get file <i @color-orange>{$file_path}</i>";
		$solutions = [
			"Check file name",
		];
		DebugThemes::theme_01($error, $title, $problem, $solutions);
	}
	
}