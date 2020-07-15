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
		preg_match_all('/[\w\/\@\.]/', $path, $match);
		$path       = implode(null, $match[0]);
		$path       = preg_replace('/\\/+/', '/', $path);
		$this->path = $path;
		return $path;
	}

	private function env_path()
	{
		return $_ENV['path'];
	}

}