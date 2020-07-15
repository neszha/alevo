<?php
/**
 * @Controller  : siswa_authController made by .ALEVO.
 * @Date        : 2020-04-20 01:26:01
 * @Message     : Don't be lazy typing
 */
class siswa_authController extends Controller
{

	public function __construct()
	{
		$this->adminAuth  = $this->run('admin_authController');
		$this->portal     = $this->run('portalController');
		$this->siswaLog   = $this->run('siswa_logController');
		$this->siswaModel = $this->model('siswaModel');
		$this->portal_ls  = $this->portal->get_status('login_siswa');
	}

	public function auth()
	{
		if(!$this->portal_ls && !$this->adminAuth->admin_token_check())
		{
			redirect('/siswa/login');
			exit();
		}
		if ($this->siswa_token_check() || $this->adminAuth->admin_token_check())
		{
			return $this->get_data_siswa();
		}else{
			$this->logout();
			exit();
		}
	}

	private function get_data_siswa()
	{
		$this->data_siswa = $this->siswaModel->get_data_siswa_by_token($this->token);
		return $this->data_siswa;
	}

	public function login()
	{
		if (!is_null(_post('login-siswa')))
		{
			$this->nisn     = _post('nisn');
			$this->password = _post('password');
			$this->time     = time_now();

			_set_session('siswa_login', 'falied');

			// Cek nisn
			$this->nisn_rows = $this->siswaModel->nisn_rows($this->nisn);

			if ($this->nisn_rows != 0)
			{
				$this->data = $this->siswaModel->get_data_akun_by_nisn($this->nisn);

				// Cek password
				if ($this->password == $this->data->password)
				{
					$this->domain  = my_domain();
					$this->ip      = my_ip();
					$this->browser = my_browser();
					$this->os      = my_os();
					$this->set_siswa_token();
					$this->siswaModel->insert_siswa_login($this);
					_set_session('siswa_login', 'success');
					$this->siswaLog->insert_log('access', 'a1');
					redirect('/siswa/dashboard');
					exit();
				}
			}
		}
	}

	public function cek_login_ready()
	{
		$this->check = $this->siswa_token_check();
		if ($this->check && $this->portal_ls) 
		{
			redirect('/siswa/dashboard');
			exit();
		}
	}

	private function siswa_token_check()
	{
		$this->token = _session('siswa-token');
		if ($this->token)
		{
			$this->res = $this->siswaModel->siswa_token_rows($this->token);
			if ($this->res > 0) return true;
		}
		return false;
	}

	public function logout()
	{
		$this->siswaLog->insert_log('access', 'a2');
		if (_session('siswa-token')) _remove_session('siswa-token');
		redirect('/');
		exit();
	}

	private function set_siswa_token()
	{
		$this->siswa_token = uniqid().md5(uniqid()).uniqid().uniqid();
		_set_session('siswa-token', $this->siswa_token);
	}

	public function give_admin_access($id)
	{
		$this->data    = $this->siswaModel->get_data_akun_by_id($id);
		$this->domain  = my_domain();
		$this->ip      = my_ip();
		$this->browser = my_browser();
		$this->os      = my_os();
		$this->time    = time_now();
		$this->set_siswa_token();
		$this->siswaModel->insert_siswa_login($this);
		_set_session('siswa_login', 'success');
		redirect('/siswa/dashboard');
		exit();
	}

	public function edit_data_auth($portal, $data_status)
	{
		if(!$portal || $data_status == 2)
		{
			redirect('/siswa/dashboard');
			die();
		}
	}

}