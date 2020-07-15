<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	@view('admin.themes.meta')
	<title>Dashboard - Admin Panel</title>
	@view('admin.themes.link')
</head>

<body class="materialdesign">

	<div class="wrapper-pro">
		
		@view('admin.themes.sidebar')

		<div class="content-inner-all">
			
			@view('admin.themes.header')

			@view('admin.themes.breadcome')

			<div class="income-order-visit-user-area">
				<div class="container-fluid">
					<div class="row">

						<div class="col-lg-4">
							<div class="income-dashone-total shadow-reset nt-mg-b-30">
								<div class="income-title">
									<div class="main-income-head">
										<h2>Data Siswa</h2>
										<div class="main-income-phara">
											<p>Total Data</p>
										</div>
									</div>
								</div>
								<div class="income-dashone-pro">
									<div class="income-rate-total">
										<div class="price-adminpro-rate">
											<h3>
												<a href="@baseurl/admin/siswa/data?query_data=all">
													<span class="counter">{{ $this->total_data_siswa }}</span>
												</a>
											</h3>
										</div>
										<div class="price-graph">
											<span id="sparkline1"></span>
										</div>
									</div>
									<div class="income-range">
										<p>Jumlah seluruh data siswa.</p>
										<!-- <span class="income-percentange">98% <i class="fa fa-bolt"></i></span> -->
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="income-dashone-total shadow-reset nt-mg-b-30">
								<div class="income-title">
									<div class="main-income-head">
										<h2>Sudah Lengkap</h2>
										<div class="main-income-phara visitor-cl">
											<p>{{ $this->presentase_sudah_lengkap }}%</p>
										</div>
									</div>
								</div>
								<div class="income-dashone-pro">
									<div class="income-rate-total">
										<div class="price-adminpro-rate">
											<h3>
												<a href="@baseurl/admin/siswa/data?query_data=complete">
													<span class="counter">{{ $this->total_data_siswa_sudah_lengkap }}</span>
												</a>
											</h3>
										</div>
										<div class="price-graph">
											<span id="sparkline6"></span>
										</div>
									</div>
									<div class="income-range order-cl">
										<p>Jumlah siswa yang telah melengkapi data</p>
										<!-- <span class="income-percentange">66% <i class="fa fa-level-up"></i></span> -->
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="income-dashone-total shadow-reset nt-mg-b-30">
								<div class="income-title">
									<div class="main-income-head">
										<h2>Belum Lengkap</h2>
										<div class="main-income-phara low-value-cl">
											<p>{{ $this->presentase_belum_lengkap }}%</p>
										</div>
									</div>
								</div>
								<div class="income-dashone-pro">
									<div class="income-rate-total">
										<div class="price-adminpro-rate">
											<h3>
												<a href="@baseurl/admin/siswa/data?query_data=!complete">
													<span class="counter">{{ $this->total_data_siswa_belum_lengkap }}</span>
												</a>
											</h3>
										</div>
										<div class="price-graph">
											<span id="sparkline2"></span>
										</div>
									</div>
									<div class="income-range visitor-cl">
										<p>Jumlah siswa yang belum melengkapi data.</p>
										<!-- <span class="income-percentange">55% <i class="fa fa-level-up"></i></span> -->
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="income-dashone-total shadow-reset nt-mg-b-30">
								<div class="income-title">
									<div class="main-income-head">
										<h2>Data Sampah</h2>
										<!-- <div class="main-income-phara low-value-cl">
											<p>Kotak Sampah</p>
										</div> -->
									</div>
								</div>
								<div class="income-dashone-pro">
									<div class="income-rate-total">
										<div class="price-adminpro-rate">
											<h3>
												<a href="@baseurl/admin/siswa/sampah">
													<span class="counter">{{ $this->data_sampah_rows }}</span>
												</a>
											</h3>
										</div>
										<div class="price-graph">
											<span id="sparkline1"></span>
										</div>
									</div>
									<div class="income-range">
										<p>Jumlah seluruh data siswa di dalam kotak sampah.</p>
										<!-- <span class="income-percentange">98% <i class="fa fa-bolt"></i></span> -->
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="income-dashone-total shadow-reset nt-mg-b-30">
								<div class="income-title">
									<div class="main-income-head">
										<h2>Antrian Verifikasi</h2>
										<!-- <div class="main-income-phara low-value-cl">
											<p>Kotak Sampah</p>
										</div> -->
									</div>
								</div>
								<div class="income-dashone-pro">
									<div class="income-rate-total">
										<div class="price-adminpro-rate">
											<h3>
												<a href="@baseurl/admin/siswa/verifikasi">
													<span class="counter">{{ $this->antrian_verifikasi_rows }}</span>
												</a>
											</h3>
										</div>
										<div class="price-graph">
											<span id="sparkline1"></span>
										</div>
									</div>
									<div class="income-range">
										<p>Jumlah seluruh data siswa di dalam kotak sampah.</p>
										<!-- <span class="income-percentange">98% <i class="fa fa-bolt"></i></span> -->
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="income-dashone-total shadow-reset nt-mg-b-30">
								<div class="income-title">
									<div class="main-income-head">
										<h2>Data Terverifikasi</h2>
										<!-- <div class="main-income-phara low-value-cl">
											<p>Kotak Sampah</p>
										</div> -->
									</div>
								</div>
								<div class="income-dashone-pro">
									<div class="income-rate-total">
										<div class="price-adminpro-rate">
											<h3>
												<a href="@baseurl/admin/siswa/data?query_data=verifikasi">
													<span class="counter">{{ $this->data_terverifikasi_rows }}</span>
												</a>
											</h3>
										</div>
										<div class="price-graph">
											<span id="sparkline1"></span>
										</div>
									</div>
									<div class="income-range">
										<p>Jumlah seluruh data siswa di dalam kotak sampah.</p>
										<!-- <span class="income-percentange">98% <i class="fa fa-bolt"></i></span> -->
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