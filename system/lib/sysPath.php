<?php 

class sysPath extends App
{
	private $path = null;

	public function make_file($path)
	{
		$this->real_path = $path;
		$this->path      = $path;
		$this->filter_path();
		$this->make_file_exists_and_make_path();
	}

	public function make_dir($path)
	{
		$this->real_path = $path;
		$this->path      = $path;
		$this->filter_path();
		$this->path_exists_and_make_path();
	}

	public function filter_path()
	{
		$path         = $this->filter_path_regex($this->path);
		$array        = explode('/', $path);
		$level_string = null;
		$path_level   = [];
		foreach ($array as $x)
		{
			if ($level_string == null)
			{
				$_path        = $x . '/';
				$level_string = $this->filter_path_regex($_path);
				$path_level[] = $this->filter_path_regex($_path);
			}else{
				$_path        = $level_string . $x . '/';
				$level_string = $this->filter_path_regex($_path);
				$path_level[] = $this->filter_path_regex($_path);
			}
		}
		$this->path_level = $path_level;
	}

	private function make_file_exists_and_make_path()
	{
		$file_name_array = explode('/', $this->real_path);
		$file_name       = end($file_name_array);
		$total           = count($this->path_level);
		for ($i=0; $i < $total; $i++)
		{ 
			$path = $this->path_level[$i];
			if ($i == $total - 1)
			{
				$path = trim($path, '/');
				if (!file_exists($path))
				{
					$open_file = fopen($path, 'w', 1);
					fwrite($open_file, null);
					fclose($open_file);
				}
			}else{
				if (!file_exists($path)) mkdir($path);
			}
		}
	}

	private function path_exists_and_make_path()
	{
		foreach ($this->path_level as $x)
		{
			if (!file_exists($x)) mkdir($x);
		}
	}

	public function filter_path_regex($path)
	{
		preg_match_all('/[\w\/\@\.\-]/', $path, $match);
		$path       = implode(null, $match[0]);
		$path       = preg_replace('/\\/+/', '/', $path);
		$this->path = $path;
		return $path;
	}

	public function remove_dir($dir)
	{
		if(!file_exists($dir)) return true;
		$data = $this->scan_dir($dir);

		foreach ($data->file as $path) if(is_file($path))
		{
			if(file_exists($path)) unlink($path);
		}

		$array_dir = [];
		foreach ($data->dir as $path) $array_dir[] = $path;

		array_multisort(array_map('strlen', $array_dir), $array_dir);
		$array_dir = array_reverse($array_dir);

		foreach ($array_dir as $dir) if(is_dir($dir))
		{
			if(file_exists($dir)) rmdir($dir);
		}
	}

	public function scan_dir($dir)
	{
		if(file_exists($dir))
		{	
			$this->res_file = [];
			$this->res_dir = [];
			$this->loop_scan_dir($dir);
			return (object) ['dir' => $this->res_dir, 'file' => $this->res_file];
		}

		return (object) ['dir' => [], 'file' => []];
	}

	private function loop_scan_dir($dir)
	{
		$open = opendir($dir);
		while (($name = readdir($open)) != false)
		{
			$path = $dir . $name;
			if(is_file($path))
			{
				$this->res_file[] = $path; 
			}else{
				if ($name !== '.' AND $name !== '..') 
				{
					$this->loop_scan_dir($path . '/');
				}
			}
		}
		closedir($open);
		$this->res_dir[] = $dir;
	}

	private function env_path()
	{
		return $_ENV['path'];
	}

}