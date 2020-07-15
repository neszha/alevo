<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	@view('admin.themes.meta')
	<title>Aktivitas {{ $this->data->siswa->nama }} - Admin Panel</title>
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
								<h2 class="text-center">Aktifitas {{ $this->data->siswa->nama }}</h2>
								<p>Menampilkan <b>{{ count($this->data->log) }}</b> aktifitas.</p>
								<table class="table">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Log Status</th>
											<th>Browser</th>
											<th>Ip Address</th>
											<th>Sistem Operasi</th>
											<th>Waktu</th>
										</tr>
									</thead>
									<tbody>
										@if($this->data->log == [])
										<tr>
											<td colspan="7" class="text-center">Tidak ada aktifitas.</td>
										</tr>
										@endif
										{{{ $total = count($this->data->log) }}}
										@foreach($this->data->log as $key => $data)
										<tr data-id="{{ $data->id }}">
											<td>{{ $total }}</td>
											<td>{{ $data->log }} {{{ if($data->im_admin == 1) echo '<a class="btn btn-xs btn-danger">Admin</a>'; }}}</td>
											<td>{{ $data->browser }}</td>
											<td>{{ $data->ip }}</td>
											<td>{{ $data->os }}</td>
											<td>{{ $data->created_at }}</td>
										</tr>
										{{{ $total--; }}}
										@endforeach
									</tbody>
								</table>
								<div class="w-100 text-right">
									<button class="btn btn-danger btn-sm" btn-on-click="Menghapus..." btn-href="@url/clean">Bersihkan Aktifitas</button>
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