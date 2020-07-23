<?php 


class AlevoDevelopmentApp extends App
{

	public function render_view()
	{
		require_once 'system/development/cli/core/RenderEngine.php';
		$obj = new RenderEngine();
		$obj->render_view();
	}

	public function render_resource()
	{
		require_once 'system/development/cli/core/RenderEngine.php';
		$object = new RenderEngine();
		$object->render_resource();
	}

	public function build()
	{
		require_once 'system/development/cli/core/RenderEngine.php';
		require_once 'system/development/cli/core/AppBuild.php';
		$object = new AppBuild();
		$object->build();

	}

	public function development()
	{
		log_main_begin('CHANGE MODE', 'DEVELOPMENT');
		$path = 'app/config/development.php';
		$str  = file_get_contents($path);
		$str  = preg_replace('/(?<=(\=\>))[\s\w]+/', ' true', $str);
		$this->save($path, $str);
		$this->render_view();
		$this->render_resource();
	}

	public function production()
	{
		log_main_begin('CHANGE MODE', 'PRODUCTION');
		$path = 'app/config/development.php';
		$str  = file_get_contents($path);
		$str  = preg_replace('/(?<=(\=\>))[\s\w]+/', ' false', $str);
		$this->save($path, $str);
		$this->render_view();
		$this->render_resource();
	}

	public function controller($name)
	{
		global $argv;
		$controller_name = $name;
		$template = file_get_contents('system/development/cli/templates/controller.temp.php');

		log_main_begin('MAKE CONTROLLER', $name);

		$replace = [
			'@_time_@' => date('Y-m-d h:i:s'),
			'@_name_@' => $controller_name,
		];

		$template = str_replace(array_keys($replace), array_values($replace), $template);

		if(isset($argv[4]))
		{
			$method_name = $argv[4];
			$template = str_replace('index', $method_name, $template);
		}

		$path = $_ENV['path']['CONTROLLERS_DIR'] . $controller_name . '.php';

		if (!file_exists($path)) 
		{
			if (App::from_cli())
			{
				echo "$template \n";
			}
			$this->save($path, $template);
			log_success("Controller {$controller_name}.php has been created.");
		}else{
			log_warning("Controller {$controller_name}.php already exists.");
		}

	}

	public function model($name)
	{
		global $argv;
		$model_name = $name;
		$template = file_get_contents('system/development/cli/templates/model.temp.php');

		log_main_begin('MAKE MODEL', $name);

		$replace = [
			'@_time_@' => date('Y-m-d h:i:s'),
			'@_name_@' => $model_name,
		];

		$template = str_replace(array_keys($replace), array_values($replace), $template);

		if(isset($argv[4]))
		{
			$method_name = $argv[4];
			$template = str_replace('index', $method_name, $template);
		}

		$path = $_ENV['path']['MODELS_DIR'] . $model_name . '.php';

		if (!file_exists($path)) 
		{
			if (App::from_cli())
			{
				echo "$template \n";
			}	
			$this->save($path, $template);
			log_success("Model {$model_name}.php has been created.");
		}else{
			log_warning("Model {$model_name}.php already exists.");
		}

	}

	public function serve($data)
	{
		$base_url = $_ENV['app']['BASE_URL'];
		preg_match('/(?<=\/\/)[\w.]+/', $base_url, $host);
		preg_match('/(?<=\:)[\d]+/', $base_url, $port);
		$port = $port[0];
		$host = $host[0];
		if (!is_null($data)) 
		{
			$data_array = explode(':', $data);
			if (!is_null($data_array[0])) $host = $data_array[0];
			if (!is_null($data_array[1])) $port = $data_array[1];
		}
		if (App::from_cli())
		{
			$tx = new TextColorX();
			echo "Alevo development server started on {$tx->red("http://{$host}:{$port}")} \n";
			exec("start http://{$host}:{$port}");
			exec("php -S {$host}:{$port}");
		}
	}

	private function save($file, $data)
	{
		$open_file = fopen($file, 'w', 1);
		fwrite($open_file, $data);
		fclose($open_file);
	}
}