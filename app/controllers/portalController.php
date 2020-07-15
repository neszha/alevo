<?php
/**
 * @Controller  : portalController made by .ALEVO.
 * @Date        : 2020-05-09 06:23:21
 * @Message     : Don't be lazy typing
 */
class portalController extends Controller
{

	public function __construct()
	{
		$this->adminModel = $this->model('adminModel');
	}

	public function get_data_portal()
	{
		return $this->adminModel->get_data_portal();
	}

	public function set_data_portal()
	{
		$data   = $this->get_data_portal();
		$portal = (object)(null);
		foreach ($data as $x) 
		{
			$key          = $x->nama;
			unset($x->nama);
			$x->status    = (boolean)($x->status);
			$value        = $x;
			$portal->$key = $value;
		}
		return $portal;
	}

	public function get_status($key)
	{
		$portal = $this->set_data_portal();
		return $portal->$key->status;
	}

	public function other_method()
	{
		// your_code
	}
	
}