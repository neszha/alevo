<?php 


class TextColorX
{
	public function grey($x)
	{
		return "\033[1m{$x}\033[0m";
	}

	public function red($x)
	{
		return "\033[91m{$x}\033[0m";
	}

	public function green($x)
	{
		return "\033[92m{$x}\033[0m";
	}

	public function yellow($x)
	{
		return "\033[93m{$x}\033[0m";
	}

	public function blue($x)
	{
		return "\033[94m{$x}\033[0m";
	}
}

class BackgroundColorX
{
	public function cyan($x)
	{
		return "\033[45m{$x}\033[0m";
	}

	public function red($x)
	{
		return "\033[41m{$x}\033[0m";
	}

	public function blue($x)
	{
		return "\033[44m{$x}\033[0m";
	}
}

function loop_line_string($string, $delay = 10000)
{
	if (App::from_cli())
	{
		$array = str_split($string);
		foreach ($array as $x)
		{
			echo $x;
			usleep($delay);
		}
		echo "\n";
	}
}

function log_warning($str)
{
	if (App::from_cli())
	{
		$tx = new TextColorX();
		$x = "\n.\n..\n";
		$x .= ">>>>>[ {$tx->yellow('WARNING')} ]--> $str\n";
		$x .= "..\n.\n\n";
		echo $x;
	}
}

function log_success($str)
{
	if (App::from_cli())
	{
		$tx = new TextColorX();
		$x = "\n.\n..\n";
		$x .= ">>>>>[ {$tx->green('SUCCESS')} ]--> $str\n";
		$x .= "..\n.\n\n";
		echo $x;
	}
}

function show_log($str, $usleep = 10000, $fixed = false)
{
	$string = $str;
	if(!isset($_ENV['strlen'])) $_ENV['strlen'] = strlen($str);
	$x = $_ENV['strlen'];
	$y = strlen($str);
	if($y < $x)
	{
		$null = " ";
		$z    = $x - $y;
		$null .= str_repeat('  ', $z);
		$str .= $null;
	}
	$_ENV['strlen'] = strlen($string);
	if($fixed)
	{
		echo $str ."\r";
	}else{
		echo $str ."\n";
	}
	usleep($usleep);
}

function log_begin($str)
{
	if (App::from_cli())
	{
		$x = "\n.\n..\n";
		$x .= "----------------[ $str ]-->> \n";
		$x .= "..\n.\n\n";
		echo $x;
	}
}

function log_main_begin($str, $val = null)
{
	if (App::from_cli())
	{
		$tx = new TextColorX();
		$x = "\n.\n..\n";
		$x .= "====================[ {$tx->red($str)} ]===>> $val \n";
		$x .= "..\n.\n\n";
		echo $x;
		sleep(1);
	}
}

function log_end()
{
	if (App::from_cli())
	{
		$x = "...\n";
		$x .= "..\n";
		$x .= ".\n";
		echo $x;
	}
}

function render_file_scan($data, $end = false)
{
	if (App::from_cli())
	{
		$tx = new TextColorX();
		$bg = new BackgroundColorX();
		$symb = loading_symbol_rand();
		if(!$end) {
			$x = "{$tx->grey("[... $symb ...]")} {$bg->cyan("file scan")} $data[1] {$tx->red("path")} $data[0]";
			show_log("$x", 40000, true);
		}else{
			$x = "{$tx->grey("[... 100% ...]")} {$bg->cyan("file scan")} found: {$data->total} file. elapsed: {$data->elapsed} sec.";
			show_log("$x", 30000);
		}
	}
}

function remove_rendered_view($data, $end = false)
{
	if (App::from_cli())
	{
		$tx = new TextColorX();
		$bg = new BackgroundColorX();
		$symb = loading_symbol_rand();
		if(!$end) {
			$x = "{$tx->grey("[... $symb ...]")} {$bg->red("remove view")} $data";
			show_log("$x", 40000, true);
		}else{
			$x = "{$tx->grey("[... 100% ...]")} {$bg->red("remove view")} removed: {$data->total} file. elapsed: {$data->elapsed} sec.";
			show_log("$x", 30000);
		}
	}
}

function remove_rendered_resource($data, $end = false)
{
	if (App::from_cli())
	{
		$tx = new TextColorX();
		$bg = new BackgroundColorX();
		$symb = loading_symbol_rand();
		if(!$end) {
			$x = "{$tx->grey("[... $symb ...]")} {$bg->red("remove resource")} $data";
			show_log("$x", 40000, true);
		}else{
			$x = "{$tx->grey("[... 100% ...]")} {$bg->red("remove resource")} removed: {$data->total} file. elapsed: {$data->elapsed} sec.";
			show_log("$x", 30000);
		}
	}
}

function render_view($data, $end = false)
{
	if (App::from_cli())
	{
		$tx = new TextColorX();
		$bg = new BackgroundColorX();
		$symb = loading_symbol_rand();
		if(!$end) {
			$status_bar = '[';
			$status_bar .= str_repeat('=', $data->bar);
			$status_bar .= str_repeat('-', $data->size - $data->bar) . ']';
			$disp = number_format($data->perc * 100, 0);
			$x = "$status_bar $disp%  $data->done/$data->total {$bg->blue('render view')} $data->path";
			show_log("$x", 40000, true);
		}else{
			$x = "{$tx->grey("[... 100% ...]")} {$bg->blue("render view")} total: {$data->total} file. elapsed: {$data->elapsed} sec.";
			show_log("$x", 30000);
		}
	}
}

function render_resource($data, $end = false)
{
	if (App::from_cli())
	{
		$tx = new TextColorX();
		$bg = new BackgroundColorX();
		$symb = loading_symbol_rand();
		if(!$end) {
			$status_bar = '[';
			$status_bar .= str_repeat('=', $data->bar);
			$status_bar .= str_repeat('-', $data->size - $data->bar) . ']';
			$disp = number_format($data->perc * 100, 0);
			$x = "$status_bar $disp%  $data->done/$data->total {$bg->blue('render resource')} $data->path";
			show_log("$x", 40000, true);
		}else{
			$x = "{$tx->grey("[... 100% ...]")} {$bg->blue("render resource")} total: {$data->total} file. elapsed: {$data->elapsed} sec.";
			show_log("$x", 30000);
		}
	}
}

function loading_symbol_rand()
{
	$array = ["[", "]", "#", "/", "|", "<", ">", "~", "+", "-", "+", "=", "?"];
	$i = array_rand($array);
	return $array[$i];
}

function unknown()
{
	if (App::from_cli())
	{
		$tx = new TextColorX();
		echo ".\n=====<<==[ {$tx->red("Command Unknown")} ]==>>=====\n.\n";
	}
}
