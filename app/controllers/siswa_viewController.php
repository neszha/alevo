<?php
/**
 * @Controller  : siswa_viewController made by .ALEVO.
 * @Date        : 2020-04-12 09:20:18
 * @Message     : Don't be lazy typing
 */
class siswa_viewController extends Controller
{

	public function __construct()
	{
		$this->siswaAuth       = $this->run('siswa_authController');
		$this->siswaValue      = $this->run('siswa_valueController');
		$this->kelengkapanData = $this->run('siswa_kelengkapanDataController');
		$this->siswaLog        = $this->run('siswa_logController');
		$this->portal          = $this->run('portalController');
		$this->siswaModel      = $this->model('siswaModel');
		$this->siswa           = $this->siswaAuth->auth();

		$this->kelengkapanData->presentase_data_check($this->siswa->id);
		$this->presentase_data  = $this->siswaModel->get_presentase_data($this->siswa->id);
		$this->presentase_color = $this->kelengkapanData->presentase_data_color($this->presentase_data);
		$this->nav_active       = false;
		$this->portal_eds       = $this->portal->get_status('edit_data_siswa');
		$this->data_status      = $this->kelengkapanData->get_data_status();
	}

	public function dashboard()
	{
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
		];
		$this->nav_active = 'dashboard';

		$this->data_main        = $this->siswaModel->get_siswa_data_main($this->siswa->id);
		$this->presentase_total = $this->kelengkapanData->presentase_total($this->siswa->id);

		$this->siswaLog->insert_log('view', 'vn1');
		$this->kelengkapanData->update_total();
		$this->view('siswa.dashboard');
	}

	public function pengaturan()
	{
		$this->nav_link = [
			[
				'text' => 'Pengaturan',
				'link' => '/siswa/pengaturan',
			],
		];
		$this->nav_active = 'pengaturan';

		$this->akun_updated = $this->siswaModel->get_akun_updated($this->siswa->id);

		$this->update_time = $this->run("appController")->beauty_time($this->akun_updated->updated_at);

		$this->siswaLog->insert_log('view', 'vn2');
		$this->view('siswa.pengaturan');
		_remove_session('ubah_password');
	}


	public function data_pribadi()
	{
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Pribadi',
				'link' => '/siswa/data/pribadi',
			],
		];
		$this->nav_active = 'data_pribadi';

		$this->data_main    = $this->siswaModel->get_siswa_data_main($this->siswa->id);
		$this->data_pribadi = $this->siswaModel->get_siswa_data_pribadi($this->siswa->id);

		$this->data_pribadi->jenis_kelamin       = $this->siswaValue->get_value('jenis_kelamin', $this->data_pribadi->jenis_kelamin);
		$this->data_pribadi->agama               = $this->siswaValue->get_value('agama', $this->data_pribadi->agama);
		$this->data_pribadi->kewarganegaraan     = $this->siswaValue->get_value('kewarganegaraan', $this->data_pribadi->kewarganegaraan);
		$this->data_pribadi->berkebutuhan_khusus = $this->siswaValue->get_value('berkebutuhan_khusus', $this->data_pribadi->berkebutuhan_khusus);
		$this->data_pribadi->tempat_tinggal      = $this->siswaValue->get_value('tempat_tinggal', $this->data_pribadi->tempat_tinggal);
		$this->data_pribadi->transportasi        = $this->siswaValue->get_value('transportasi', $this->data_pribadi->transportasi);

		$this->update_time = $this->run("appController")->beauty_time($this->data_pribadi->updated_at);

		$this->siswaLog->insert_log('view', 'vnd1');
		$this->view('siswa.data.pribadi');
	}

	public function edit_pribadi()
	{
		$this->siswaAuth->edit_data_auth($this->portal_eds, $this->data_status);
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Pribadi',
				'link' => '/siswa/data/pribadi',
			],
			[
				'text' => 'Edit',
				'link' => '/siswa/data/pribadi/edit',
			],
		];
		$this->nav_active = 'data_pribadi';

		$this->data_main    = $this->siswaModel->get_siswa_data_main($this->siswa->id);
		$this->data_pribadi = $this->siswaModel->get_siswa_data_pribadi($this->siswa->id);

		$this->agama_obj               = $this->siswaValue->get_data('agama');
		$this->kewarganegaraan_obj     = $this->siswaValue->get_data('kewarganegaraan');
		$this->berkebutuhan_khusus_obj = $this->siswaValue->get_data('berkebutuhan_khusus');
		$this->tempat_tinggal_obj      = $this->siswaValue->get_data('tempat_tinggal');
		$this->transportasi_obj        = $this->siswaValue->get_data('transportasi');

		$this->siswaLog->insert_log('view', 'vde1');
		$this->view('siswa.edit.pribadi');
	}


	public function data_ayah()
	{
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Ayah',
				'link' => '/siswa/data/ayah',
			],
		];
		$this->nav_active = 'data_ayah';

		$this->data_ayah = $this->siswaModel->get_siswa_data_ayah($this->siswa->id);

		$this->data_ayah->pendidikan          = $this->siswaValue->get_value('pendidikan', $this->data_ayah->pendidikan);
		$this->data_ayah->pekerjaan           = $this->siswaValue->get_value('pekerjaan', $this->data_ayah->pekerjaan);
		$this->data_ayah->penghasilan         = $this->siswaValue->get_value('penghasilan', $this->data_ayah->penghasilan);
		$this->data_ayah->berkebutuhan_khusus = $this->siswaValue->get_value('berkebutuhan_khusus', $this->data_ayah->berkebutuhan_khusus);

		$this->update_time = $this->run("appController")->beauty_time($this->data_ayah->updated_at);

		$this->siswaLog->insert_log('view', 'vnd2');
		$this->view('siswa.data.ayah');
	}

	public function edit_ayah()
	{
		$this->siswaAuth->edit_data_auth($this->portal_eds, $this->data_status);
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Ayah',
				'link' => '/siswa/data/ayah',
			],
			[
				'text' => 'Edit',
				'link' => '/siswa/data/ayah/edit',
			],
		];
		$this->nav_active = 'data_ayah';

		$this->data_ayah = $this->siswaModel->get_siswa_data_ayah($this->siswa->id);
		
		$this->pendidikan_obj          = $this->siswaValue->get_data('pendidikan');
		$this->pekerjaan_obj           = $this->siswaValue->get_data('pekerjaan');
		$this->penghasilan_obj         = $this->siswaValue->get_data('penghasilan');
		$this->berkebutuhan_khusus_obj = $this->siswaValue->get_data('berkebutuhan_khusus');

		$this->siswaLog->insert_log('view', 'vde2');
		$this->view('siswa.edit.ayah');
	}


	public function data_ibu()
	{
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Ibu',
				'link' => '/siswa/data/ibu',
			],
		];
		$this->nav_active = 'data_ibu';

		$this->data_ibu = $this->siswaModel->get_siswa_data_ibu($this->siswa->id);

		$this->data_ibu->pendidikan          = $this->siswaValue->get_value('pendidikan', $this->data_ibu->pendidikan);
		$this->data_ibu->pekerjaan           = $this->siswaValue->get_value('pekerjaan', $this->data_ibu->pekerjaan);
		$this->data_ibu->penghasilan         = $this->siswaValue->get_value('penghasilan', $this->data_ibu->penghasilan);
		$this->data_ibu->berkebutuhan_khusus = $this->siswaValue->get_value('berkebutuhan_khusus', $this->data_ibu->berkebutuhan_khusus);

		$this->update_time = $this->run("appController")->beauty_time($this->data_ibu->updated_at);

		$this->siswaLog->insert_log('view', 'vnd3');
		$this->view('siswa.data.ibu');
	}

	public function edit_ibu()
	{
		$this->siswaAuth->edit_data_auth($this->portal_eds, $this->data_status);
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Ibu',
				'link' => '/siswa/data/ibu',
			],
			[
				'text' => 'Edit',
				'link' => '/siswa/data/ibu/edit',
			],
		];
		$this->nav_active = 'data_ibu';

		$this->data_ibu = $this->siswaModel->get_siswa_data_ibu($this->siswa->id);
		
		$this->pendidikan_obj          = $this->siswaValue->get_data('pendidikan');
		$this->pekerjaan_obj           = $this->siswaValue->get_data('pekerjaan');
		$this->penghasilan_obj         = $this->siswaValue->get_data('penghasilan');
		$this->berkebutuhan_khusus_obj = $this->siswaValue->get_data('berkebutuhan_khusus');

		$this->siswaLog->insert_log('view', 'vde3');
		$this->view('siswa.edit.ibu');
	}


	public function data_wali()
	{
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Wali',
				'link' => '/siswa/data/wali',
			],
		];
		$this->nav_active = 'data_wali';

		$this->data_wali = $this->siswaModel->get_siswa_data_wali($this->siswa->id);
		if(!$this->data_wali)
		{
			$this->siswaModel->insert_data_wali_null($this->siswa->id, time_now());
			$this->data_wali = $this->siswaModel->get_siswa_data_wali($this->siswa->id);
		}

		$this->data_wali->pendidikan          = $this->siswaValue->get_value('pendidikan', $this->data_wali->pendidikan);
		$this->data_wali->pekerjaan           = $this->siswaValue->get_value('pekerjaan', $this->data_wali->pekerjaan);
		$this->data_wali->penghasilan         = $this->siswaValue->get_value('penghasilan', $this->data_wali->penghasilan);
		$this->data_wali->berkebutuhan_khusus = $this->siswaValue->get_value('berkebutuhan_khusus', $this->data_wali->berkebutuhan_khusus);

		$this->update_time = $this->run("appController")->beauty_time($this->data_wali->updated_at);

		$this->siswaLog->insert_log('view', 'vnd4');
		$this->view('siswa.data.wali');
	}

	public function edit_wali()
	{
		$this->siswaAuth->edit_data_auth($this->portal_eds, $this->data_status);
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Wali',
				'link' => '/siswa/data/wali',
			],
			[
				'text' => 'Edit',
				'link' => '/siswa/data/wali/edit',
			],
		];
		$this->nav_active = 'data_wali';

		$this->data_wali = $this->siswaModel->get_siswa_data_wali($this->siswa->id);
		
		$this->pendidikan_obj          = $this->siswaValue->get_data('pendidikan');
		$this->pekerjaan_obj           = $this->siswaValue->get_data('pekerjaan');
		$this->penghasilan_obj         = $this->siswaValue->get_data('penghasilan');
		$this->berkebutuhan_khusus_obj = $this->siswaValue->get_data('berkebutuhan_khusus');

		$this->wali_class = null;
		if (!$this->data_wali->memiliki_wali) $this->wali_class = 'hide-form';

		$this->siswaLog->insert_log('view', 'vde4');
		$this->view('siswa.edit.wali');
	}


	public function data_kontak()
	{
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Kontak',
				'link' => '/siswa/data/kontak',
			],
		];
		$this->nav_active = 'data_kontak';

		$this->data_kontak = $this->siswaModel->get_siswa_data_kontak($this->siswa->id);

		$this->update_time = $this->run("appController")->beauty_time($this->data_kontak->updated_at);

		$this->siswaLog->insert_log('view', 'vnd5');
		$this->view('siswa.data.kontak');
	}

	public function edit_kontak()
	{
		$this->siswaAuth->edit_data_auth($this->portal_eds, $this->data_status);
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Kontak',
				'link' => '/siswa/data/kontak',
			],
			[
				'text' => 'Edit',
				'link' => '/siswa/data/kontak/edit',
			],
		];
		$this->nav_active = 'data_kontak';

		$this->data_kontak = $this->siswaModel->get_siswa_data_kontak($this->siswa->id);
		
		$this->siswaLog->insert_log('view', 'vde5');
		$this->view('siswa.edit.kontak');
	}


	public function data_periodik()
	{
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Periodik',
				'link' => '/siswa/data/periodik',
			],
		];
		$this->nav_active = 'data_periodik';

		$this->data_periodik = $this->siswaModel->get_siswa_data_periodik($this->siswa->id);

		$this->update_time = $this->run("appController")->beauty_time($this->data_periodik->updated_at);

		$this->siswaLog->insert_log('view', 'vnd6');
		$this->view('siswa.data.periodik');
	}

	public function edit_periodik()
	{
		$this->siswaAuth->edit_data_auth($this->portal_eds, $this->data_status);
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Periodik',
				'link' => '/siswa/data/periodik',
			],
			[
				'text' => 'Edit',
				'link' => '/siswa/data/periodik/edit',
			],
		];
		$this->nav_active = 'data_periodik';

		$this->data_periodik = $this->siswaModel->get_siswa_data_periodik($this->siswa->id);

		$this->siswaLog->insert_log('view', 'vde7');
		$this->view('siswa.edit.periodik');
	}


	public function data_dokumen()
	{
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Dokumen',
				'link' => '/siswa/data/dokumen',
			],
		];
		$this->nav_active = 'data_dokumen';

		$this->path_dir     = 'dokumen/' . $this->siswa->id . '/';
		$this->data_dokumen = $this->siswaModel->get_siswa_data_dokumen($this->siswa->id);

		$this->update_time = $this->run("appController")->beauty_time($this->data_dokumen->updated_at);

		$this->ijazah_depan    = $this->path_dir . $this->data_dokumen->ijazah_depan;
		$this->ijazah_belakang = $this->path_dir . $this->data_dokumen->ijazah_belakang;
		$this->skhu            = $this->path_dir . $this->data_dokumen->skhu;
		$this->kartu_keluarga  = $this->path_dir . $this->data_dokumen->kartu_keluarga;

		$this->siswaLog->insert_log('view', 'vnd7');
		$this->view('siswa.data.dokumen');
	}

	public function edit_dokumen()
	{
		$this->siswaAuth->edit_data_auth($this->portal_eds, $this->data_status);
		$this->nav_link = [
			[
				'text' => 'Dashboard',
				'link' => '/siswa/dashboard',
			],
			[
				'text' => 'Data Dokumen',
				'link' => '/siswa/data/dokumen',
			],
			[
				'text' => 'Edit',
				'link' => '/siswa/data/dokumen/edit',
			],
		];
		$this->nav_active = 'data_dokumen';

		$this->path_dir     = 'dokumen/' . $this->siswa->id . '/';
		$this->data_dokumen = $this->siswaModel->get_siswa_data_dokumen($this->siswa->id);

		$this->ijazah_depan    = $this->path_dir . $this->data_dokumen->ijazah_depan;
		$this->ijazah_belakang = $this->path_dir . $this->data_dokumen->ijazah_belakang;
		$this->skhu            = $this->path_dir . $this->data_dokumen->skhu;
		$this->kartu_keluarga  = $this->path_dir . $this->data_dokumen->kartu_keluarga;

		$this->siswaLog->insert_log('view', 'vde7');
		$this->view('siswa.edit.dokumen');
	}
	
}