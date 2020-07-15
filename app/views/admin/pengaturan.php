<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	@view('admin.themes.meta')
	<title>Pengaturan - Admin Panel</title>
	@view('admin.themes.link')
</head>

<body class="materialdesign" id="pengaturan">

	<div class="wrapper-pro">
		
		@view('admin.themes.sidebar')

		<div class="content-inner-all">
			
			@view('admin.themes.header')

			@view('admin.themes.breadcome')

			<div class="footer-copyright-area mg-b-30">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="footer-copy-right">
								<h2>Pengaturan Portal</h2>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="income-order-visit-user-area">
				<div class="container-fluid">
					<div class="row">

						<div class="col-lg-4">
							<div class="income-dashone-total shadow-reset nt-mg-b-30">
								<div class="income-title">
									<div class="main-income-head">
										<h2>Cari Siswa (Home)</h2>
										@if($this->portal->cari_siswa->status)
										<div class="main-income-phara visitor-cl">
											<p>Terbuka</p>
										</div>
										@else
										<div class="main-income-phara low-value-cl">
											<p>Tertutup</p>
										</div>
										@endif
									</div>
								</div>
								<div class="income-dashone-pro text-center">
									<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, debitis.</p>
									<div class="income-rate-total">
										@if($this->portal->cari_siswa->status)
										<div class="price-adminpro-rate">
											<button class="btn btn-danger" btn-on-click="Loading..." btn-href="@baseurl/admin/pengaturan?id={{ $this->portal->cari_siswa->id }}&status=false">Tutup Portal</button>
										</div>
										@else
										<div class="price-adminpro-rate">
											<button class="btn btn-success" btn-on-click="Loading..." btn-href="@baseurl/admin/pengaturan?id={{ $this->portal->cari_siswa->id }}&status=true">Buka Portal</button>
										</div>
										@endif
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="income-dashone-total shadow-reset nt-mg-b-30">
								<div class="income-title">
									<div class="main-income-head">
										<h2>Login Siswa</h2>
										@if($this->portal->login_siswa->status)
										<div class="main-income-phara visitor-cl">
											<p>Terbuka</p>
										</div>
										@else
										<div class="main-income-phara low-value-cl">
											<p>Tertutup</p>
										</div>
										@endif
									</div>
								</div>
								<div class="income-dashone-pro text-center">
									<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, debitis.</p>
									<div class="income-rate-total">
										<div class="price-adminpro-rate">
											@if($this->portal->login_siswa->status)
											<div class="price-adminpro-rate">
												<button class="btn btn-danger" btn-on-click="Loading..." btn-href="@baseurl/admin/pengaturan?id={{ $this->portal->login_siswa->id }}&status=false">Tutup Portal</button>
											</div>
											@else
											<div class="price-adminpro-rate">
												<button class="btn btn-success" btn-on-click="Loading..." btn-href="@baseurl/admin/pengaturan?id={{ $this->portal->login_siswa->id }}&status=true">Buka Portal</button>
											</div>
											@endif
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="income-dashone-total shadow-reset nt-mg-b-30">
								<div class="income-title">
									<div class="main-income-head">
										<h2>Edit Data Siswa</h2>
										@if($this->portal->edit_data_siswa->status)
										<div class="main-income-phara visitor-cl">
											<p>Terbuka</p>
										</div>
										@else
										<div class="main-income-phara low-value-cl">
											<p>Tertutup</p>
										</div>
										@endif
									</div>
								</div>
								<div class="income-dashone-pro text-center">
									<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, debitis.</p>
									<div class="income-rate-total">
										<div class="price-adminpro-rate">
											@if($this->portal->edit_data_siswa->status)
											<div class="price-adminpro-rate">
												<button class="btn btn-danger" btn-on-click="Loading..." btn-href="@baseurl/admin/pengaturan?id={{ $this->portal->edit_data_siswa->id }}&status=false">Tutup Portal</button>
											</div>
											@else
											<div class="price-adminpro-rate">
												<button class="btn btn-success" btn-on-click="Loading..." btn-href="@baseurl/admin/pengaturan?id={{ $this->portal->edit_data_siswa->id }}&status=true">Buka Portal</button>
											</div>
											@endif
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>


		</div>
	</div>

	@view('admin.themes.footer')

	@view('admin.themes.script')
</body>

</html>