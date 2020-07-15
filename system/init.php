<?php 

/*
|--------------------------------------------------------------------------
| App System init
|--------------------------------------------------------------------------
|
| Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
| aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
| cupidatat non proident, sunt in culpa qui officia deserunt.
|
*/

$_ENV['app']  = require_once 'app/config/App.php';
$_ENV['path'] = require_once 'app/config/Path.php';

if (!session_id()) session_start();

require_once 'system/App.php';
require_once 'system/SysRoute.php';
require_once 'system/Functions.php';
require_once 'system/Controller.php';
require_once 'app/routes/Routes.php';
require_once 'system/Error.php';