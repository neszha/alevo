<?php
/**
 * @Controller  : siswa_logController made by .ALEVO.
 * @Date        : 2020-06-28 03:01:50
 * @Message     : Don't be lazy typing
 */
class siswa_logController extends Controller
{

	public function __construct()
	{
		$this->app        = $this->run('appController');
		$this->siswaModel = $this->model('siswaModel');
		$this->im_admin   = false;
		$this->ip         = my_ip();
		$this->browser    = my_browser();
		$this->os         = my_os();
		$this->time       = time_now();
	}

	public function insert_log($type, $log)
	{
		$this->type = $type;
		$this->log  = $log;
		$this->auth_session();
		$this->insert_siswa_log_main();
	}

	private function insert_siswa_log_main()
	{
		$this->siswa_log = $this->siswaModel->insert_siswa_log($this);
		if ($this->siswaModel->siswa_log_akun_rows($this->siswa->id) < 1)
		{
			$this->siswaModel->insert_first_siswa_log_akun($this);
		}else{
			$this->siswaModel->update_siswa_log_akun($this);
		}
	}

	private function auth_session()
	{
		$siswa_token      = _session('siswa-token');
		if (!$siswa_token)
		{
			redirect('/');
			exit();
		}
		$this->siswa      = $this->siswaModel->get_data_siswa_by_token($siswa_token);
		$admin_token      = _session('admin-token');
		$admin_token_rows = $this->siswaModel->admin_token_rows($admin_token);
		if($admin_token_rows > 0) $this->im_admin = true;
	}
	
	public function get_new_log_per_akun()
	{
		$data  = $this->siswaModel->get_siswa_log_akun();
		$array = [];
		foreach ($data as $x)
		{
			$x->log        = $this->get_log_value($x->type, $x->log);
			$x->updated_at = $this->app->beauty_time_complete($x->updated_at);
			$x->total      = $this->siswaModel->siswa_log_rows($x->id);
			$array[]       = $x;
		}
		return $array;
	}

	public function get_log_value($key, $log)
	{
		$path = "storage/data/siswaLogValue.json";
		$json = file_get_contents($path);
		$obj  = json_decode($json);
		return $obj->$key->$log;
	}

	public function get_all_log_by_akun($id)
	{
		$data_siswa = $this->siswaModel->get_siswa_data_main($id);
		$data_log   = $this->siswaModel->get_all_log_by_akun($id);
		$array      = [];
		foreach ($data_log as $x)
		{
			$x->log  = $this->get_log_value($x->type, $x->log);
			$x->created_at = $this->app->beauty_time_complete($x->created_at);
			$array[] = $x;
		}
		$obj = (object) ['siswa' => $data_siswa, 'log' => $array];
		return $obj;
	}

	public function siswa_log_clean()
	{
		$id = _data('id');
		$this->siswaModel->delete_siswa_log_by_id($id);
		$this->siswaModel->delete_siswa_log_akun_by_id($id);
		redirect('/admin/siswa/aktifitas/detail/' . $id);
	}
}