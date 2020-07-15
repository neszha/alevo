<?php 

class DebugThemes
{

	private static $color_white  = "#fff";
	private static $color_orange = "#f57900";
	private static $color_blue   = "#00bcd4";
	private static $color_yellow = "#FFC107";

	private static $template, $solutions_string, $error, $title, $problem, $solutions, $info, $preview;

	public static function theme_01($error = "Error!", $title = "", $problem = "", $solutions = [], $info = null)
	{
		self::$error            = $error;
		self::$title            = $title;
		self::$problem          = $problem;
		self::$solutions        = $solutions;
		self::$info             = $info;
		self::$template         = file_get_contents('system/development/debug/templates/DebugTheme01');
		self::$solutions_string = "";
		for ($i=0; $i < count($solutions); $i++) 
		{
			$string                 = $solutions[$i];
			$solutions_item         = "<div><i>-> {$string}</i></div>";
			self::$solutions_string = self::$solutions_string . $solutions_item;
		}
		echo self::theme_replace();
	}

	public static function debug_theme_string_preview($error = "Error!", $title = "", $preview = "", $info = null)
	{
		self::$error   = $error;
		self::$title   = $title;
		self::$problem = null;
		self::$preview = $preview;
		self::$info    = $info;
		self::$template = file_get_contents('system/development/debug/templates/StringPreview');
		echo self::theme_replace();
	}

	private static function theme_replace()
	{
		$replace = [
			"@--error--@"     => self::$error,
			"@--title--@"     => self::$title,
			"@--problem--@"   => self::$problem,
			"@--preview--@"   => self::$preview,
			"@--solutions--@" => self::$solutions_string,
			"@--info--@"      => self::$info,
			"@color-white"    => "style='color:". self::$color_white .";'",
			"@color-orange"   => "style='color:". self::$color_orange .";'",
			"@color-blue"     => "style='color:". self::$color_blue .";'",
			"@color-yellow"   => "style='color:". self::$color_yellow .";'",
		];

		return str_replace(array_keys($replace), array_values($replace), self::$template);
	}

}
