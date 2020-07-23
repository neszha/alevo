<?php 

if ( ! isset($argv[1]))
{
	main_usage();
	exit;	
}

function get_cli_config($key)
{
	global $config;
	if( ! isset($config[$key])) return null;
	$data = $config[$key];
	$main = $data[0];
	$str = '';
	for($i = 0; $i < count($data); $i++)
	{
		if($i != 0) $str .= "[$data[$i]] ";
	}

	return (object) ['main' => $main, 'other' => $str];
}

function main_usage()
{
	$str = "usage: php alevo ? ";
	$str .= "[build] [mode] [make] [render] [serve] \n\n";
	$str .= ">> Main alevo command\n";
	$data = get_cli_config('build');
	$str .= "   {$data->main} \t {$data->other} \t Build app\n";
	$data = get_cli_config('mode');
	$str .= "   {$data->main} \t {$data->other} \t Change app to development or production mode\n";
	$data = get_cli_config('make');
	$str .= "   {$data->main} \t {$data->other} \t Make [model] & [controller]\n";
	$data = get_cli_config('render');
	$str .= "   {$data->main} \t {$data->other} \t Render [view] or [resource]\n";
	$data = get_cli_config('serve');
	$str .= "   {$data->main} \t {$data->other} \t Run development server\n";
	echo $str;
	exit();
}

function mode_help()
{
	$str = "usage: php alevo mode ? ";
	$str .= "[development] [production] \n\n";
	$str .= ">> Change app to production or development mode\n";
	$data = get_cli_config('development');
	$str .= "   {$data->main} \t {$data->other} \t Change app to development mode\n";
	$data = get_cli_config('production');
	$str .= "   {$data->main} \t {$data->other} \t Change app to production mode\n";
	echo $str;
	exit();
}

function make_help()
{
	$str = "usage: php alevo make ? ";
	$str .= "[controller] [model] \n\n";
	$str .= ">> Make model or controller\n";
	$data = get_cli_config('controller');
	$str .= "   {$data->main} \t {$data->other} \t Make controller. Ex: #... make controller className methodName\n";
	$data = get_cli_config('model');
	$str .= "   {$data->main} \t {$data->other} \t Make model. Ex: #... make model className methodName\n";
	echo $str;
	exit();
}

function make_controller_help()
{
	$str = "usage: php alevo make controller ? ";
	$str .= "[className] ? [methodName] \n\n";
	$str .= ">> Description:\n";
	$str .= "   className \t  Lorem ipsum dolor sit amet, consectetur.\n";
	$str .= "   methodName \t  Lorem ipsum dolor sit amet, consectetur. (optional)\n";
	echo $str;
	exit();
}

function make_model_help()
{
	$str = "usage: php alevo make model ? ";
	$str .= "[className] ? [methodName] \n\n";
	$str .= ">> Description:\n";
	$str .= "   className \t  Lorem ipsum dolor sit amet, consectetur.\n";
	$str .= "   methodName \t  Lorem ipsum dolor sit amet, consectetur. (optional)\n";
	echo $str;
	exit();
}

function render_help()
{
	$str = "usage: php alevo render ? ";
	$str .= "[all] [resource] [view] \n\n";
	$str .= ">> Render file in template engine system\n";
	$data = get_cli_config('all');
	$str .= "   {$data->main} \t\t {$data->other} \t\t Lorem ipsum dolor sit amet, consectetur.\n";
	$data = get_cli_config('resource');
	$str .= "   {$data->main} \t {$data->other} \t Lorem ipsum dolor sit amet, consectetur.\n";
	$data = get_cli_config('view');
	$str .= "   {$data->main} \t {$data->other} \t\t Lorem ipsum dolor sit amet, consectetur.\n";
	echo $str;
	exit();
}