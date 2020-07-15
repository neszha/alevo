<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Data Periodik Siswa - Siswa Panel</title>
	@view('siswa.themes.link')
</head>
<body>

	@view('siswa.themes.nav')

	@view('siswa.themes.sidenav')

	<main>
		<div class="row main-header">
			<div class="col s12">
				<div class="card-panel blue-grey darken-3">
					<div class="">
						<span class="white-text">
							<b>
								<span>Lengkap :</span>
								<span class="new badge {{ $this->presentase_color['data_periodik'] }}" data-badge-caption="%">{{ $this->presentase_data->data_periodik }}</span>
							</b>
						</span>
					</div>
					<div class="">
						@if($this->portal_eds AND $this->data_status != 2)
						<a href="@url/edit" class="waves-effect waves-light btn" data-position="bottom" data-tooltip="Klik untuk memperbarui data!">
							<span>Perberui data</span>
						</a>
						@else
						<button class="btn disabled">Perbarui Data</button>
						@endif
					</div>
				</div>
				<div class="card-panel blue-grey darken-3 white-text data-update">
					<span><b>Data periodik</b> terakhir diperbarui pada </span>
					<span class="time">{{ $this->update_time->d }} {{ $this->update_time->m }} {{ $this->update_time->y }} - {{ $this->update_time->h }}:{{ $this->update_time->i }}</span>
				</div>
				<div class="divider"></div>
			</div>
		</div>

		<div class="row main-data">
			<div class="col s12">
				<div class="card">
					<div class="card-content">
						<div class="card-title center">
							<b>Data Periodik Siswa</b>
						</div>
						<div class="body">
							<table class="striped">
								<tbody>
									<tr>
										<th>Tinggi Badan</th>
										<td>{{ $this->data_periodik->tinggi_badan }}</td>
									</tr>
									<tr>
										<th>Berat Badan</th>
										<td>{{ $this->data_periodik->berat_badan }}</td>
									</tr>
									<tr>
										<th>Lingkar Kepala</th>
										<td>{{ $this->data_periodik->lingkar_kepala }}</td>
									</tr>
									<tr>
										<th>Jarak Tempat Tinggal dari Sekolah</th>
										<td>{{ $this->data_periodik->jarak_tinggal }}</td>
									</tr>
									<tr>
										<th>Waktu Tempuh ke Sekolah</th>
										<td>{{ $this->data_periodik->waktu_tempuh }}</td>
									</tr>
									<tr>
										<th>Jumlah Saudara Kandung</th>
										<td>{{ $this->data_periodik->saudara_kandung }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</main>

	@view('siswa.themes.footer')

	@view('siswa.themes.script')

</body>
</html>