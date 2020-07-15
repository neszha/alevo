<!DOCTYPE html>
<html lang="en">
<head>
	@view('admin.themes.meta')
	<title>Verifikasi Data Siswa - Admin Panel</title>
	@view('admin.themes.link')
</head>

<body class="materialdesign">

	<div class="wrapper-pro">
		
		@view('admin.themes.sidebar')

		<div class="content-inner-all">
			
			@view('admin.themes.header')

			@view('admin.themes.breadcome')

			<div class="user-profile-area mg-b-30">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="user-profile-wrap shadow-reset">
								<h2 class="text-center">Verifikasi Data Siswa</h2>
								<p>Data siswa dengan presentase kelengkapan data <b>100%</b> akan masuk ke dalam daftar proses verifikasi data. Klik tombol <b><i>Open Dashboard</i></b> untuk mengecek data siswa di halaman dashboard siswa atau tombol <b><i>Verifikasi</i></b> untuk mempermanenkan data.</p>
								<table class="table" id="p-1">
									<thead>
										<tr>
											<th>NISN</th>
											<th>Nama</th>
											<th>Jenis Kelamin</th>
											<th>Jurusan</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td colspan="5" class="text-center"><i>Mengambil data....</i></td>
										</tr>
									</tbody>
								</table>
								<template id="t-1">
									<tr>
										<td>#nisn</td>
										<td>#nama</td>
										<td>#jk</td>
										<td>#jurusan</td>
										<td class="text-center btn-action">
											<button data-id="#id" class="btn btn-xs btn" get-siswa-access>Open Dashboard</button>
											<button data-id="#id" class="btn btn-xs btn-primary" verifikasi-data-siswa>Verifikasi</button>
										</td>
									</tr>
								</template>
								<template id="t-2">
									<tr>
										<td colspan="5" class="text-center"><i>Tidak ada data.</i></td>
									</tr>
								</template>
								<div class="w-100 text-right">
									<button class="btn btn-primary btn-for-all" style="display: none;">Verifikasi Semua</button>
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
	<script>
		$(document).ready(function(){getDataSiswaVerifikasi()});
	</script>
</body>
</html>