<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Data Kontak - Siswa Panel</title>
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
								<span class="new badge {{ $this->presentase_color['data_kontak'] }}" data-badge-caption="%">{{ $this->presentase_data->data_kontak }}</span>
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
					<span><b>Data kontak</b> terakhir diperbarui pada </span>
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
							<b>Data Kontak</b>
						</div>
						<div class="body">
							<table class="striped">
								<tbody>
									<tr>
										<th>No. HP</th>
										<td>{{ $this->data_kontak->tlp }}</td>
									</tr>
									<tr>
										<th>E-Mail</th>
										<td>{{ $this->data_kontak->email }}</td>
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