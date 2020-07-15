<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	@view('admin.themes.meta')
	<title>Kotak Sampah - Admin Panel</title>
	@view('admin.themes.link')
</head>

<body class="materialdesign">

	<div class="wrapper-pro">
		
		@view('admin.themes.sidebar')

		<div class="content-inner-all">
			
			@view('admin.themes.header')

			@view('admin.themes.breadcome')

			@if(is_null(_get('kelola_akun')))
			
			<div class="user-profile-area mg-b-30">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="user-profile-wrap shadow-reset">
								<h2 class="text-center">Data Sampah</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt magni velit, repudiandae odit soluta unde, deleniti minus illum! Beatae hic at rem, debitis numquam ex nisi maxime quas excepturi facilis.</p>
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>NISN</th>
											<th>Nama</th>
											<th>Jenis Kelamin</th>
											<th>Jurusan</th>
											<th>Angkatan</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@if($this->data == [])
										<tr>
											<td colspan="8" class="text-center">Tidak ada sampah.</td>
										</tr>
										@endif
										@foreach($this->data as $key => $data)
										<tr data-id="{{ $data->id }}">
											<td>{{ $key + 1 }}</td>
											<td>{{ $data->nisn }}</td>
											<td>{{ $data->nama }}</td>
											<td>{{ $data->jenis_kelamin }}</td>
											<td>{{ $data->jurusan }}</td>
											<td>{{ $data->angkatan }}</td>
											<td>{{ $data->status }}</td>
											<td class="text-center btn-action">
												<button class="btn btn-xs btn-primary" onclick="dataRestore(this)">Restore</button>
												<button class="btn btn-xs btn-danger" onclick="deletePermanent(this)">Hapus Permanen</button>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								<div class="w-100 text-right">
									<button class="btn btn-danger" btn-on-click="Menghapus..." btn-href="@baseurl/admin-api/siswa/sampah/delete-all">Bersihkan Semua Sampah</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			@endif

			@if(!is_null(_get('kelola_akun')))

			<div class="container-fluid mg-b-30" id="kelola-akun">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="user-profile-wrap shadow-reset">
							<h2 class="text-center">Kelola Akun</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo architecto eos illo vel culpa earum obcaecati, hic et cupiditate consectetur, numquam excepturi! Tempore sint adipisci architecto quisquam nobis nisi totam.</p>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-sm-offset-3">
									<div class="basic-login-inner">
										<form action="@url" method="post">
											<div class="form-group-inner">
												<label>Nama</label>
												<input required name="nama" value="{{ $this->admin->nama }}" type="text" class="form-control" placeholder="Enter Email">
											</div>
											<div class="form-group-inner">
												<label>Username</label>
												<input required name="username" value="{{ $this->admin->username }}" type="text" class="form-control" placeholder="Enter Email">
											</div>
											<div class="form-group-inner">
												<label>E-Mail</label>
												<input required name="email" value="{{ $this->admin->email }}" type="email" class="form-control" placeholder="Enter Email">
											</div>
											<div class="form-group-inner">
												<label>Akses Sebagai</label>
												<select class="form-control custom-select-value" required name="akses">
													<option value="admin">Admin</option>
												</select>
											</div>
											<div class="form-group-inner">
												<label>Password</label>
												<input required name="password" value="{{ $this->admin->password }}" type="text" class="form-control" placeholder="password">
											</div>
											<div class="login-btn-inner">
												<div class="inline-remember-me">
													<input type="hidden" name="id" value="{{ $this->admin->id }}">
													<button name="simpan_data_akun" value="{{ md5(uniqid()) }}" class="btn btn-sm btn-primary pull-right login-submit-cs" type="submit">Simpan</button>
												</div>
											</div>
										</form>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			@endif


		</div>
	</div>

	@view('admin.themes.footer')

	@view('admin.themes.script')
</body>

</html>