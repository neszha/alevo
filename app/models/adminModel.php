<?php 
/**
 * @Model       : adminModel made by .ALEVO.
 * @Date        : 2020-04-16 02:12:20
 * @Message     : Don't be lazy typing
 */

class adminModel extends DB
{

	public function __construct()
	{
		// your_code
	}

	/**
	 *	+++++++++++++++++++ Get result method.
	 */

	public function get_password_by_id($id)
	{
		$this->data = $this->table('admin_akun')->select('password')->where('id', $id)->get();
		return $this->data->password;
	}

	public function username_rows($username)
	{
		return $this->table('admin_akun')->select('id')->where('username', $username)->rows();
	}

	public function email_rows($email)
	{
		return $this->table('admin_akun')->select('id')->where('email', $email)->rows();
	}

	public function get_data_akun_by_username($username)
	{
		return $this->table('admin_akun')->select('id, username, password, email, akses')->where('username', $username)->get();
	}

	public function get_data_akun_by_email($email)
	{
		return $this->table('admin_akun')->select('id, username, password, email, akses')->where('email', $email)->get();
	}

	public function admin_token_rows($token)
	{
		return $this->table('admin_login')->select('id')->where('admin_token', $token)->rows();
	}

	public function get_data_admin_by_token($token)
	{
		return $this->query("SELECT admin_akun.id, username, nama, email, foto, akses, admin_akun.created_at, admin_akun.updated_at FROM admin_login INNER JOIN admin_akun ON admin_login.admin_akun = admin_akun.id INNER JOIN admin_profile ON admin_profile.admin_akun = admin_akun.id WHERE admin_login.admin_token = '$token'")->get();
	}

	public function get_all_admin_login_by_id($id)
	{
		return $this->table('admin_login')->where('admin_akun', $id)->order_by('updated_at', '<')->get_all();
	}

	public function get_data_portal()
	{
		return $this->table('portal')->get_all();
	}

	/**
	 *	+++++++++++++++++++ Insert method.
	 */

	public function insert_admin_login($data)
	{
		$this->table('admin_login')->insert([
			'admin_akun'  => $data->data->id,
			'admin_token' => $data->admin_token,
			'ip'          => $data->ip,
			'domain'      => $data->domain,
			'browser'     => $data->browser,
			'os'          => $data->os,
			'created_at'  => $data->time,
			'updated_at'  => $data->time,
		]);
	}

	// public function insert_profile()
	// {
	// 	$admin_akun = 1;
	// 	$nama = 'Fanesa Hadi Pramana';
	// 	$file = 'ini.txt';

	// 	$this->table('admin_profile')->insert([
	// 		'admin_akun' => $admin_akun,
	// 		'nama' => $nama,
	// 		'foto' => $file,
	// 	]);
	// }


	/**
	 *	+++++++++++++++++++ Update method.
	 */

	public function update_admin_login()
	{
		$admin_token = _session('admin-token');
		$time        = time_now();
		$this->table('admin_login')->where('admin_token', $admin_token)->update([
			'updated_at' => $time,
		]);
	}

	public function update_admin_akun($data)
	{
		$this->table('admin_akun')->where('id', $data->id)->update([
			'username'   => $data->username,
			'password'   => $data->password,
			'email'      => $data->email,
			'akses'      => $data->akses,
			'updated_at' => $data->time,
		]);
	}

	public function update_admin_profile($data)
	{
		$this->table('admin_profile')->where('admin_akun', $data->id)->update([
			'nama'       => $data->nama,
		]);
	}

	public function update_data_portal($data)
	{
		$this->table('portal')->where('id', $data->id)->update([
			'status'     => $data->status,
			'updated_at' => $data->time,
		]);
	}


	/**
	 *	+++++++++++++++++++ Delete method.
	 */

	public function hapus_riwayat_login_by_id($id)
	{
		$this->table('admin_login')->where('admin_akun', $id)->delete();
	}

	public function other_delete_method()
	{
		// your_code
	}

}