<?php 

/*
|--------------------------------------------------------------------------
| Server Functions
|--------------------------------------------------------------------------
|
| This value is the name of your application. This value is used when the
| framework needs to place the application's name in a notification or
| any other location as required by the application or its packages.
|
*/

function my_domain()
{
	return _server('HTTP_HOST');	
}

function my_ip()
{
	$ip = '';
	if (_server('SERVER_ADDR'))
		$ip = _server('SERVER_ADDR');
	else if(_server('HTTP_X_FORWARDED_FOR'))
		$ip = _server('HTTP_X_FORWARDED_FOR');
	else if(_server('HTTP_X_FORWARDED'))
		$ip = _server('HTTP_X_FORWARDED');
	else if(_server('HTTP_FORWARDED_FOR'))
		$ip = _server('HTTP_FORWARDED_FOR');
	else if(_server('HTTP_FORWARDED'))
		$ip = _server('HTTP_FORWARDED');
	else if(_server('REMOTE_ADDR'))
		$ip = _server('REMOTE_ADDR');
	else
		$ip = 'Anonymous IP';
	return $ip;
}

function my_browser()
{
	$browser = '';
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
		$browser = 'Netscape';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
		$browser = 'Firefox';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
		$browser = 'Chrome';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
		$browser = 'Opera';
	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
		$browser = 'Internet Explorer';
	else
		$browser = 'Other';
	return $browser;
}

function my_os()
{
	$u_agent = _server('HTTP_USER_AGENT');
	$platform = 'Unknown';
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'Linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'MAC';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'Windows';
	}
	return $platform;
}