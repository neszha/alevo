<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	@view('admin.themes.meta')
	<title>Aktivitas Siswa - Admin Panel</title>
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
								<h2 class="text-center">Aktifitas Siswa</h2>
								<p>Menampilkan aktifitas terakhir siswa. Klik tombol <b>Detail Aktifitas</b> untuk melihat seluruh aktifitas berdasarkan siswa yang dipilih.</p>
								<table class="table">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Nama</th>
											<th>Aktifitas Terakhir</th>
											<th>Total Aktifitas</th>
											<th>Waktu</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@if($this->data == [])
										<tr>
											<td colspan="6" class="text-center">Tidak ada aktifitas.</td>
										</tr>
										@endif
										@foreach($this->data as $key => $data)
										<tr data-id="{{ $data->id }}">
											<td>{{ $key + 1 }}</td>
											<td>{{ $data->nama }}</td>
											<td>{{ $data->log }} {{{ if($data->im_admin == 1) echo '<a class="btn btn-xs btn-danger">Admin</a>'; }}}</td>
											<td>{{ $data->total }}</td>
											<td>{{ $data->updated_at }}</td>
											<td class="text-center btn-action">
												<button btn-href="@baseurl/admin/siswa/aktifitas/detail/{{ $data->id }}" btn-on-click="Membuka..." class="btn btn-xs btn-success">Detail Aktifitas</button>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
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