<?php
/**
 * @Controller  : admin_authController made by .ALEVO.
 * @Date        : 2020-04-16 01:45:43
 * @Message     : Don't be lazy typing
 */
class admin_authController extends Controller
{

	public function __construct()
	{
		$this->adminModel = $this->model('adminModel');
	}

	public function auth()
	{
		if ($this->admin_token_check())
		{
			$this->adminModel->update_admin_login();
			return $this->get_data_admin();
		}else{
			http_response_code(404);
			exit();
		}
	}

	private function get_data_admin()
	{
		$this->data_admin = $this->adminModel->get_data_admin_by_token($this->token);
		return $this->data_admin;
	}

	public function login()
	{
		if (!is_null(_post('login-admin')))
		{
			$this->username   = _post('username');
			$this->email      = _post('username');
			$this->password   = _post('password');
			$this->remembar   = _post('always-login');
			$this->time       = time_now();

			_set_session('admin_login', 'falied');

			// Cek username dan email
			$this->username_rows = $this->adminModel->username_rows($this->username);
			$this->email_rows    = $this->adminModel->email_rows($this->email);

			if ($this->username_rows != 0 || $this->email_rows != 0)
			{
				if ($this->username_rows != 0) $this->data = $this->adminModel->get_data_akun_by_username($this->username);
				if ($this->email != 0) $this->data = $this->adminModel->get_data_akun_by_email($this->email);

				// Cek password
				if ($this->password == $this->data->password)
				{
					$this->domain  = my_domain();
					$this->ip      = my_ip();
					$this->browser = my_browser();
					$this->os      = my_os();
					$this->set_admin_token();
					$this->adminModel->insert_admin_login($this);
					_set_session('admin_login', 'success');
					redirect('/admin/dashboard');
					exit();
				}
			}
		}
	}

	public function logout()
	{
		if (_session('admin-token'))
		{
			_remove_session('admin-token');
			_remove_session('siswa-token');
		}
		redirect('/');
		exit();
	}

	public function cek_login_ready()
	{
		$this->check = $this->admin_token_check();
		if ($this->check) 
		{
			redirect('/admin/dashboard');
			exit();
		}
	}

	public function admin_token_check()
	{
		$this->token = _session('admin-token');
		if ($this->token)
		{
			$this->res = $this->adminModel->admin_token_rows($this->token);
			if ($this->res > 0) return true;
		}
		return false;
	}

	private function set_admin_token()
	{
		$this->admin_token = uniqid().md5(uniqid()).uniqid().uniqid();
		_set_session('admin-token', $this->admin_token);
	}

}