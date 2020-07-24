<?php 

class sysView
{
	public function view_engine($view)
	{
		$this->view = str_replace(['.'], '/', $view);
		$this->get_data_template_engine();
		return $this->view_template();
	}

	public function get_data_template_engine()
	{
		$path        = $_ENV['path']['STORAGE_VIEW_PATH'];
		$json_string = file_get_contents($path);
		$object      = json_decode($json_string);
		$this->views = $object;
	}

	public function view_template()
	{
		$key = $this->view;
		if (isset($this->views->$key))
		{
			$path = $this->views->$key;
			/*@devData*/
			if (App::dev())
			{
				require_once 'system/development/cli/core//RenderEngine.php';
				$obj = new RenderEngine();
				$obj->update_render_view($key, $path);
			}
			/*@endDevData*/
			return $path;
		}

		/*@devData*/
		if (App::dev())
		{
			$path = $_ENV['path']['VIEWS_DIR'] . $this->view . '.php';
			if(is_file($path))
			{
				require_once 'system/development/cli/core//RenderEngine.php';
				$obj = new RenderEngine();
				$obj->new_render_view($path);
				header("Location:" . App::this_url());
				exit();
			}
		}

		if (App::dev()) 
		{
			require_once 'system\development\debug\init.php';
			$view_dir = $_ENV['path']['VIEWS_DIR'];
			alevoDebug::view_not_found($this->view, $view_dir);
			exit();
		}
		/*@endDevData*/
	}
}