<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Data Wali - Siswa Panel</title>
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
								<span class="new badge {{ $this->presentase_color['data_wali'] }}" data-badge-caption="%">{{ $this->presentase_data->data_wali }}</span>
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
					<span><b>Data wali</b> terakhir diperbarui pada </span>
					<span class="time">{{ $this->update_time->d }} {{ $this->update_time->m }} {{ $this->update_time->y }} - {{ $this->update_time->h }}:{{ $this->update_time->i }}</span>
				</div>
				<div class="divider"></div>
			</div>
		</div>

		<div class="row main-data">
			<div class="col s12">
				<div class="card">
					<div class="card-content">
						<!-- <div class="card-title center">
							<b>Tidak Memiliki Wali</b>
						</div> -->
						<div class="card-title center">
							<b>Data Wali</b>
						</div>
						<div class="body">

							@if(!$this->data_wali->memiliki_wali)
							<br><br>
							<p class="center-align"><i>"<u>Tidak Mempunyai Wali</u>"</i></p>
							<br><br>
							@else
							<table class="striped">
								<tbody>
									<tr>
										<th>Nama Wali</th>
										<td>{{ $this->data_wali->nama }}</td>
									</tr>
									<tr>
										<th>NIK Wali</th>
										<td>{{ $this->data_wali->nik }}</td>
									</tr>
									<tr>
										<th>Tahun Lahir</th>
										<td>{{ $this->data_wali->tahun_lahir }}</td>
									</tr>
									<tr>
										<th>Pendidikan</th>
										<td>{{ $this->data_wali->pendidikan }}</td>
									</tr>
									<tr>
										<th>Perkerjaan</th>
										<td>{{ $this->data_wali->pekerjaan }}</td>
									</tr>
									<tr>
										<th>Penghasilan Bulanan</th>
										<td>{{ $this->data_wali->penghasilan }}</td>
									</tr>
									<tr>
										<th>Berkebutuhan Khusus</th>
										<td>{{ $this->data_wali->berkebutuhan_khusus }}</td>
									</tr>
								</tbody>
							</table>
							@endif
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