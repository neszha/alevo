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
		$this->scan_dir();
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
		scan_view_file($this->scan_log, true);
	}

	private function scan_dir($dir = false)
	{
		static $start_time;
		if(empty($start_time)) $start_time = time();
		$time_now           = time();
		$this->time_elapsed = $time_now - $start_time;
		if(!$dir) $dir      = $this->res_dir;
		$dir_open           = opendir($dir);
		while (($name = readdir($dir_open)) != false) 
		{
			$path = $dir . $name;
			if (is_file($path)) 
			{
				$this->file_array[] = $path;
				scan_view_file([$path, $name], false);
			}else{
				if ($name !== '.' AND $name !== '..') $this->scan_dir($path . '/');
			}
		}
		closedir($dir_open);
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

	///////////////////

	


	

	private function minify()
	{
		if($this->config('minify'))
		{
			$str_line = explode("\n", $this->view);
			$str_minify = '';
			foreach ($str_line as $str)
			{
				$str    = preg_replace(['/^\s+/', '/\t/', '/\s+$/'], '', $str);
				$str_minify .=  $str;
			}
			$this->view = $str_minify;
		}
	}

	private function remove_null_line()
	{
		if($this->config('remove_null_line'))
		{
			$str_line = explode("\n", $this->view);
			$str_line_array = [];
			foreach ($str_line as $str)
			{
				$preg = preg_match('/\S/', $str);
				if ($preg ==  1) $str_line_array[] = $str;
			}
			$this->view = implode("\n", $str_line_array);
		}
	}

	private function remove_comment()
	{
		if($this->config('remove_comment'))
		{
			$regex   = [];
			$regex[] = "/<!--[\s\t\n]?([\w\W][^-]+)+-->/"; // HTML
			$regex[] = "/\/\*[\s\t\n]?[\w\W][^\*]+../"; // CSS & PHP
			$regex[] = "/[^\:]\/\/.+/"; // JavaScript & PHP
			$this->view = preg_replace(array_values($regex), '', $this->view);
		}

	}

	private function code_replace()
	{
		if($this->config('use_code_replace'))
		{
			$str_line = explode("\n", $this->view);
			$str_line_array = [];
			foreach ($str_line as $str)
			{
				$key = 'r-2';
				foreach ($this->replace[$key] as $a => $b) 
				{
					$regex = "/(?<={$b['key'][0]}).*(?={$b['key'][1]})/";
					$match = preg_match_all($regex, $str, $select);
					if ($match) 
					{
						$string_select   = $select[0][0];
						$result['key']   = str_replace('__@__', $string_select, $b['key_real']);
						$result['value'] = str_replace('__@__', $string_select, $b['value_real']);
						$str             = str_replace($result['key'], $result['value'], $str);
						$str             = str_replace("\r", null, $str);
					}
				}

				$key = 'r-1';
				foreach ($this->replace[$key] as $a => $b)
				{
					$str = str_replace($a, $b, $str);
				}

				$key = 'r-3';
				foreach ($this->replace[$key] as $a => $b)
				{
					$str = str_replace($a, $b, $str);
				}
				$str_line_array[] = $str;
			}
			$this->view = implode("\n", $str_line_array);
		}
	}

	private function config($key)
	{
		if(isset($_ENV['templateEngine']['VIEWS']))
		{
			if(isset($_ENV['templateEngine']['VIEWS'][$key])) return $_ENV['templateEngine']['VIEWS'][$key];
		}
		return false;
	}

}