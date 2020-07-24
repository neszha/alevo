<?php 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
| aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
| cupidatat non proident, sunt in culpa qui officia deserunt.
|
*/

Route::get('/coba/{id}', function()
{
	echo '<hr>';
	var_dump(_get());
	var_dump(_data());
	return 'hello world!';
});


Route::get('/', 'indexController@index');

Route::group('/siswa', function()
{
	Route::redirect('/', '/login');

	Route::match(['get', 'post'], '/login', 'indexController@login_siswa_view');
	Route::get('/dashboard', 'siswa_viewController@dashboard');
	Route::get('/pengaturan', 'siswa_viewController@pengaturan');
	
	Route::group('/data', function()
	{
		Route::get('/pribadi', 'siswa_viewController@data_pribadi');
		Route::get('/pribadi/edit', 'siswa_viewController@edit_pribadi');

		Route::get('/ayah', 'siswa_viewController@data_ayah');
		Route::get('/ayah/edit', 'siswa_viewController@edit_ayah');
		
		Route::get('/ibu', 'siswa_viewController@data_ibu');
		Route::get('/ibu/edit', 'siswa_viewController@edit_ibu');
		
		Route::get('/wali', 'siswa_viewController@data_wali');
		Route::get('/wali/edit', 'siswa_viewController@edit_wali');
		
		Route::get('/kontak', 'siswa_viewController@data_kontak');
		Route::get('/kontak/edit', 'siswa_viewController@edit_kontak');
		
		Route::get('/periodik', 'siswa_viewController@data_periodik');
		Route::get('/periodik/edit', 'siswa_viewController@edit_periodik');
		
		Route::get('/dokumen', 'siswa_viewController@data_dokumen');
		Route::get('/dokumen/edit', 'siswa_viewController@edit_dokumen');
	});

	Route::get('/logout', 'siswa_authController@logout');
	
});

Route::group('/siswa-api', function()
{

	Route::group('/data', function()
	{
		Route::post('/pribadi/simpan', 'siswa_apiController@perbarui_data_pribadi');
		Route::post('/ayah/simpan', 'siswa_apiController@perbarui_data_ayah');
		Route::post('/ibu/simpan', 'siswa_apiController@perbarui_data_ibu');
		Route::post('/wali/simpan', 'siswa_apiController@perbarui_data_wali');
		Route::post('/kontak/simpan', 'siswa_apiController@perbarui_data_kontak');
		Route::post('/periodik/simpan', 'siswa_apiController@perbarui_data_periodik');
		Route::post('/dokumen/simpan', 'siswa_apiController@perbarui_data_dokumen');

	});

	Route::group('/pengaturan', function()
	{
		Route::post('/password/ubah', 'siswa_apiController@perbarui_password');
	});

});

Route::match(['get', 'post'], $_ENV['app']['LOGIN_ADMIN'], 'indexController@login_admin_view');

Route::group('/admin', function()
{

	Route::get('/', 'admin_viewController@redirect_to_dashboard');

	Route::get('/dashboard', 'admin_viewController@dashboard');

	Route::get('/pengaturan', 'admin_viewController@pengaturan');

	Route::group('/siswa', function()
	{
		Route::get('/tambah-data', 'admin_viewController@tambah_data_siswa');
		Route::get('/verifikasi', 'admin_viewController@verifikasi_data_siswa');
		Route::get('/data', 'admin_viewController@list_data_siswa');
		Route::get('/sampah', 'admin_viewController@sampah');

		Route::group('/aktifitas', function()
		{
			Route::get('/', 'admin_viewController@aktifitas');
			Route::get('/detail/{id}', 'admin_viewController@aktifitas_detail');
			Route::get('/detail/{id}/clean', 'siswa_logController@siswa_log_clean');
		});

		Route::get('/{id}/set-admin-access', 'admin_siswaController@set_admin_access');
	});

	Route::match(['get', 'post'], '/profile', 'admin_viewController@profile');

	Route::get('/logout', 'admin_authController@logout');

});


Route::group('/admin-api', function()
{
	Route::group('/siswa', function()
	{

		Route::group('/verifikasi', function()
		{
			Route::post('/get-data', 'admin_siswaController@get_data_verifikasi');
			Route::post('/{id}', 'admin_siswaController@verifikasi_data');
		});

		Route::post('/check-before-input', 'admin_siswaController@check_before_input');
		Route::post('/main-insert', 'admin_siswaController@main_insert');
		Route::post('/get-data', 'admin_siswaController@get_data_siswa');
		Route::post('/{id}/delete', 'admin_siswaController@delete_data_siswa');
		Route::post('/{id}/delete-permanent', 'admin_siswaController@delete_data_siswa_permanent');
		Route::post('/{id}/data-restore', 'admin_siswaController@restore_data_siswa');
		Route::get('/sampah/delete-all', 'admin_siswaController@delete_all_data_siswa');
	});
});