<?php
/**
 * @Controller  : siswa_valueController made by .ALEVO.
 * @Date        : 2020-04-21 03:23:28
 * @Message     : Don't be lazy typing
 */
class siswa_valueController extends Controller
{

	public function __construct()
	{
		$this->path = "storage/data/siswaValue.json";
		$this->json = file_get_contents($this->path);
		$this->obj  = json_decode($this->json);
	}

	public function get_obj()
	{
		return $this->obj;
	}

	public function get_data($key)
	{
		return $this->obj->$key;
	}

	public function get_value($main_key, $key)
	{
		if (isset($this->obj->$main_key->$key)) return $this->obj->$main_key->$key;	
	}
	
	
}