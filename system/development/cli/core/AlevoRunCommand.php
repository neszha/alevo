<?php 

// $dir              = 'system/development/cli/';
// $notif            = $dir . 'templates/notifications/';

// if ($config['development'] != true) 
// {
// 	$notif = file_get_contents($notif . 'dev');
// 	echo $notif;
// 	exit();	
// }

if (is_null($argv[1])) unknown();

// ALEVO DEVELOP

$run = new AlevoDevelopmentApp();


/**
 *	php alevo render ...
 *	php alevo -r ...
 */
if (in_array($argv[1], $config['render']))
{

	if(!isset($argv[2]))
	{
		$run->render_view();
		$run->render_resource();
		return true;
	}

	/**
 	 *	... all 
 	 *	... -a
 	 */
	if (in_array($argv[2], $config['all']))
	{
		$run->render_view();
		$run->render_resource();
		return true;
	}

	/**
 	 *	... view 
 	 *	... -V
 	 */
	if (in_array($argv[2], $config['view']))
	{
		$run->render_view();
		return true;
	}

	/**
 	 *	... resource 
 	 *	... res
 	 *	... -R
 	 */
	if (in_array($argv[2], $config['resource']))
	{
		$run->render_resource();
		return true;
	}

}

/**
 *	php alevo mode ...
 *	php alevo -M ...
 */
if (in_array($argv[1], $config['mode']))
{
	/**
 	 *	... development 
 	 *	... dev
 	 *	... -D
 	 */
	if (in_array($argv[2], $config['development']))
	{
		$run->development();
		return true;
	}

	/**
 	 *	... production 
 	 *	... prod
 	 *	... -P
 	 */
	if (in_array($argv[2], $config['production']))
	{
		$run->production();
		return true;
	}
}

/**
 *	php alevo make ...
 *	php alevo -m ...
 */
if (in_array($argv[1], $config['make'])) 
{
	/**
 	 *	... controller 
 	 *	... -C
 	 */
	if (in_array($argv[2], $config['controller']))
	{
		$run->controller($argv[3]);
		return true;
	}

	/**
 	 *	... model 
 	 *	... -M
 	 */
	if (in_array($argv[2], $config['model']))
	{

		if (!isset($argv[4])) 
		{
			$run->model($argv[3]);
			return true;
		}else{
			$run->model($argv[3], $argv[4]);
			return true;
		}
	}
}

/**
 *	php alevo serve ...
 *	php alevo -s ...
 */
if (in_array($argv[1], $config['serve']))
{
	if (!isset($argv[2])) 
	{
		$run->serve(null);
	}else{
		$run->serve($argv[2]);
	}
	return true;
}


unknown();