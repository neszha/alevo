<?php 
/**
 * @Model       : siswaModel made by .ALEVO.
 * @Date        : 2020-04-20 01:26:34
 * @Message     : Don't be lazy typing
 */

class siswaModel extends DB
{

	public function __construct()
	{
		$this->time = time_now();
	}

	/**
	 *	+++++++++++++++++++ Get result method.
	 */
	
	public function admin_token_rows($token)
	{
		return $this->table('admin_login')->select('id')->where('admin_token', $token)->rows();
	}

	public function nisn_rows($nisn)
	{
		return $this->table('siswa_akun')->select('id')
		->where('nisn', $nisn)->and()->where('data_delete', 'no')
		->rows();
	}

	public function password_rows($password)
	{
		return $this->table('siswa_akun')
		->where('password', $password)->and()->where('data_delete', 'no')
		->rows();
	}

	public function get_data_akun_by_nisn($nisn)
	{
		return $this->table('siswa_akun')
		->where('nisn', $nisn)->and()->where('data_delete', 'no')
		->get();
	}

	public function get_data_akun_by_id($id)
	{
		return $this->table('siswa_akun')
		->where('id', $id)->and()->where('data_delete', 'no')
		->get();
	}

	public function siswa_token_rows($token)
	{
		return $this->table('siswa_login')->select('siswa_akun.id')
		->join('siswa_akun')->on('siswa_login.siswa_akun', 'siswa_akun.id')
		->where('siswa_token', $token)->and()
		->where('data_delete', 'no')
		->rows();
	}

	public function get_data_siswa_by_token($token)
	{
		return $this->table('siswa_login')->select('siswa_akun.id, siswa_akun.nisn, nama, status, foto')
		->join('siswa_akun')->on('siswa_login.siswa_akun', 'siswa_akun.id')
		->join('siswa_data_main')->on('siswa_data_main.siswa_akun', 'siswa_akun.id')
		->where('siswa_login.siswa_token', $token)->and()->where('data_delete', 'no')
		->get();
	}

	public function get_siswa_data_main($id)
	{
		return $this->table('siswa_data_main')->select('nama, angkatan, status, jurusan, foto')->where('siswa_akun', $id)->get();
	}

	public function get_siswa_data_pribadi($id)
	{
		return $this->table('siswa_data_pribadi')->where('siswa_akun', $id)->get();
	}

	public function get_siswa_data_ayah($id)
	{
		return $this->table('siswa_data_ayah')->where('siswa_akun', $id)->get();
	}

	public function get_siswa_data_ibu($id)
	{
		return $this->table('siswa_data_ibu')->where('siswa_akun', $id)->get();
	}

	public function get_siswa_data_wali($id)
	{
		return $this->table('siswa_data_wali')->where('siswa_akun', $id)->get();
	}

	public function get_siswa_data_kontak($id)
	{
		return $this->table('siswa_data_kontak')->where('siswa_akun', $id)->get();
	}

	public function get_siswa_data_periodik($id)
	{
		return $this->table('siswa_data_periodik')->where('siswa_akun', $id)->get();
	}

	public function get_siswa_data_dokumen($id)
	{
		return $this->table('siswa_data_dokumen')->where('siswa_akun', $id)->get();
	}

	public function get_document_old_by_key($key, $siswa_id)
	{
		$this->data = $this->table('siswa_data_dokumen')->select($key)->get();
		return $this->data->$key;
	}

	public function presentase_data_row($siswa_akun)
	{
		return $this->table('siswa_presentase_data')->select('id')->where('siswa_akun', $siswa_akun)->rows();
	}

	public function get_presentase_data($id)
	{
		return $this->table('siswa_presentase_data')->where('siswa_akun', $id)->get();
	}

	public function get_akun_updated($id)
	{
		return $this->table('siswa_akun')->select('created_at, updated_at')
		->where('id', $id)->and()->where('data_delete', 'no')
		->get();
	}

	public function total_data_siswa()
	{
		return $this->table('siswa_akun')->select('id')
		->where('data_delete', 'no')
		->rows();
	}

	public function get_data_sampah()
	{
		return $this->table('siswa_akun')
		->select('siswa_akun.id, nisn, nama, jenis_kelamin, jurusan, angkatan, status')
		->join('siswa_data_main')->on('siswa_akun.id', 'siswa_data_main.siswa_akun')
		->join('siswa_data_pribadi')->on('siswa_akun.id', 'siswa_data_pribadi.siswa_akun')
		->where('data_delete', '!=', 'no')
		->order_by('siswa_akun.updated_at')
		->get_all();
	}

	public function total_data_siswa_sudah_lengkap()
	{
		return $this->table('siswa_presentase_data')->select('id')
		->where('data_pribadi', 100)->and()
		->where('data_ayah', 100)->and()
		->where('data_ibu', 100)->and()
		->where('data_wali', 100)->and()
		->where('data_kontak', 100)->and()
		->where('data_periodik', 100)->and()
		->where('data_dokumen', 100)
		->rows();
	}

	public function admin_get_data_siswa_when_load()
	{
		return $this->table('siswa_akun')
		->join('siswa_data_main')->on('siswa_akun.id', 'siswa_data_main.siswa_akun')
		->join('siswa_data_pribadi')->on('siswa_akun.id', 'siswa_data_pribadi.siswa_akun')
		->where('data_delete', 'no')
		->limit(50)
		->get_all();
	}

	public function admin_get_data_siswa_type_default_no_limit($q)
	{
		return $this->table('siswa_akun')
		->join('siswa_data_main')->on('siswa_akun.id', 'siswa_data_main.siswa_akun')
		->join('siswa_data_pribadi')->on('siswa_akun.id', 'siswa_data_pribadi.siswa_akun')
		->where('data_delete', 'no')->and()
		->like('siswa_data_main.nama', "*{$q}*")->or()
		->like('nisn', "*{$q}*")->or()
		->like('jurusan', "*{$q}*")->or()
		->like('angkatan', "*{$q}*")->or()
		->like('status', "*{$q}*")
		->get_all();
	}

	public function admin_get_data_siswa_type_default_use_limit($q, $limit)
	{
		return $this->table('siswa_akun')
		->join('siswa_data_main')->on('siswa_akun.id', 'siswa_data_main.siswa_akun')
		->join('siswa_data_pribadi')->on('siswa_akun.id', 'siswa_data_pribadi.siswa_akun')
		->where('data_delete', 'no')->and()
		->like('siswa_data_main.nama', "*{$q}*")->or()
		->like('nisn', "*{$q}*")->or()
		->like('jurusan', "*{$q}*")->or()
		->like('angkatan', "*{$q}*")->or()
		->like('status', "*{$q}*")
		->limit($limit)
		->get_all();
	}

	public function admin_get_data_siswa_with_type_no_limit($q, $type)
	{
		return $this->table('siswa_akun')
		->join('siswa_data_main')->on('siswa_akun.id', 'siswa_data_main.siswa_akun')
		->join('siswa_data_pribadi')->on('siswa_akun.id', 'siswa_data_pribadi.siswa_akun')
		->where('data_delete', 'no')->and()
		->like($type, "*{$q}*")
		->get_all();
	}

	public function admin_get_data_siswa_use_type_use_limit($q, $type, $limit)
	{
		return $this->table('siswa_akun')
		->join('siswa_data_main')->on('siswa_akun.id', 'siswa_data_main.siswa_akun')
		->join('siswa_data_pribadi')->on('siswa_akun.id', 'siswa_data_pribadi.siswa_akun')
		->where('data_delete', 'no')->and()
		->like($type, "*{$q}*")
		->limit($limit)
		->get_all();
	}

	public function admin_get_all_data_siswa()
	{
		return $this->table('siswa_akun')
		->join('siswa_data_main')->on('siswa_akun.id', 'siswa_data_main.siswa_akun')
		->join('siswa_data_pribadi')->on('siswa_akun.id', 'siswa_data_pribadi.siswa_akun')
		->where('data_delete', 'no')
		->order_by('nama')
		->get_all();
	}

	public function siswa_log_rows($id)
	{
		return $this->table('siswa_log')->select('id')->where('siswa_akun', $id)->rows();
	}

	public function get_siswa_log_id($id)
	{
		return $this->table('siswa_log')->select('id')->where('siswa_akun', $id)->get()->id;
	}

	public function siswa_log_akun_rows($id)
	{
		return $this->table('siswa_log_akun')->select('id')->where('siswa_akun', $id)->rows();
	}

	public function get_siswa_log_akun()
	{
		return $this->table('siswa_log')
		->select('siswa_akun.id, nama, type, im_admin, log, siswa_log_akun.updated_at')
		->join('siswa_data_main')->on('siswa_log.siswa_akun', 'siswa_data_main.siswa_akun')
		->join('siswa_akun')->on('siswa_akun.id', 'siswa_log.siswa_akun')
		->join('siswa_log_akun')->on('siswa_log_akun.siswa_log', 'siswa_log.id')
		->order_by('siswa_log', '<')
		->limit(200)
		->get_all();
	}

	public function get_all_log_by_akun($id)
	{
		return $this->table('siswa_log')
		->where('siswa_akun', $id)
		->order_by('id', '<')
		->get_all();
	}

	public function siswa_verifikasi_rows_by_id($id)
	{
		return $this->table('siswa_verifikasi')->select('id')->where('siswa_akun', $id)->rows();
	}

	public function get_all_data_verifikasi()
	{
		return $this->table('siswa_verifikasi')
		->select('siswa_akun.id, nama, nisn, jenis_kelamin, jurusan')
		->join('siswa_akun')->on('siswa_akun.id', 'siswa_verifikasi.siswa_akun')
		->join('siswa_data_main')->on('siswa_data_main.siswa_akun', 'siswa_akun.id')
		->join('siswa_data_pribadi')->on('siswa_data_pribadi.siswa_akun', 'siswa_akun.id')
		->where('presentase_data', 100)->and()->where('verifikasi', false)
		->order_by('jurusan, nama, jenis_kelamin')
		->get_all();
	}

	public function get_verifikasi_velue($id)
	{
		return $this->table('siswa_verifikasi')->select('verifikasi')->where('siswa_akun', $id)->get()->verifikasi;
	}

	public function data_sampah_rows()
	{
		return $this->table('siswa_akun')->select('id')->where('data_delete', 'yes')->rows();
	}

	public function antrian_verifikasi_rows()
	{
		return $this->table('siswa_verifikasi')->select('siswa_akun.id')
		->join('siswa_akun')->on('siswa_akun.id', 'siswa_verifikasi.siswa_akun')
		->where('data_delete', 'no')->and()
		->where('presentase_data', 100)->and()
		->where('verifikasi', 0)
		->rows();
	}

	public function data_terverifikasi_rows()
	{
		return $this->table('siswa_verifikasi')->select('id')->where('verifikasi', 1)->rows();
	}

	/**
	 *	+++++++++++++++++++ Insert method.
	 */

	public function insert_siswa_login($data)
	{
		$this->table('siswa_login')->insert([
			'siswa_akun'  => $data->data->id,
			'siswa_token' => $data->siswa_token,
			'ip'          => $data->ip,
			'domain'      => $data->domain,
			'browser'     => $data->browser,
			'os'          => $data->os,
			'created_at'  => $data->time,
			'updated_at'  => $data->time,
		]);
	}

	public function insert_siswa_data_main($data)
	{
		$this->table('siswa_data_main')->insert([
			'siswa_akun' => $data['id'],
			'nama'       => $data['nama'],
			'angkatan'   => $data['angkatan'],
			'status'     => $data['status'],
			'jurusan'    => $data['jurusan'],
			'foto'       => null,
			'created_at' => $this->time,
			'updated_at' => $this->time,
		]);
	}

	public function insert_siswa_akun($nisn, $password)
	{
		$id = $this->table('siswa_akun')->insert([
			'nisn'       => $nisn,
			'password'   => $password,
			'created_at' => $this->time,
			'updated_at' => $this->time,
		])->get_id();
		return $id;
	}

	public function insert_data_pribadi_null($id, $time)
	{
		$this->table('siswa_data_pribadi')->insert([
			'siswa_akun' => $id,
			'created_at' => $time,
			'updated_at' => $time,
		]);
	}

	public function insert_data_ayah_null($id, $time)
	{
		$this->table('siswa_data_ayah')->insert([
			'siswa_akun' => $id,
			'created_at' => $time,
			'updated_at' => $time,
		]);
	}

	public function insert_data_ibu_null($id, $time)
	{
		$this->table('siswa_data_ibu')->insert([
			'siswa_akun' => $id,
			'created_at' => $time,
			'updated_at' => $time,
		]);
	}

	public function insert_data_wali_null($id, $time)
	{
		$this->table('siswa_data_wali')->insert([
			'memiliki_wali' => 0,
			'siswa_akun'    => $id,
			'created_at'    => $time,
			'updated_at'    => $time,
		]);
	}

	public function insert_data_kontak_null($id, $time)
	{
		$this->table('siswa_data_kontak')->insert([
			'siswa_akun' => $id,
			'created_at' => $time,
			'updated_at' => $time,
		]);
	}

	public function insert_data_periodik_null($id, $time)
	{
		$this->table('siswa_data_periodik')->insert([
			'siswa_akun' => $id,
			'created_at' => $time,
			'updated_at' => $time,
		]);
	}

	public function insert_data_dokumen_null($id, $time)
	{
		$this->table('siswa_data_dokumen')->insert([
			'siswa_akun' => $id,
			'created_at' => $time,
			'updated_at' => $time,
		]);
	}

	public function insert_first_presentase_data($array)
	{
		$this->table('siswa_presentase_data')->insert($array);
	}

	public function insert_siswa_log($data)
	{
		return $this->table('siswa_log')->insert([
			'siswa_akun' => $data->siswa->id,
			'type'       => $data->type,
			'log'        => $data->log,
			'im_admin'   => $data->im_admin,
			'ip'         => $data->ip,
			'browser'    => $data->browser,
			'os'         => $data->os,
			'created_at' => $data->time,
		])->get_id();
	}

	public function insert_first_siswa_log_akun($data)
	{
		$this->table('siswa_log_akun')->insert([
			'siswa_akun' => $data->siswa->id,
			'siswa_log'  => $data->siswa_log,
			'created_at' => $data->time,
			'updated_at' => $data->time,
		])->get_id();
	}

	public function insert_first_siswa_verifikasi($id, $presentase_data)
	{
		$this->table('siswa_verifikasi')->insert([
			'siswa_akun'      => $id,
			'presentase_data' => $presentase_data,
			'created_at'      => $this->time,
			'updated_at'      => $this->time,
		]);
	}

	/**
	 *	+++++++++++++++++++ Update method.
	 */

	public function simpan_data_pribadi($data, $id)
	{
		$this->time_now = time_now();

		$this->table('siswa_data_main')->where('siswa_akun', $id)->update([
			'nama'       => $data['nama'],
			'updated_at' => $this->time_now,
		]);

		if(!isset($data['jenis_kelamin'])) $data['jenis_kelamin']             = null;
		if(!isset($data['agama'])) $data['agama']                             = null;
		if(!isset($data['kewarganegaraan'])) $data['kewarganegaraan']         = null;
		if(!isset($data['berkebutuhan_khusus'])) $data['berkebutuhan_khusus'] = null;
		if(!isset($data['tempat_tinggal'])) $data['tempat_tinggal']           = null;
		if(!isset($data['transportasi'])) $data['transportasi']               = null;

		$this->table('siswa_data_pribadi')->where('siswa_akun', $id)->update([
			'jenis_kelamin'       => $data['jenis_kelamin'],
			'nik'                 => $data['nik'],
			'no_kartu_keluarga'   => $data['no_kartu_keluarga'],
			'tempat_lahir'        => $data['tempat_lahir'],
			'tanggal_lahir'       => $data['tanggal_lahir'],
			'no_akta_kelahiran'   => $data['no_akta_kelahiran'],
			'anak_ke'             => $data['anak_ke'],
			'agama'               => $data['agama'],
			'kewarganegaraan'     => $data['kewarganegaraan'],
			'berkebutuhan_khusus' => $data['berkebutuhan_khusus'],
			'alamat'              => $data['alamat'],
			'rt'                  => $data['rt'],
			'rw'                  => $data['rw'],
			'dusun'               => $data['dusun'],
			'desa'                => $data['desa'],
			'kecamatan'           => $data['kecamatan'],
			'kabupaten'           => $data['kabupaten'],
			'provinsi'            => $data['provinsi'],
			'kode_pos'            => $data['kode_pos'],
			'tempat_tinggal'      => $data['tempat_tinggal'],
			'transportasi'        => $data['transportasi'],
			'updated_at'          => $this->time_now,
		]);
	}

	public function simpan_data_ayah($data, $id)
	{
		$this->time_now = time_now();

		if(!isset($data['pendidikan'])) $data['pendidikan']                   = null;
		if(!isset($data['pekerjaan'])) $data['pekerjaan']                     = null;
		if(!isset($data['penghasilan'])) $data['penghasilan']                 = null;
		if(!isset($data['berkebutuhan_khusus'])) $data['berkebutuhan_khusus'] = null;

		$this->table('siswa_data_ayah')->where('siswa_akun', $id)->update([
			'nama'                => $data['nama'],
			'nik'                 => $data['nik'],
			'tahun_lahir'         => $data['tahun_lahir'],
			'pendidikan'          => $data['pendidikan'],
			'pekerjaan'           => $data['pekerjaan'],
			'penghasilan'         => $data['penghasilan'],
			'berkebutuhan_khusus' => $data['berkebutuhan_khusus'],
			'updated_at'          => $this->time_now,
		]);
	}

	public function simpan_data_ibu($data, $id)
	{
		$this->time_now = time_now();

		if(!isset($data['pendidikan'])) $data['pendidikan']                   = null;
		if(!isset($data['pekerjaan'])) $data['pekerjaan']                     = null;
		if(!isset($data['penghasilan'])) $data['penghasilan']                 = null;
		if(!isset($data['berkebutuhan_khusus'])) $data['berkebutuhan_khusus'] = null;

		$this->table('siswa_data_ibu')->where('siswa_akun', $id)->update([
			'nama'                => $data['nama'],
			'nik'                 => $data['nik'],
			'tahun_lahir'         => $data['tahun_lahir'],
			'pendidikan'          => $data['pendidikan'],
			'pekerjaan'           => $data['pekerjaan'],
			'penghasilan'         => $data['penghasilan'],
			'berkebutuhan_khusus' => $data['berkebutuhan_khusus'],
			'updated_at'          => $this->time_now,
		]);
	}

	public function simpan_data_wali($data, $id)
	{
		$this->time_now = time_now();

		if(!isset($data['pendidikan'])) $data['pendidikan']                   = null;
		if(!isset($data['pekerjaan'])) $data['pekerjaan']                     = null;
		if(!isset($data['penghasilan'])) $data['penghasilan']                 = null;
		if(!isset($data['berkebutuhan_khusus'])) $data['berkebutuhan_khusus'] = null;

		$this->table('siswa_data_wali')->where('siswa_akun', $id)->update([
			'nama'                => $data['nama'],
			'nik'                 => $data['nik'],
			'tahun_lahir'         => $data['tahun_lahir'],
			'pendidikan'          => $data['pendidikan'],
			'pekerjaan'           => $data['pekerjaan'],
			'penghasilan'         => $data['penghasilan'],
			'berkebutuhan_khusus' => $data['berkebutuhan_khusus'],
			'memiliki_wali'       => $data['memiliki_wali'],
			'updated_at'          => $this->time_now,
		]);
	}

	public function simpan_data_kontak($data, $id)
	{
		$this->time_now = time_now();

		$this->table('siswa_data_kontak')->where('siswa_akun', $id)->update([
			'tlp'        => $data['tlp'],
			'email'      => $data['email'],
			'updated_at' => $this->time_now,
		]);
	}

	public function simpan_data_periodik($data, $id)
	{
		$this->time_now = time_now();

		$this->table('siswa_data_periodik')->where('siswa_akun', $id)->update([
			'tinggi_badan'    => $data['tinggi_badan'],
			'berat_badan'     => $data['berat_badan'],
			'lingkar_kepala'  => $data['lingkar_kepala'],
			'jarak_tinggal'   => $data['jarak_tinggal'],
			'waktu_tempuh'    => $data['waktu_tempuh'],
			'saudara_kandung' => $data['saudara_kandung'],
			'updated_at'      => $this->time_now,
		]);
	}

	public function update_document_path_by_key($key, $file_name, $siswa_id)
	{
		$this->time_now = time_now();
		$this->table('siswa_data_dokumen')->where('siswa_akun', $siswa_id)->update([
			$key         => $file_name,
			'updated_at' => $this->time_now
		]);
	}

	public function update_presentase_data($col, $value, $id)
	{
		$this->time_now = time_now();
		$this->table('siswa_presentase_data')->where('siswa_akun', $id)->update([
			$col         => $value,
			'updated_at' => $this->time_now
		]);
	}

	public function ubah_password($id, $password_baru)
	{
		$this->time_now = time_now();
		$this->table('siswa_akun')->where('id', $id)->update([
			'password'   => $password_baru,
			'updated_at' => $this->time_now
		]);
	}

	public function set_data_to_trash($id)
	{
		$this->time_now = time_now();
		$this->table('siswa_akun')->where('id', $id)->update([
			'data_delete' => 'yes',
			'updated_at'  => $this->time_now
		]);
	}

	public function restore_data_siswa($id)
	{
		$this->time_now = time_now();
		$this->table('siswa_akun')->where('id', $id)->update([
			'data_delete' => 'no',
			'updated_at'  => $this->time_now
		]);
	}

	public function update_siswa_log_akun($data)
	{
		$this->table('siswa_log_akun')->where('siswa_akun', $data->siswa->id)->update([
			'siswa_log'  => $data->siswa_log,
			'updated_at' => $data->time
		]);
	}

	public function update_presentase_data_in_verifikasi($id, $total, $verifikasi)
	{
		$this->table('siswa_verifikasi')->where('siswa_akun', $id)->update([
			'presentase_data' => $total,
			'verifikasi'      => $verifikasi,
			'updated_at'      => $this->time,
		]);
	}

	public function verifikasi_data_siswa($id)
	{
		$this->table('siswa_verifikasi')->where('siswa_akun', $id)->update([
			'verifikasi' => true,
			'updated_at' => $this->time
		]);
	}

	/**
	 *	+++++++++++++++++++ Delete method.
	 */

	public function delete_data_siswa_permanent($id)
	{
		$this->table('siswa_akun')->where('id', $id)->delete();
	}

	public function delete_all_data_siswa()
	{
		$this->table('siswa_akun')->where('data_delete', '!=', 'no')->delete();
	}

	public function delete_siswa_log_by_id($id)
	{
		$this->table('siswa_log')->where('siswa_akun', $id)->delete();
	}

	public function delete_siswa_log_akun_by_id($id)
	{
		$this->table('siswa_log_akun')->where('siswa_akun', $id)->delete();
	}

}