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
		exit();
	}

	/**
 	 *	... all 
 	 *	... -a
 	 */
	if (in_array($argv[2], $config['all']))
	{
		$run->render_view();
		$run->render_resource();
		exit();
	}

	/**
 	 *	... view 
 	 *	... -V
 	 */
	if (in_array($argv[2], $config['view']))
	{
		$run->render_view();
		exit();
	}

	/**
 	 *	... resource 
 	 *	... res
 	 *	... -R
 	 */
	if (in_array($argv[2], $config['resource']))
	{
		$run->render_resource();
		exit();
	}

}

/**
 *	php alevo build
 *	php alevo -b
 */
if (in_array($argv[1], $config['build']))
{
	$run->build();
	exit();
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
		exit();
	}

	/**
 	 *	... production 
 	 *	... prod
 	 *	... -P
 	 */
	if (in_array($argv[2], $config['production']))
	{
		$run->production();
		exit();
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
		exit();
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
			exit();
		}else{
			$run->model($argv[3], $argv[4]);
			exit();
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
	exit();
}


unknown();