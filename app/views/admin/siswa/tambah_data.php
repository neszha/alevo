<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	@view('admin.themes.meta')
	<title>Tambah Data Siswa - Admin Panel</title>
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
							Contoh template untuk upload data siswa bisa di download <a href="@assets/admin/template/template-tambah-data-siswa.xlsx">di sini.</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="transition-world-area mg-t-30">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="transition-world-list shadow-reset">
								<div class="sparkline7-hd">
									<div class="main-spark7-hd">
										<h1>Tambah Data Siswa</h1>
										<div class="sparkline7-outline-icon">
											<span class="sparkline7-collapse-link"><i class="fa fa-chevron-up"></i></span>
										</div>
									</div>
								</div>
								<div class="sparkline7-graph">

									<div class="select-file">
										<p>Upload form untuk melakukan input data siswa <i>(sederhana)</i>.</p>

										<button type="button" class="btn btn-primary for-input-data-siswa">Upload Form</button>
										<input type="file" id="data-siswa-sederhana" style="display: none;">

									</div>

									<div class="table-upload" style="display: none">
										
										<div class="welcome-adminpro-title">
											<h1>Tambah Data Siswa</h1>
											<p>Ditemukan <b id="f-001"></b> data yang akan ditambahkan.</p>
										</div>

										<div class="static-table-list">
											<table class="table">
												<thead>
													<tr>
														<th>#</th>
														<th>NISN</th>
														<th>Nama</th>
														<th>Angkatan</th>
														<th>Status Siswa</th>
														<th>Jurusan</th>
														<th></th>
													</tr>
												</thead>
												<tbody id="p-001">
													
												</tbody>
											</table>

											<template id="t-001">
												<tr data-id="@id" data-insert>
													<td>@no</td>
													<td class="nisn">@nisn</td>
													<td class="nama">@nama</td>
													<td class="angkatan">@angkatan</td>
													<td class="status">@status</td>
													<td class="jurusan">@jurusan</td>
													<td class="check" data-action="insert">
														<button class="btn btn-xs">
															Chacking...
														</button>
													</td>
												</tr>
											</template>

											<template id="t-002">
												<button class="btn btn-primary btn-xs">
													<span class="adminpro-icon adminpro-checked-pro"></span> Ready
												</button>
											</template>

											<template id="t-003">
												<button class="btn btn-warning btn-xs">
													<span class="adminpro-icon adminpro-warning-danger"></span> Sudah ada
												</button>
											</template>

											<template id="t-004">
												<button class="btn btn-success btn-xs">
													Success
												</button>
											</template>

											<div class="btn-wrapper text-center">
												<button class="btn btn-primary btn-m btn-custon-four" style="min-width: 200px" id="b-001">INPUT DATA</button>
											</div>

											<div class="btn-wrapper text-center" style="display: none;">
												<button class="btn btn-danger btn-m btn-custon-four" style="min-width: 200px;" id="b-002">Kembali</button>
											</div>


										</div>

									</div>

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
	<script src="{{ $this->res('admin/js/data-siswa.js') }}"></script>
</body>

</html>