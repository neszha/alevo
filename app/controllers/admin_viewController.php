<?php
/**
 * @Controller  : admin_viewController made by .ALEVO.
 * @Date        : 2020-04-14 07:09:19
 * @Message     : Don't be lazy typing
 */
class admin_viewController extends Controller
{

	public function __construct()
	{
		$this->adminAuth       = $this->run('admin_authController');
		$this->siswaController = $this->run('admin_siswaController');
		$this->appController   = $this->run("appController");
		$this->siswaLog        = $this->run("siswa_logController");
		$this->siswaModel      = $this->model('siswaModel');
		$this->adminModel      = $this->model('adminModel');
		$this->admin           = $this->adminAuth->auth();
		$this->set_nama_pendek();
	}

	public function redirect_to_dashboard()
	{
		redirect('/admin/dashboard');
	}

	public function dashboard()
	{
		$this->total_data_siswa               = $this->siswaModel->total_data_siswa();
		$this->total_data_siswa_sudah_lengkap = $this->siswaModel->total_data_siswa_sudah_lengkap();
		if ($this->total_data_siswa == 0) 
		{
			$this->presentase_sudah_lengkap       = 0;
			$this->presentase_belum_lengkap       = 100;
			$this->total_data_siswa_belum_lengkap = 0;
		}else{	
			$this->total_data_siswa_belum_lengkap = $this->total_data_siswa - $this->total_data_siswa_sudah_lengkap;
			$this->presentase_sudah_lengkap       = (int)($this->total_data_siswa_sudah_lengkap / $this->total_data_siswa * 100);
			$this->presentase_belum_lengkap       = (int)(100 - $this->presentase_sudah_lengkap);
		}

		$this->data_sampah_rows        = $this->siswaModel->data_sampah_rows();
		$this->antrian_verifikasi_rows = $this->siswaModel->antrian_verifikasi_rows();
		$this->data_terverifikasi_rows = $this->siswaModel->data_terverifikasi_rows();

		$this->view('admin.dashboard');
	}

	public function tambah_data_siswa()
	{
		$this->view('admin.siswa.tambah_data');
	}

	public function verifikasi_data_siswa()
	{
		$this->view('admin.siswa.verifikasi');
	}

	public function list_data_siswa()
	{
		$this->search_query = null;
		if(!is_null(_get('search_query') && _get('search_query') != '')) $this->search_query = _get('search_query');

		$this->view('admin.siswa.list_data_siswa');
	}

	public function sampah()
	{
		$this->data = $this->siswaController->get_data_sampah();
		$this->view('admin.siswa.sampah');
	}

	public function aktifitas()
	{
		$this->data = $this->siswaLog->get_new_log_per_akun();
		$this->view('admin.siswa.aktifitas.main');
	}

	public function aktifitas_detail()
	{
		$this->id = _data('id');
		$this->data = $this->siswaLog->get_all_log_by_akun($this->id);
		$this->view('admin.siswa.aktifitas.detail');
	}

	public function profile()
	{
		if(!is_null(_post('simpan_data_akun'))) $this->simpan_data_akun();
		if(!is_null(_get('hapus_riwayat_login')))
		{
			$this->adminModel->hapus_riwayat_login_by_id($this->admin->id);
			redirect('/');
			exit();
		}
		$this->created_at = $this->appController->beauty_time($this->admin->created_at);
		$this->updated_at = $this->appController->beauty_time($this->admin->updated_at);	
		if(!is_null(_get('kelola_akun'))) $this->admin->password = $this->adminModel->get_password_by_id($this->admin->id);

		$this->set_riwayat_login();

		$this->view('admin.profile');
	}

	public function pengaturan()
	{
		if(!is_null(_get('id')) && !is_null(_get('status')))
		{
			$this->update_data_portal();
		}

		$this->portal = $this->run('portalController')->set_data_portal();

		$this->view('admin.pengaturan');
	}
	

	public function simpan_data_akun()
	{
		$this->id       = _post('id');
		$this->nama     = _post('nama');
		$this->username = _post('username');
		$this->email    = _post('email');
		$this->akses    = _post('akses');
		$this->password = _post('password');
		$this->time     = time_now();
		$this->adminModel->update_admin_akun($this);
		$this->adminModel->update_admin_profile($this);

		$this->admin->password = $this->adminModel->get_password_by_id($this->admin->id);

		if($this->admin->username != $this->username || $this->admin->email != $this->email || $this->admin->password != $this->password)
		{
			$this->adminAuth->logout();
			exit();
		}

		redirect(App::url());
		exit();
	}

	private function set_nama_pendek()
	{
		$array = explode(' ', $this->admin->nama);
		$this->admin->nama_pendek = $array[0];
	}

	private function set_riwayat_login()
	{
		$this->riwayat_login = [];
		$data = $this->adminModel->get_all_admin_login_by_id($this->admin->id);
		foreach ($data as $key => $x) 
		{
			$c_at          = $this->appController->beauty_time($x->created_at);
			$x->created_at = "{$c_at->d} {$c_at->m} {$c_at->y} {$c_at->h}:{$c_at->i}";
			$u_at          = $this->appController->beauty_time($x->updated_at);
			$x->updated_at = "{$u_at->d} {$u_at->m} {$u_at->y} {$u_at->h}:{$u_at->i}";

			$this->riwayat_login[] = $x;
		}
	}

	private function update_data_portal()
	{
		$this->id     = _get('id');
		$this->status = json_decode(_get('status'));
		$this->time   = time_now();
		$this->adminModel->update_data_portal($this);
		redirect('/admin/pengaturan');
		exit();
	}

}