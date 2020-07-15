<?php
/**
 * @Controller  : siswa_apiController made by .ALEVO.
 * @Date        : 2020-04-23 02:48:32
 * @Message     : Don't be lazy typing
 */
class siswa_apiController extends Controller
{

	public function __construct()
	{
		$this->siswaAuth       = $this->run('siswa_authController');
		$this->siswaValue      = $this->run('siswa_valueController');
		$this->portal          = $this->run('portalController');
		$this->kelengkapanData = $this->run('siswa_kelengkapanDataController');
		$this->siswaLog        = $this->run('siswa_logController');
		$this->siswaModel      = $this->model('siswaModel');
		$this->siswa           = $this->siswaAuth->auth();
		$this->portal_eds      = $this->portal->get_status('edit_data_siswa');
		$this->data_status     = $this->kelengkapanData->get_data_status();
	}

	public function perbarui_data_pribadi()
	{
		if (_post('simpan_data_pribadi') && $this->portal_eds && $this->data_status != 2)
		{
			$this->siswaModel->simpan_data_pribadi(_post(), $this->siswa->id);
			$this->kelengkapanData->data_pribadi();
			$this->kelengkapanData->update_total();
			$this->siswaLog->insert_log('update', 'ud1');
		}
		redirect('/siswa/data/pribadi');
		exit();
	}

	public function perbarui_data_ayah()
	{
		if (_post('simpan_data_ayah') && $this->portal_eds && $this->data_status != 2) 
		{
			$this->siswaModel->simpan_data_ayah(_post(), $this->siswa->id);
			$this->kelengkapanData->data_ayah();
			$this->kelengkapanData->update_total();
			$this->siswaLog->insert_log('update', 'ud2');
		}
		redirect('/siswa/data/ayah');
		exit();
	}

	public function perbarui_data_ibu()
	{
		if (_post('simpan_data_ibu') && $this->portal_eds && $this->data_status != 2) 
		{
			$this->siswaModel->simpan_data_ibu(_post(), $this->siswa->id);
			$this->kelengkapanData->data_ibu();
			$this->kelengkapanData->update_total();
			$this->siswaLog->insert_log('update', 'ud3');
		}
		redirect('/siswa/data/ibu');
		exit();
	}

	public function perbarui_data_wali()
	{
		if (_post('simpan_data_wali') && $this->portal_eds && $this->data_status != 2) 
		{
			$data = _post();
			if (isset($data['memiliki_wali'])) 
			{
				if ($data['memiliki_wali'] == 'on') $data['memiliki_wali'] = 1;
			}else{
				$data['memiliki_wali'] = 0;
			}
			$this->siswaModel->simpan_data_wali($data, $this->siswa->id);
			$this->kelengkapanData->data_wali();
			$this->kelengkapanData->update_total();
			$this->siswaLog->insert_log('update', 'ud4');
		}
		redirect('/siswa/data/wali');
		exit();
	}

	public function perbarui_data_kontak()
	{
		if (_post('simpan_data_kontak') && $this->portal_eds && $this->data_status != 2) 
		{
			$this->siswaModel->simpan_data_kontak(_post(), $this->siswa->id);
			$this->kelengkapanData->data_kontak();
			$this->kelengkapanData->update_total();
			$this->siswaLog->insert_log('update', 'ud5');
		}
		redirect('/siswa/data/kontak');
		exit();
	}

	public function perbarui_data_periodik()
	{
		if (_post('simpan_data_periodik') && $this->portal_eds && $this->data_status != 2) 
		{
			$this->siswaModel->simpan_data_periodik(_post(), $this->siswa->id);
			$this->kelengkapanData->data_periodik();
			$this->kelengkapanData->update_total();
			$this->siswaLog->insert_log('update', 'ud6');
		}
		redirect('/siswa/data/periodik');
		exit();
	}

	public function perbarui_data_dokumen()
	{
		if (_post('simpan-dokumen') && $this->portal_eds && $this->data_status != 2) 
		{
			foreach ($_FILES as $key => $value) 
			{
				if ($value['tmp_name'] != '' && $value['size'] < 320000 && $value['error'] == 0) 
				{
					if ($value['type'] == 'image/png' || $value['type'] == 'image/jpg' || $value['type'] == 'image/jpeg') 
					{
						$file_name_array = explode('.', $value['name']);
						$this->file_name = md5(uniqid()) . '.' . end($file_name_array);
						$this->path_dir  = 'dokumen/' . $this->siswa->id . '/';
						make_dir($this->path_dir);
						$this->file_path = $this->path_dir .$this->file_name;

						$move = move_uploaded_file($value['tmp_name'], $this->file_path); // Move

						if ($move) 
						{
							// Hapus file sebelumnya
							$this->old_file      = $this->siswaModel->get_document_old_by_key($key, $this->siswa->id);
							$this->old_file_path = $this->path_dir . $this->old_file;

							if (is_file($this->old_file_path)) unlink($this->old_file_path);

							// Simpan file baru ke database
							$this->siswaModel->update_document_path_by_key($key, $this->file_name, $this->siswa->id);
						}
					}
				}
			}
			$this->kelengkapanData->data_dokumen();
			$this->kelengkapanData->update_total();
			$this->siswaLog->insert_log('update', 'ud7');
		}
		redirect('/siswa/data/dokumen');
		exit();
	}

	public function perbarui_password()
	{
		
		if(_post('ubah-password'))
		{
			_set_session('ubah_password', 'password_lama_tidak_sama');
			if ($this->siswaModel->password_rows(_post('password_lama')) != 0) 
			{
				_set_session('ubah_password', 'password_baru_tidak_sama');
				if (_post('password_baru') == _post('verifikasi_passowrd_baru')) 
				{
					$this->siswaModel->ubah_password($this->siswa->id, _post('password_baru'));
					_set_session('ubah_password', 'success');
					$this->siswaLog->insert_log('update', 'up');
				}	
			}
		}
		redirect('/siswa/pengaturan');
		exit();
	}
	
}