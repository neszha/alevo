<?php
/**
 * @Controller  : indexController made by .ALEVO.
 * @Date        : 2020-04-11 07:35:56
 * @Message     : Don't be lazy typing
 */
class indexController extends Controller
{

	public function __construct()
	{
		$this->portal = $this->run('portalController');
	}

	public function index()
	{
		$this->portal_cs = $this->portal->get_status('cari_siswa');

		$this->view('index');
	}

	public function login_siswa_view()
	{
		$this->portal_ls = $this->portal->get_status('login_siswa');

		$this->disabled = null;
		if(!$this->portal_ls) $this->disabled = 'disabled';

		$this->siswaAuth = $this->run('siswa_authController');
		$this->siswaAuth->cek_login_ready();
		$this->siswaAuth->login();

		$this->view('login_siswa');	
		_remove_session('siswa_login');
	}

	public function login_admin_view()
	{
		$this->adminAuth = $this->run('admin_authController');
		$this->adminAuth->cek_login_ready();
		$this->adminAuth->login();

		$this->view('login_admin');
		_remove_session('admin_login');
	}
	
}