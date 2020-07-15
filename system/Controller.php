<?php 

/*
|--------------------------------------------------------------------------
| Controller System
|--------------------------------------------------------------------------
|
| Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
| aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
| cupidatat non proident, sunt in culpa qui officia deserunt.
|
*/

class Controller extends App
{
	private static $data = '';

	/*
    |--------------------------------------------------------------------------
    | $this->view('string')
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */

	public function view($view, $data = [] )
	{
		require_once 'system/lib/sysView.php';
		$object = new sysView();
		$res = $object->view_engine($view);
		require_once $res;
	}

	/*
    |--------------------------------------------------------------------------
    | $this->run('controller')
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */

	public function run($controller)
	{
		$path = $_ENV['path']['CONTROLLERS_DIR'] . $controller . '.php';
		if (file_exists($path)) 
		{
			require_once $path;
			return new $controller;
		}else{
			require_once 'system\development\debug\init.php';
			alevoDebug::controller_not_found_from_run($controller, 406);
			exit();
		}
	}

	/*
    |--------------------------------------------------------------------------
    | $this->resource('path')
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */

	public function res($key)
	{
		require_once 'system/lib/sysResource.php';
		$object = new sysResource();
		return $object->get_resource_path($key);
	}

	/*
    |--------------------------------------------------------------------------
    | $this->model('model')
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */

	public function model($model)
	{
		$path = $_ENV['path']['MODELS_DIR'] . $model . '.php';
		if (file_exists($path)) 
		{
			require_once 'system/Database.php';
			require_once $path;
			return new $model;
		}else{
			require_once 'system\development\debug\init.php';
			alevoDebug::model_not_found($model, 406);
			exit();
		}
	}

	/*
    |--------------------------------------------------------------------------
    | $this->data()
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */
    
	public function data()
	{
		return self::$data;
	}

	/*
    |--------------------------------------------------------------------------
    | OTHER MEDHOTS
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
    | aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
    | cupidatat non proident, sunt in culpa qui officia deserunt.
    |
    */

}