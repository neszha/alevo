<?php
/**
 * @Controller  : admin_siswaController made by .ALEVO.
 * @Date        : 2020-04-17 03:44:58
 * @Message     : Don't be lazy typing
 */
class admin_siswaController extends Controller
{

	public function __construct()
	{
		$this->adminAuth       = $this->run('admin_authController');
		$this->siswaValue      = $this->run('siswa_valueController');
		$this->kelengkapanData = $this->run('siswa_kelengkapanDataController');
		$this->siswaModel      = $this->model('siswaModel');
		$this->admin           = $this->adminAuth->auth();
	}

	public function check_before_input()
	{
		$this->id   = _post('id');
		$this->nisn =_post('nisn');
		$this->res  = $this->siswaModel->nisn_rows($this->nisn);
		$this->end  = ['result' => false, 'id' => $this->id];
		if ($this->res > 0) $this->end['result'] = true;
		echo json_encode($this->end);
	}

	public function main_insert()
	{
		$data       = _post();
		$nisn_rows  = $this->siswaModel->nisn_rows($data['nisn']);
		if(!$nisn_rows)
		{	
			$id         = $this->siswaModel->insert_siswa_akun($data['nisn'], $this->set_password_siswa());
			$data['id'] = $id;
			$this->siswaModel->insert_siswa_data_main($data);
			$this->siswa_data_insert_null($id);
			$this->kelengkapanData->presentase_data_check($id);
			$this->kelengkapanData->update_total($id);
			echo json_encode(['result' => true]);
			exit();
		}
		echo json_encode(['result' => 'isset']);
	}

	public function siswa_data_insert_null($id)
	{
		$this->time = time_now();
		$this->siswaModel->insert_data_pribadi_null($id, $this->time);
		$this->siswaModel->insert_data_ayah_null($id, $this->time);
		$this->siswaModel->insert_data_ibu_null($id, $this->time);
		$this->siswaModel->insert_data_wali_null($id, $this->time);
		$this->siswaModel->insert_data_kontak_null($id, $this->time);
		$this->siswaModel->insert_data_periodik_null($id, $this->time);
		$this->siswaModel->insert_data_dokumen_null($id, $this->time);
	}

	public function set_password_siswa()
	{
		$length    = 7;
		$array     = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
		$new_array = [];

		for ($i=0; $i < $length; $i++)
		{
			$index = array_rand($array);
			$new[] = $array[$index];
		}
		$passowrd = implode(null, $new);
		return $passowrd;
	}

	public function get_data_siswa()
	{
		$this->presentaseDataSiswa = $this->run('siswa_kelengkapanDataController');
		$this->data_diri = [];
		if (!is_null(_post('query_search')))
		{
			$filter        = (object)(null);
			$filter->type  = _post('type');
			$filter->limit = _post('limit');
			$filter->q     = _post('query_search');
			if($filter->limit == 'default') $filter->limit = 50;

			if($filter->type == 'default' AND $filter->limit == 'false')
			{
				$this->data_diri = $this->siswaModel->admin_get_data_siswa_type_default_no_limit($filter->q);
			}

			if($filter->type == 'default' AND $filter->limit != 'false')
			{
				$this->data_diri = $this->siswaModel->admin_get_data_siswa_type_default_use_limit($filter->q, $filter->limit);
			}

			if($filter->type != 'default' AND $filter->limit == 'false')
			{
				$this->data_diri = $this->siswaModel->admin_get_data_siswa_with_type_no_limit($filter->q, $filter->type);
			}

			if($filter->type != 'default' AND $filter->limit != 'false')
			{
				$this->data_diri = $this->siswaModel->admin_get_data_siswa_use_type_use_limit($filter->q, $filter->type, $filter->limit);
			}

			if (count($this->data_diri) == 0)
			{
				$this->data_diri = $this->siswaModel->admin_get_data_siswa_type_default_no_limit($filter->q);
			}
		}else{
			if (!is_null(_post('get_all'))) {
				$this->data_diri = $this->siswaModel->admin_get_all_data_siswa();
			}else{
				$this->data_diri = $this->siswaModel->admin_get_data_siswa_when_load();
			}
		}

		$this->data_filter = [];

		foreach ($this->data_diri as $i => $x) // Filter data
		{
			$x->no                  = $i + 1;
			$x->jenis_kelamin       = $this->siswaValue->get_value('jenis_kelamin', $x->jenis_kelamin);
			$x->agama               = $this->siswaValue->get_value('agama', $x->agama);
			$x->kewarganegaraan     = $this->siswaValue->get_value('kewarganegaraan', $x->kewarganegaraan);
			$x->berkebutuhan_khusus = $this->siswaValue->get_value('berkebutuhan_khusus', $x->berkebutuhan_khusus);
			$x->tempat_tinggal      = $this->siswaValue->get_value('tempat_tinggal', $x->tempat_tinggal);
			$x->transportasi        = $this->siswaValue->get_value('transportasi', $x->transportasi);

			unset($x->data_delete);

			$this->data_kontak   = $this->siswaModel->get_siswa_data_kontak($x->siswa_akun);
			foreach ($this->data_kontak as $key => $value) $x->$key = $value;

			$this->data_periodik = $this->siswaModel->get_siswa_data_periodik($x->siswa_akun);
			foreach ($this->data_periodik as $key => $value) $x->$key = $value;

			$this->data_dokumen  = $this->siswaModel->get_siswa_data_dokumen($x->siswa_akun);
			foreach ($this->data_dokumen as $key => $value) $x->$key = $value;

			// mengambil data ayah
			$this->data_ayah                      = $this->siswaModel->get_siswa_data_ayah($x->siswa_akun);
			$this->data_ayah->pendidikan          = $this->siswaValue->get_value('pendidikan', $this->data_ayah->pendidikan);
			$this->data_ayah->pekerjaan           = $this->siswaValue->get_value('pekerjaan', $this->data_ayah->pekerjaan);
			$this->data_ayah->penghasilan         = $this->siswaValue->get_value('penghasilan', $this->data_ayah->penghasilan);
			$this->data_ayah->berkebutuhan_khusus = $this->siswaValue->get_value('berkebutuhan_khusus', $this->data_ayah->berkebutuhan_khusus);

			foreach ($this->data_ayah as $key => $value)
			{
				$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];
				if (!in_array($key, $not))
				{
					$key = "ayah_" . $key;
					$x->$key = $value;
				}
			}

			// Mengambil data ibu
			$this->data_ibu                      = $this->siswaModel->get_siswa_data_ibu($x->siswa_akun);
			$this->data_ibu->pendidikan          = $this->siswaValue->get_value('pendidikan', $this->data_ibu->pendidikan);
			$this->data_ibu->pekerjaan           = $this->siswaValue->get_value('pekerjaan', $this->data_ibu->pekerjaan);
			$this->data_ibu->penghasilan         = $this->siswaValue->get_value('penghasilan', $this->data_ibu->penghasilan);
			$this->data_ibu->berkebutuhan_khusus = $this->siswaValue->get_value('berkebutuhan_khusus', $this->data_ibu->berkebutuhan_khusus);
			foreach ($this->data_ibu as $key => $value)
			{
				$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];
				if (!in_array($key, $not))
				{
					$key = "ibu_" . $key;
					$x->$key = $value;
				}
			}

			// Mengambil data wali
			$this->data_wali = $this->siswaModel->get_siswa_data_wali($x->siswa_akun);

			if (!$this->data_wali || $this->data_wali->memiliki_wali === '0' || $this->data_wali->memiliki_wali === '')
			{
				$this->data_wali                      = (object) null;
				$this->data_wali->memiliki_wali       = 'Tidak';
				$this->data_wali->pendidikan          = null;
				$this->data_wali->pekerjaan           = null;
				$this->data_wali->penghasilan         = null;
				$this->data_wali->berkebutuhan_khusus = null;
			}else{
				$this->data_wali->memiliki_wali       = 'Iya';
				$this->data_wali->pendidikan          = $this->siswaValue->get_value('pendidikan', $this->data_wali->pendidikan);
				$this->data_wali->pekerjaan           = $this->siswaValue->get_value('pekerjaan', $this->data_wali->pekerjaan);
				$this->data_wali->penghasilan         = $this->siswaValue->get_value('penghasilan', $this->data_wali->penghasilan);
				$this->data_wali->berkebutuhan_khusus = $this->siswaValue->get_value('berkebutuhan_khusus', $this->data_wali->berkebutuhan_khusus);
			}

			foreach ($this->data_wali as $key => $value)
			{
				$not = ['id', 'siswa_akun', 'created_at', 'updated_at'];
				if (!in_array($key, $not))
				{
					$key     = "wali_" . $key;
					$x->$key = $value;
				}
			}
			
			$x->lengkap     = $this->presentaseDataSiswa->presentase_total($x->siswa_akun);
			$x->data_status = $this->presentaseDataSiswa->get_data_status($x->id);

			$this->data_filter[] = $x;
		}

		echo json_encode($this->data_filter);
		exit();
	}

	public function set_admin_access()
	{
		$this->id = _data('id');
		$this->run('siswa_authController')->give_admin_access($this->id);
	}

	public function delete_data_siswa()
	{
		$id = (int)(_data('id'));
		$this->siswaModel->set_data_to_trash($id);
		echo json_encode([$id]);
	}

	public function delete_data_siswa_permanent()
	{
		$id = (int)(_data('id'));
		$this->siswaModel->delete_data_siswa_permanent($id);
		echo json_encode([$id]);
	}

	public function restore_data_siswa()
	{
		$id = (int)(_data('id'));
		$this->siswaModel->restore_data_siswa($id);
		echo json_encode([$id]);
	}

	public function get_data_sampah()
	{
		$result = [];
		$data = $this->siswaModel->get_data_sampah();

		foreach ($data as $key => $x)
		{
			$x->jenis_kelamin = $this->siswaValue->get_value('jenis_kelamin', $x->jenis_kelamin);
			$result[] = $x;
		}

		return $result;
	}

	public function delete_all_data_siswa()
	{
		$this->siswaModel->delete_all_data_siswa();
		redirect('/admin/siswa/sampah');
		exit();
	}

	public function get_data_verifikasi()
	{
		$data = $this->siswaModel->get_all_data_verifikasi();
		$array = [];
		foreach ($data as $x) 
		{
			$x->jenis_kelamin = $this->siswaValue->get_value('jenis_kelamin', $x->jenis_kelamin);
			$array[] = $x;
		}
		echo json_encode($array);
		exit();
	}

	public function verifikasi_data()
	{
		$id = _data('id');
		if($id) $this->siswaModel->verifikasi_data_siswa($id);
		echo json_encode(['result' => true]);
	}

}