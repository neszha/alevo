<?php
/**
 * @Controller  : siswa_kelengkapanDataController made by .ALEVO.
 * @Date        : 2020-04-30 02:04:29
 * @Message     : Don't be lazy typing
 */
class siswa_kelengkapanDataController extends Controller
{

	public function __construct()
	{
		$this->siswaAuth  = $this->run('siswa_authController');
		$this->siswaModel = $this->model('siswaModel');
		$this->siswa      = $this->siswaAuth->auth();
	}

	public function data_pribadi($return = false, $id = false)
	{
		if(!$id) $id = $this->siswa->id;
		$this->data_main    = $this->siswaModel->get_siswa_data_main($id);
		$this->data_pribadi = $this->siswaModel->get_siswa_data_pribadi($id);

		$this->data_array = [];

		foreach ($this->data_main as $key => $value) 
		{
			if($key == 'nama') $this->data_array[] = $value;
		}

		$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];

		foreach ($this->data_pribadi as $key => $value) 
		{
			if (!in_array($key, $not)) $this->data_array[] = $value;
		}

		$this->hitung_kelengkapan_data();
		if($return) return $this->presentase_kelengkapan;
		$this->siswaModel->update_presentase_data('data_pribadi', $this->presentase_kelengkapan, $id);
	}

	public function data_ayah($return = false, $id = false)
	{
		if(!$id) $id = $this->siswa->id;
		$this->data_ayah = $this->siswaModel->get_siswa_data_ayah($id);

		$this->data_array = [];

		$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];

		foreach ($this->data_ayah as $key => $value) 
		{
			if (!in_array($key, $not)) $this->data_array[] = $value;
		}

		$this->hitung_kelengkapan_data();
		if($return) return $this->presentase_kelengkapan;
		$this->siswaModel->update_presentase_data('data_ayah', $this->presentase_kelengkapan, $id);
	}

	public function data_ibu($return = false, $id = false)
	{
		if(!$id) $id = $this->siswa->id;
		$this->data_ibu = $this->siswaModel->get_siswa_data_ibu($id);

		$this->data_array = [];

		$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];

		foreach ($this->data_ibu as $key => $value) 
		{
			if (!in_array($key, $not)) $this->data_array[] = $value;
		}

		$this->hitung_kelengkapan_data();
		if($return) return $this->presentase_kelengkapan;
		$this->siswaModel->update_presentase_data('data_ibu', $this->presentase_kelengkapan, $id);
	}

	public function data_wali($return = false, $id = false)
	{
		if(!$id) $id = $this->siswa->id;
		$this->data_wali = $this->siswaModel->get_siswa_data_wali($id);

		$this->presentase_kelengkapan = 100;
		if ($this->data_wali->memiliki_wali == 1) 
		{
			$this->data_array = [];

			$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];

			foreach ($this->data_wali as $key => $value) 
			{
				if (!in_array($key, $not)) $this->data_array[] = $value;
			}

			$this->hitung_kelengkapan_data();
		}
		if($return) return $this->presentase_kelengkapan;
		$this->siswaModel->update_presentase_data('data_wali', $this->presentase_kelengkapan, $id);
	}

	public function data_kontak($return = false, $id = false)
	{
		if(!$id) $id = $this->siswa->id;
		$this->data_kontak = $this->siswaModel->get_siswa_data_kontak($id);

		$this->data_array = [];

		$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];

		foreach ($this->data_kontak as $key => $value) 
		{
			if (!in_array($key, $not)) $this->data_array[] = $value;
		}

		$this->hitung_kelengkapan_data();
		if($return) return $this->presentase_kelengkapan;
		$this->siswaModel->update_presentase_data('data_kontak', $this->presentase_kelengkapan, $id);
	}

	public function data_periodik($return = false, $id = false)
	{
		if(!$id) $id = $this->siswa->id;
		$this->data_periodik = $this->siswaModel->get_siswa_data_periodik($id);

		$this->data_array = [];

		$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];

		foreach ($this->data_periodik as $key => $value) 
		{
			if (!in_array($key, $not)) $this->data_array[] = $value;
		}

		$this->hitung_kelengkapan_data();
		if($return) return $this->presentase_kelengkapan;
		$this->siswaModel->update_presentase_data('data_periodik', $this->presentase_kelengkapan, $id);
	}

	public function data_dokumen($return = false, $id = false)
	{
		if(!$id) $id = $this->siswa->id;
		$this->data_dokumen = $this->siswaModel->get_siswa_data_dokumen($id);

		$path_dir = 'dokumen/' . $id . '/';
		$length   = 0;
		$true     = 0;

		$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];

		foreach ($this->data_dokumen as $key => $value) 
		{
			if (!in_array($key, $not))
			{
				$length++;
				$file_path = $path_dir . $value;
				if(file_exists($file_path) && is_file($file_path)) $true ++;
			}
		}

		$this->presentase_kelengkapan = (int)($true / $length * 100);
		if($return) return $this->presentase_kelengkapan;
		$this->siswaModel->update_presentase_data('data_dokumen', $this->presentase_kelengkapan, $id);
	}

	public function hitung_kelengkapan_data()
	{
		$length = count($this->data_array);
		$true = 0;
		foreach ($this->data_array as $key => $value) 
		{
			$check = strlen(preg_replace('/\s/', null, $value));
			if ($check != 0) $true++;
		}

		$this->presentase_kelengkapan = (int)($true / $length * 100);
	}

	public function presentase_total($id_siswa)
	{
		$data       = $this->siswaModel->get_presentase_data($id_siswa);
		$data_array = [];
		$jumlah     = 0;
		$color      = 'red';

		if ($data)
		{
			$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];

			foreach ($data as $key => $value) 
			{
				if (!in_array($key, $not))
				{
					$data_array[] = $value;
					$jumlah = $jumlah + $value;
				}
			}

			$presentase = (int)($jumlah / count($data_array));

			if($presentase >= 100) $color = 'blue';
		}else{
			$this->presentase_data_check($id_siswa);
			$presentase = $this->presentase_total($id_siswa)['presentase'];
		}

		if($this->siswaModel->siswa_verifikasi_rows_by_id($id_siswa) < 1)
		{
			$this->siswaModel->insert_first_siswa_verifikasi($id_siswa, $presentase);
		}

		$presentase_total = ['presentase' => $presentase, 'presentase2' => $presentase . '%', 'color' => $color];

		return $presentase_total;
	}

	public function total($id = false)
	{
		if(!$id) $id = $this->siswa->id;
		$presentase = $this->presentase_total($id);
		return $presentase['presentase'];
	}

	public function presentase_data_check($id_siswa)
	{
		if ($this->siswaModel->presentase_data_row($id_siswa) == 0)
		{
			$array = [
				'siswa_akun'    => $id_siswa,
				'data_pribadi'  => $this->data_pribadi(true, $id_siswa),
				'data_ayah'     => $this->data_ayah(true, $id_siswa),
				'data_ibu'      => $this->data_ibu(true, $id_siswa),
				'data_wali'     => $this->data_wali(true, $id_siswa),
				'data_kontak'   => $this->data_kontak(true, $id_siswa),
				'data_periodik' => $this->data_periodik(true, $id_siswa),
				'data_dokumen'  => $this->data_dokumen(true, $id_siswa),
				'created_at'    => time_now(),
				'updated_at'    => time_now(),
			];
			$this->siswaModel->insert_first_presentase_data($array);
		}
	}

	public function presentase_data_color($data)
	{
		$new_data = [];
		foreach ($data as $key => $value) 
		{
			if($value == 100) $new_data[$key] = 'blue';
			if($value < 100) $new_data[$key] = 'red';
		}
		return $new_data;
	}

	public function update_total($id = false)
	{
		if(!$id) $id = $this->siswa->id;
		$total = $this->total($id);

		if($this->siswaModel->siswa_verifikasi_rows_by_id($id) < 1)
		{
			$this->siswaModel->insert_first_siswa_verifikasi($id, $total);
		}else{
			$verifikasi = $this->siswaModel->get_verifikasi_velue($id);
			if($verifikasi && $total != 100) $verifikasi = false;
			$this->siswaModel->update_presentase_data_in_verifikasi($id, $total, $verifikasi);
		}
	}

	public function get_data_status($id = false, $with_value = false)
	{
		if(!$id) $id = $this->siswa->id;
		$total  = $this->total($id);
		$status = 0;

		if($this->siswaModel->siswa_verifikasi_rows_by_id($id) > 0)
		{
			$verifikasi = $this->siswaModel->get_verifikasi_velue($id);
			if(!$verifikasi && $total == 100) $status = 1;
			if($verifikasi && $total == 100) $status = 2;
		}

		if($with_value)
		{
			if($status == 0) $status = 'Belum Lengkap';
			if($status == 1) $status = 'Proses Verifikasi';
			if($status == 2) $status = 'Terverifikasi';
		}

		return $status;
	}
}