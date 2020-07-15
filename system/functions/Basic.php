<?php 

/*
|--------------------------------------------------------------------------
| Basic Functions
|--------------------------------------------------------------------------
|
| This value is the name of your application. This value is used when the
| framework needs to place the application's name in a notification or
| any other location as required by the application or its packages.
|
*/

function base_url($x = false)
{
	if ($x == false) return $_ENV['app']['BASE_URL'];
	return $_ENV['app']['BASE_URL'] . $x;
}

function assets($x = false)
{
	if ($x == false) return $_ENV['app']['BASE_URL'] . '/assets';
	return $_ENV['app']['BASE_URL'] . '/assets' . $x;
}

function time_now()
{
	return date('Y-m-d h:i:s');
}

function redirect($x)
{
	header('Location:' . $_ENV['app']['BASE_URL'] . $x);
}

function cache_version()
{
	if ($_ENV['development']['DEVELOPMENT'] == true) return uniqid() . uniqid();
	return $_ENV['app']['APP_VERSION'] . $x;
}

function alevo_dev()
{
	return $_ENV['development']['DEVELOPMENT'];
}

function save_file($path)
{
	require_once "system/lib/sysPath.php";
	$obj = new sysPath();
	$obj->check_and_make_file($path);
}

function make_dir($path)
{
	require_once "system/lib/sysPath.php";
	$obj = new sysPath();
	$obj->check_and_make_dir($path);
}

function url()
{
	if (isset($_SERVER['PATH_INFO'])) 
	{
		return base_url() . $_SERVER['PATH_INFO'];
	}else{
		return base_url() . $_SERVER['REQUEST_URI'];
	}
}