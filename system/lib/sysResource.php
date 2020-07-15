<?php 

class sysResource extends App
{

	public function get_resource_path($key)
	{
		$this->string_random();
		$this->key = $key;
		$this->parse_resource_data();
		$this->resource_change();
		$cache_version = $_ENV['app']['APP_VERSION'];
		$resource_path = '/' . $this->data->$key->path . '?version=' . $cache_version;
		if ($this->dev())
		{
			$dir_path = $_ENV['path']['RESOURCES_DIR'];
			$resource_path = '/' . $dir_path . $key . '?cache=' . $this->data->$key->cache;
		}
		$path = $_ENV['app']['BASE_URL'] . $resource_path;
		return $path;
	}

	private function resource_change()
	{
		if ($this->dev())
		{
			require_once 'system/lib/sysTemplateEngine.php';
			$this->template_engine = new sysTemplateEngine();
			$key = $this->key;
			$file_key_path = $_ENV['path']['RESOURCES_DIR'] . $this->key;
			if (!file_exists($file_key_path))
			{
				require_once 'system\development\debug\init.php';
				alevoDebug::file_not_exists($file_key_path);
				exit();
			}
			$this->check_new_res();
			$value_path = $this->data->$key->path;
			$key_string = $this->minify_string(file_get_contents($file_key_path));
			$value_string = file_get_contents($value_path);
			if ($key_string != $value_string)
			{
				$this->value_path = $value_path;
				$this->new_string = $key_string;
				$this->resource_update();
			}
		}
	}

	private function check_new_res()
	{
		$key = $this->key;
		if (is_null($this->data->$key))
		{
			$this->template_engine->render_resource();
			$this->parse_resource_data();
		}
	}

	private function resource_update()
	{
		$key = $this->key;
		$this->data->$key->cache = $this->string_random();
		$json = json_encode($this->data);
		$this->template_engine->save_resource_path($json);
		$this->template_engine->save_file($this->value_path, $this->new_string);
	}

	private function minify_string($string)
	{
		return $this->template_engine->minify_engine($string);
	}

	private function parse_resource_data()
	{
		$path = $_ENV['path']['STORAGE_RESOURCE_PATH'];
		$json = file_get_contents($path);
		$array = json_decode($json);
		$this->data = $array;
	}

}