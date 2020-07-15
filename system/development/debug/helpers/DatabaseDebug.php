<?php 

class databaseDebug extends DebugThemes
{
	private static $class, $method, $file, $line;

	private static function set_error_info()
	{
		$debug = debug_backtrace();
		// var_dump($debug);
		for ($i=0; $i < count($debug); $i++)
		{ 
			if (isset($debug[$i]['class'])) 
			{
				if ($debug[$i]['class'] == 'DB')
				{
					self::$file   = $debug[$i]['file'];
					self::$line   = $debug[$i]['line'];
					self::$class  = $debug[$i+1]['class'];
					self::$method = $debug[$i+1]['function'];
				}
			}
		}
	}

	public static function db_mysql_show_sql_syntax($sql, $res_code)
	{
		self::set_error_info();
		$error = "SQL Syntax";
		$title = "Preview SQL Syntax!";
		$sql   = "=> <span @color-orange>{$sql}</span>";
		$file  = self::$file;
		$line  = self::$line;
		$info  = "Result on file {$file} | on line {$line}";
		DebugThemes::debug_theme_string_preview($error, $title, $sql, $info);
		http_response_code($res_code);
	}

	public static function db_mysql_query_builder_error($x, $sql, $res_code)
	{
		self::set_error_info();
		$error     = "Query falied!";
		$title     = "{$x} is falied!";
		$problem   = "- The database mysql query <i @color-orange>{$x}</i> is falied.<br>- Preview SQL Syntax => <i @color-orange>{$sql}</i>";
		$solutions = [
			"Check SQL Syntax.",
			"Check Query Builder.",
		];
		$file   = self::$file;
		$method = self::$class . '::' . self::$method;
		$line   = self::$line;
		$info   = "An error occurred on file {$file} | {$method}() | line {$line}";
		DebugThemes::theme_01($error, $title, $problem, $solutions, $info);
		http_response_code($res_code);
	}

	public static function db_mysql_database_off($mess, $res_code)
	{
		$error = "DB OFF!";
		$title = "MYSQL database is off!";
		$problem = "{$mess}";
		$solutions = [
			"Trun on Mysql Database Server.",
			"Check database configuration.",
		];
		DebugThemes::theme_01($error, $title, $problem, $solutions);
		http_response_code($res_code);
	}

}