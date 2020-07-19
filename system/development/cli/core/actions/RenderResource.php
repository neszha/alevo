<?php 

class RenderResource extends RenderEngine
{

	public function __construct()
	{
		$this->sysPath      = new sysPath();
		$this->res_dir      = $_ENV['path']['RESOURCES_DIR'];
		$this->render_dir   = $_ENV['path']['RECOURCE_RENDER_DIR'];
		$this->storage_path = $_ENV['path']['STORAGE_RESOURCE_PATH'];
	}

	public function main()
	{
		log_begin('Render Resource');
		$this->save_file($this->storage_path, '');
		$this->scan_res_dir();
		$this->set_log_scan_dir();
		$this->clear_rendered_resource();
		$this->render_all();
		$this->end_log_render();
		log_end();
		die();
	}

	private function render_all()
	{
		$this->done = 0;
		foreach ($this->file_array as $path)
		{
			$this->render($path);
		}
	}

	public function render($path)
	{
		$this->ext  = $this->get_ext($path);
		$this->path = $path;
		$this->res = file_get_contents($path);

		if($_ENV['templateEngine']['USE_TEMPLATE_ENGINE'] && !$this->except_format($path))
		{
		// 	$this->code_replace();
		// 	$this->remove_comment();
		// 	$this->remove_null_line();
		// 	$this->minify();
		}

		$this->get_resource_name();
		$this->set_rendered_path();
		$this->save_file($this->rendered_path, $this->res);
		$this->save_path_data();
		$this->render_log();
	}

	private function save_path_data()
	{
		if(!file_exists($this->storage_path)) $this->sysPath->make_file($this->storage_path);

		$str_data = file_get_contents($this->storage_path);
		if($str_data == '') $str_data = '{}';
		$json = json_decode($str_data);
		$res_name = $this->res_name;
		$json->$res_name = $this->data;
		$str_data = json_encode($json);
		$this->save_file($this->storage_path, $str_data);
	}

	private function set_rendered_path()
	{
		if(is_null($this->ext))
		{
			$this->rendered_path = $this->render_dir . $this->random(20);
		}else{
			$this->rendered_path = $this->render_dir . $this->random(20) . '.' . $this->ext;
		}
		$this->data = $this->rendered_path;
		if(App::dev())
		{
			$res_file = str_replace('-', '_', $this->res_file);
			$this->rendered_path = $this->render_dir . '@dev__' . $this->random(7, true) . '__' . $res_file;
			$this->data = ['path' => $this->rendered_path, 'cache' => $this->random(10)];
		}
	}

	private function get_resource_name()
	{
		$res_dir = str_replace('/', '\/', $this->res_dir);
		$regex    = "/(?<={$res_dir}).+/";
		$match    = preg_match_all($regex, $this->path, $x);
		if($match) $this->res_name = $x[0][0];
		$path_array = explode('/', $this->path);
		$this->res_file = end($path_array);
	}

	private function clear_rendered_resource()
	{
		$this->sysPath->make_dir($this->render_dir);
		$dir_open = opendir($this->render_dir);
		$loop     = 0;
		while (($name = readdir($dir_open)) != false) 
		{
			static $start_time_clear;
			if(empty($start_time_clear)) $start_time_clear = time();
			$time_now           = time();
			$this->time_elapsed = $time_now - $start_time_clear;
			$path = $this->render_dir . $name;
			if (is_file($path))
			{
				remove_rendered_resource($path, false);
				unlink($path);
				$loop++;
			}
		}
		$this->scan_log = (object) [
			'total'   => $loop,
			'elapsed' => $this->time_elapsed,
		];
		remove_rendered_resource($this->scan_log, true);
		closedir($dir_open);
	}

	private function set_log_scan_dir()
	{
		$this->scan_log = (object) [
			'total'   => count($this->file_array),
			'elapsed' => $this->time_elapsed,
		];
		render_file_scan($this->scan_log, true);
	}

	private function scan_res_dir()
	{
		static $start_time;
		if(empty($start_time)) $start_time = time();
		$time_now           = time();
		$this->time_elapsed = $time_now - $start_time;

		$data = $this->sysPath->scan_dir($this->res_dir);
		$this->file_array = [];
		foreach ($data->file as $path) 
		{
			$array = explode('/', $path);
			$name = end($array);
			$this->file_array[] = $path;
			render_file_scan([$path, $name], false);
		}
	}

	private function end_log_render()
	{
		$log = (object) [
			'total' => $this->done,
			'elapsed' => $this->time_elapsed,
		];
		render_resource($log, true);
	}

	private function render_log()
	{
		$this->done++;
		if (App::from_cli())
		{
			static $start_time_render;
			if(empty($start_time_render)) $start_time_render = time();
			$time_now           = time();
			$this->time_elapsed = $time_now - $start_time_render;
			if(isset($this->file_array))
			{
				$status_bar = '[';
				$size = 30;
				$total = count($this->file_array);
				$done = $this->done;
				$perc = (double) ($done/$total);
				$bar = floor($perc*$size);
				$data = (object) [
					'size' => $size,
					'total' => $total,
					'done' => $done,
					'perc' => $perc,
					'bar' => $bar,
					'path' => $this->rendered_path,
				];
				render_resource($data, false);
			}
		}
	}

}