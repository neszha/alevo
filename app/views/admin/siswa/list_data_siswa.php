<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	@view('admin.themes.meta')
	<title>Data Siswa - Admin Panel</title>
	@view('admin.themes.link')
</head>

<body class="materialdesign">

	<div class="wrapper-pro">
		
		@view('admin.themes.sidebar')

		<div class="content-inner-all">
			
			@view('admin.themes.header')

			@view('admin.themes.breadcome')

			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="user-profile-wrap shadow-reset">
							<form action="" id="search-data">
								<label for="">Search:</label>
								<div class="input-group custom-go-button mg-b-10">
									<input id="sq" name="search_query" type="text" class="form-control" placeholder="Cari data siswa di sini" autocomplete="off">
									<span class="input-group-btn">
										<button type="submit" class="btn btn-primary" id="main-search">Search</button>
									</span>
								</div>
								<div class="row">
									<div class="col-sm-12 text-center">
										<button class="btn" id="use-filter" data-target="#search-filter">Gunakan Filter</button>
									</div>
								</div>
								<div class="row mg-t-30" id="search-filter" style="display: none;">
									<div class="col-sm-3">
										<div class="contact-client-address set-filter">
											<input id="type" type="hidden" name="jenis" value="default">
											<h3>Jenis Pencarian</h3>
											<p class="address-client-ct active" data-value="default">
												<strong>Default</strong>
											</p>
											<p class="address-client-ct" data-value="nama">
												<strong>Nama</strong>
											</p>
											<p class="address-client-ct" data-value="nisn">
												<strong>NISN</strong>
											</p>
											<p class="address-client-ct" data-value="jurusan">
												<strong>Jurusan</strong>
											</p>
											<p class="address-client-ct" data-value="status">
												<strong>Status</strong>
											</p>
											<p class="address-client-ct" data-value="angkatan">
												<strong>Angkatan</strong>
											</p>
										</div>
									</div>

									<div class="col-sm-3">
										<div class="contact-client-address set-filter">
											<input id="limit" type="hidden" name="limit" value="default">
											<h3>Limit Data</h3>
											<p class="address-client-ct active" data-value="default">
												<strong>Default</strong>
											</p>
											<p class="address-client-ct" data-value="200">
												<strong>200</strong>
											</p>
											<p class="address-client-ct" data-value="400">
												<strong>400</strong>
											</p>
											<p class="address-client-ct" data-value="1000">
												<strong>1000</strong>
											</p>
											<p class="address-client-ct" data-value="false">
												<strong>Tanpa Batas</strong>
											</p>
										</div>
									</div>

									<div class="col-sm-3">
										<div class="contact-client-address set-filter data-preview">
											<input id="preview" type="hidden" name="preview" value="default">
											<h3>Preview Data</h3>
											<p class="address-client-ct active" data-value="default">
												<strong>Default</strong>
											</p>
											<p class="address-client-ct" data-value="sederhana">
												<strong>Sederhana</strong>
											</p>
											<p class="address-client-ct" data-value="sedang">
												<strong>Sedang</strong>
											</p>
											<p class="address-client-ct" data-value="lengkap">
												<strong>Lengkap</strong>
											</p>
										</div>
									</div>
									
									<div class="col-sm-3">
										<div class="contact-client-address">
											<h3>Lainnya</h3>
											<p class="address-client-ct active">
												<button type="button" class="btn" id="get-all-data-siswa">Tampilkan Semua Data</button>
											</p>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Static Table Start -->
			<div class="data-table-area mg-b-15 mg-t-30" id="result">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="sparkline13-list shadow-reset">
								<div class="sparkline13-hd">
									<div class="main-sparkline13-hd">
										<h1>Data Siswa</h1>
										<div class="sparkline13-outline-icon">
											<span class="sparkline13-collapse-link"><i class="fa fa-chevron-up"></i></span>
										</div>
									</div>
								</div>
								<div class="sparkline13-graph" id="data-table-place">
									<!-- From #t_2 -->
								</div>

								<template id="t_1">
									<button data-id="__id__" class="btn btn-xs btn-primary" get-siswa-access>Open</button>
									<button data-id="__id__" class="btn btn-xs btn-danger" delete-data-siswa>Delete</button>
								</template>

								<template id="t_2">
									<div id="toolbar">
										<select class="form-control">
											<option value="">Export Basic</option>
											<option value="all">Export All</option>
											<option value="selected">Export Selected</option>
										</select>
									</div>

									<table id="data-siswa" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="false" data-toolbar="#toolbar">
										<tr>
											<label class="table-loading mg-t-30">Loading data...</label>
										</tr>
									</table>
								</template>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Static Table End -->

		</div>
	</div>

	@view('admin.themes.footer')

	@view('admin.themes.script')
	<script src="{{ $this->res('admin/js/data-siswa.js') }}"></script>

	<script>
		$(document).ready(function()
		{
			getDataSiswa();
		});
	</script>

</body>

</html>