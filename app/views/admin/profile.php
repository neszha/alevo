<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	@view('admin.themes.meta')
	<title>Profile - Admin Panel</title>
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
								<div class="row">

									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-3">
												<div class="user-profile-img">
													<img src="@assets/admin/img/no-image.png" alt="">
												</div>
											</div>
											<div class="col-lg-9">
												<div class="user-profile-content">
													<h2>{{ $this->admin->nama }}</h2>
													<p class="profile-founder">Terdaftar pada <strong>{{ $this->created_at->d }} {{ $this->created_at->m }} {{ $this->created_at->y }}</strong>
													</p>
													<p class="profile-des">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero vitae dolorem accusamus id numquam quasi nobis deserunt minus consectetur dolores.</p>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-3">
										<div class="contact-client-address">
											<h3>Akun Saya</h3>
											<p class="address-client-ct">
												<strong>Usernamse: </strong>
												<span>{{ $this->admin->username }}</span>
											</p>
											<p class="address-client-ct">
												<strong>E-Mail: </strong>
												<span>{{ $this->admin->email }}</span>
											</p>
											<p class="address-client-ct">
												<strong>Akses: </strong>
												<button class="btn btn-xs btn-danger">{{ $this->admin->akses }}</button>
											</p>
										</div>
									</div>

									<div class="col-lg-3">
										<div class="contact-client-address">
											<h3>Kelola Akun Saya</h3>
											<p class="address-client-ct">
												<span>Terakhir di ubah pada </span>
												<strong>{{ $this->updated_at->d }} {{ $this->updated_at->m }} {{ $this->updated_at->y }}</strong>
											</p>
											<div class="w-100 text-center">
												<button btn-href="@url?kelola_akun={{ uniqid() }}" class="btn btn-primary btn-block" btn-on-click="Loading...">Kelola Akun</button>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="user-profile-area mg-b-30">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="user-profile-wrap shadow-reset">
								<h2 class="text-center">Riwayat Login</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt magni velit, repudiandae odit soluta unde, deleniti minus illum! Beatae hic at rem, debitis numquam ex nisi maxime quas excepturi facilis.</p>
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Domain</th>
											<th>IP Address</th>
											<th>Browser</th>
											<th>Sistem Operasi</th>
											<th>Mengakses Pada</th>
											<th>Akses Terakhir</th>
										</tr>
									</thead>
									<tbody>
										{{{ $num_rl = count($this->riwayat_login) }}}
										@foreach($this->riwayat_login as $data)
										<tr>
											<td>{{ $num_rl }}</td>
											<td>{{ $data->domain }}</td>
											<td>{{ $data->ip }}</td>
											<td>{{ $data->browser }}</td>
											<td>{{ $data->os }}</td>
											<td>{{ $data->created_at }}</td>
											<td>{{ $data->updated_at }}</td>
										</tr>
										{{{ $num_rl-- }}}
										@endforeach
									</tbody>
								</table>
								<div class="w-100 text-right">
									<button class="btn btn-danger" btn-on-click="Menghapus..." btn-href="@url?hapus_riwayat_login={{ md5(uniqid()) }}">Bersihkan Riwayat</button>
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