<?php

/*
|--------------------------------------------------------------------------
| Super Global Functions
|--------------------------------------------------------------------------
|
| This value is the name of your application. This value is used when the
| framework needs to place the application's name in a notification or
| any other location as required by the application or its packages.
|
*/

function _post($x = false)
{
	if ($x == false) return $_POST;
	if (isset($_POST[$x])) return $_POST[$x];
	return null;
}

function _get($x = false)
{
	if ($x == false) return Route::_get();
	return Route::_get($x);
}

function _data($x = false)
{
	if ($x == false) return Route::data();
	return Route::data($x);
}

function _session($x = false)
{
	if ($x == false) return $_SESSION;
	if (isset($_SESSION[$x])) return $_SESSION[$x];
	return null;
}

function _set_session($x, $value)
{
	$_SESSION[$x] = $value;
}

function _remove_session($x = false)
{
	if ($x == false) unset($_SESSION);
	unset($_SESSION[$x]);
}

function _global($x = false)
{
	if ($x == false) return $GLOBALS;
	if (isset($GLOBALS[$x])) return $GLOBALS[$x];
	return null;
}

function _set_globals($x, $value)
{
	$GLOBALS[$x] = $value;
}

function _server($x = false)
{
	if ($x == false) return $_SERVER;
	if (isset($_SERVER[$x])) return $_SERVER[$x];
	return null;
}

function _config($x = false, $y = false)
{
	if ($x == false) return $_ENV;
	if ($y == false) if (isset($_ENV[$x])) return $_ENV[$x];
	if (isset($_ENV[$x][$y])) return $_ENV[$x][$y];
	return null;
}