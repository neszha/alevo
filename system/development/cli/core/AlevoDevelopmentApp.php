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

	////////////////////

	public function development()
	{
		if ($this->from_cli()) 
		{
			$this->loop_line_string("\n======> CHANGE TO DEVELOPMENT MODE : ");
			usleep(400*1000);
		}
		$path     = 'app/config/development.php';
		$template = file_get_contents($path);
		$template = preg_replace('/(?<=(\=\>))[\s\w]+/', ' true', $template);
		$this->save($path, $template);
		$_ENV['development']['DEVELOPMENT'] = true;
		if ($this->from_cli())
		{	
			$this->loop_line_string("100% Complate. \n\n ");
			usleep(400*1000);
			$this->loop_line_string("\t--> Development mode is active! <--\n ");
			usleep(400*1000);
		}
		$this->render_resources();
		if ($this->from_cli()) usleep(400*1000);
		$this->render_view();
	}

	public function production()
	{
		if ($this->from_cli())
		{	
			$this->loop_line_string("\n======> CHANGE TO PRODUCTION MODE : ");
			usleep(400*1000);
		}
		$path     = 'app/config/development.php';
		$template = file_get_contents($path);
		$template = preg_replace('/(?<=(\=\>))[\s\w]+/', ' false', $template);
		$this->save($path, $template);
		$_ENV['development']['DEVELOPMENT'] = false;
		if ($this->from_cli())
		{	
			$this->loop_line_string("100% Complate. \n\n ");
			usleep(400*1000);
			$this->loop_line_string("\t--> Production mode is active! <--\n ");
			usleep(400*1000);
		}
		$this->render_resources();
		if ($this->from_cli()) usleep(400*1000);
		$this->render_view();
	}

	public function controller($data = null)
	{
		if (!is_null($data)) 
		{
			$params     = explode('@', $data, 2);
			$controller = $params[0];
			$method     = null;
			if(isset($params[1])) $method = $params[1];
			if ($this->from_cli())
			{	
				$this->loop_line_string("\n======> MAKE CONTROLLER : {$controller}.php \n\n");
				usleep(800*1000);
			}
			if ($method == null OR $method == 'index') 
			{
				$template_location = 'system/development/alevo/templates/controllerNoIndex.php';
			}else{
				$template_location = 'system/development/alevo/templates/controller.php';
			}
			$template = file_get_contents($template_location);
			$replace  = [
				'___time_made_controller___' => date('Y-m-d h:i:s'),
				'___Controller_name___'      => $controller,
				'___function_name___'        => $method
			];
			$template = str_replace(array_keys($replace), array_values($replace), $template);
			$path     = $_ENV['path']['CONTROLLERS_DIR'] . $controller . '.php';
			if (!file_exists($path)) 
			{
				$this->loop_line_string($template, 600);
				$this->save($path, $template);
				if ($this->from_cli()) $this->loop_line_string("\n\t--> Controller {$controller}.php has been created. <-- \n");
				return true;
			}else{
				if ($this->from_cli()) $this->loop_line_string("\t--> Controller {$controller}.php already exists. <-- \n");
				return true;
			}
		}else{
			$this->unknown();
			return false;
		}
	}

	public function model($data = null)
	{
		if (!is_null($data)) 
		{
			$params = explode('@', $data, 2);
			$model  = $params[0];
			$method = null;
			if(isset($params[1])) $method = $params[1];
			if ($this->from_cli())
			{
				$this->loop_line_string("\n======> MAKE MODEL : {$model}.php \n\n");
				usleep(800*1000);
			}
			$template_location = 'system/development/alevo/templates/model.php';
			$template          = file_get_contents($template_location);
			if ($method == null) 
			{
				$replace = [
					'___time_made_model___' => date('Y-m-d h:i:s'),
					'___Model_name___'      => $model
				];
			}else{
				$replace = [
					'___time_made_model___' => date('Y-m-d h:i:s'),
					'___Model_name___'      => $model,
					'method_name'           => $method
				];
			}
			$template = str_replace(array_keys($replace), array_values($replace), $template);
			$path     = $_ENV['path']['MODELS_DIR'] . $model . '.php';
			if (!file_exists($path)) 
			{
				$this->loop_line_string($template, 600);
				$this->save($path, $template);
				if ($this->from_cli()) $this->loop_line_string("\n\t--> Model {$model}.php has been created. <-- \n");
				return false;
			}else{
				if ($this->from_cli()) $this->loop_line_string("\t--> Model {$model}.php already exists. <-- \n");
				return false;
			}
		}else{
			$this->unknown();
			return false;
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
		$this->loop_line_string("Alevo development server started on http://{$host}:{$port} \n", 6000);
		exec("start http://{$host}:{$port}");
		exec("php -S {$host}:{$port}");
	}

	public function save($file, $data)
	{
		$open_file = fopen($file, 'w', 1);
		fwrite($open_file, $data);
		fclose($open_file);
	}

	public function unknown()
	{
		if ($this->from_cli()) $this->loop_line_string("\n\t--> Command Unknown <-- \n");
	}

	private function loop_line_string($string, $delay = 10000)
	{
		$array = str_split($string);
		foreach ($array as $x)
		{
			echo $x;
			usleep($delay);
		}
	}

}