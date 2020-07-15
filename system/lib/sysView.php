<?php 

class sysView
{

	public function view_engine($view_name)
	{
		$this->view_name = str_replace(['/'], '.', $view_name);
		$this->get_data_template_engine();
		$this->check_new_view();
		return $this->view_template();
	}

	public function get_data_template_engine()
	{
		$path        = $_ENV['path']['STORAGE_VIEW_PATH'];
		$json_string = file_get_contents($path);
		$object      = json_decode($json_string);
		$this->data  = $object;
		foreach ($object as $string)
		{
			$array         = explode('/@/', $string, 2);
			$this->views[] = ['view' => $array[0], 'path' => $array[1]];
		}
	}

	private function check_new_view()
	{
		$key = str_replace(['.'], '/', $this->view_name);
		var_dump($key);
		if (!isset($this->data->$key))
		{
			$this->render_all();
		}
	}

	public function view_template()
	{
		$array = $this->views;
		for ($i=0; $i < count($array); $i++) 
		{ 
			$view = $array[$i]['view'];
			$path = $array[$i]['path'];
			if ($view == $this->view_name) 
			{
				App::alevo_token();
				if (alevo_dev() == true) 
				{
					require_once 'sysTemplateEngine.php';
					$object = new sysTemplateEngine();
					$object->render_view_template($view, $path);	
				}
				return $path;
			}
		}

		if (alevo_dev() == true) 
		{
			require_once 'system\development\debug\init.php';
			$view_dir = $_ENV['path']['VIEWS_DIR'];
			alevoDebug::view_not_found($this->view_name, $view_dir);
			exit();
		}
	}

	private function render_all()
	{
		if (alevo_dev())
		{
			require_once 'system/lib/sysTemplateEngine.php';
			$obj = new sysTemplateEngine();
			$obj->render_view();
			$this->get_data_template_engine();
		}
	}
}