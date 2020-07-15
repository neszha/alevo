<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Data Pribadi - Siswa Panel</title>
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
								<span class="new badge {{ $this->presentase_color['data_pribadi'] }}" data-badge-caption="%">{{ $this->presentase_data->data_pribadi }}</span>
							</b>
						</span>
					</div>
					<div class="">
						@if($this->portal_eds AND $this->data_status != 2)
						<a href="@url/edit" class="waves-effect waves-light btn" data-position="bottom" data-tooltip="Klik untuk memperbarui data!">
							Perberui data
						</a>
						@else
						<button class="btn disabled">Perbarui data</button>
						@endif
					</div>
				</div>
				<div class="card-panel blue-grey darken-3 white-text data-update">
					<span><b>Data pribadi</b> terakhir diperbarui pada </span>
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
							<b>Data Pribadi</b>
						</div>
						<div class="body">
							<table class="striped">
								<tbody>
									<tr>
										<th>Nama Lengkap</th>
										<td>{{ $this->data_main->nama }}</td>
									</tr>
									<tr>
										<th>Jenis Kelamin</th>
										<td>{{ $this->data_pribadi->jenis_kelamin }}</td>
									</tr>
									<tr>
										<th>NISN</th>
										<td>{{ $this->siswa->nisn }}</td>
									</tr>
									<tr>
										<th>NIK</th>
										<td>{{ $this->data_pribadi->nik }}</td>
									</tr>
									<tr>
										<th>No. Kartu Keluarga</th>
										<td>{{ $this->data_pribadi->no_kartu_keluarga }}</td>
									</tr>
									<tr>
										<th>Tempat, Tanggal Lahir</th>
										<td>{{ $this->data_pribadi->tempat_lahir }}, {{ $this->data_pribadi->tanggal_lahir }}</td>
									</tr>
									<tr>
										<th>No. Akta Kelahiran</th>
										<td>{{ $this->data_pribadi->no_akta_kelahiran }}</td>
									</tr>
									<tr>
										<th>Anak Ke</th>
										<td>{{ $this->data_pribadi->anak_ke }}</td>
									</tr>
									<tr>
										<th>Agama dan Kepercayaan</th>
										<td>{{ $this->data_pribadi->agama }}</td>
									</tr>
									<tr>
										<th>Kewarganegaraan</th>
										<td>{{ $this->data_pribadi->kewarganegaraan }}</td>
									</tr>
									<tr>
										<th>Berkebutuhan Khusus</th>
										<td>{{ $this->data_pribadi->berkebutuhan_khusus }}</td>
									</tr>
									<tr>
										<th>Alamat</th>
										<td>{{ $this->data_pribadi->alamat }}</td>
									</tr>
									<tr>
										<th>RT/RW</th>
										<td>{{ $this->data_pribadi->rt }}/{{ $this->data_pribadi->rw }}</td>
									</tr>
									<tr>
										<th>Nama Dusun</th>
										<td>{{ $this->data_pribadi->dusun }}</td>
									</tr>
									<tr>
										<th>Nama Kelurahan/Desa</th>
										<td>{{ $this->data_pribadi->desa }}</td>
									</tr>
									<tr>
										<th>Kecamatan</th>
										<td>{{ $this->data_pribadi->kecamatan }}</td>
									</tr>
									<tr>
										<th>Kabupaten</th>
										<td>{{ $this->data_pribadi->kabupaten }}</td>
									</tr>
									<tr>
										<th>Provinsi</th>
										<td>{{ $this->data_pribadi->provinsi }}</td>
									</tr>
									<tr>
										<th>Kode Pos</th>
										<td>{{ $this->data_pribadi->kode_pos }}</td>
									</tr>
									<tr>
										<th>Tinggal Bersama</th>
										<td>{{ $this->data_pribadi->tempat_tinggal }}</td>
									</tr>
									<tr>
										<th>Transportasi</th>
										<td>{{ $this->data_pribadi->transportasi }}</td>
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