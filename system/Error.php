<?php

/*
|--------------------------------------------------------------------------
| Page Not Found 
|--------------------------------------------------------------------------
|
| Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
| aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
| cupidatat non proident, sunt in culpa qui officia deserunt.
|
*/

$main_config = $_ENV['app']['PAGE_NOT_FOUND'];
http_response_code($main_config['response_code']);
if ($main_config['view_page'] == true)
{
	require_once 'system/lib/sysView.php';
	$path = sysView::view_engine($main_config['view']);
	require_once $path;
}
exit();