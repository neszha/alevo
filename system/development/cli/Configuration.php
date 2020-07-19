<?php 

/*
|--------------------------------------------------------------------------
| CLI Configuration
|--------------------------------------------------------------------------
|
| Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
| aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
| cupidatat non proident, sunt in culpa qui officia deserunt.
|
*/


/**
 *	argv 1
 */
$config['render'] = ['render', '-r'];
$config['build']  = ['build', '-b'];
$config['mode']   = ['mode', '-M'];
$config['make']   = ['make', '-m'];
$config['serve']  = ['serve', '-s'];

/**
 *	argv 2
 */
$config['view']        = ['view', '-V'];
$config['resource']    = ['resource', 'res', '-R'];
$config['all']    = ['all', '-a'];
$config['controller']  = ['controller', 'con' ,'-C'];
$config['model']       = ['model', 'mod' ,'-M'];
$config['development'] = ['development', 'dev', '-D'];
$config['production']  = ['production', 'prod', '-P'];
