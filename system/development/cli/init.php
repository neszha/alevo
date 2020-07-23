<?php 

$_ENV['FROM_CLI']       = true;
$_ENV['app']            = require_once 'app/config/App.php';
$_ENV['path']           = require_once 'app/config/Path.php';
$_ENV['development']    = require_once 'app/config/Development.php';
$_ENV['database']       = require_once 'app/config/Database.php';
$_ENV['templateEngine'] = require_once 'app/config/TemplateEngine.php';

require_once 'system/App.php';
require_once 'system/development/cli/Configuration.php';
require_once 'system/development/cli/helpers.php';
require_once 'system/development/cli/core/Effects.php';
require_once 'system/development/cli/core/AlevoDevelopmentApp.php';
require_once 'system/development/cli/core/AlevoRunCommand.php';
