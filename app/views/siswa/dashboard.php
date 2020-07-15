<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Dashboard - Siswa Panel</title>
	@view('siswa.themes.link')
</head>
<body>

	@view('siswa.themes.nav')

	@view('siswa.themes.sidenav')

	<main>

		<div class="row profile">

			<div class="col s12">
				<div class="card-panel blue-grey darken-3 white-text">
					<b>
						<span>Total Kelengkapan Data :</span>
						<span class="new badge {{ $this->presentase_total['color'] }}" data-badge-caption="%">{{ $this->presentase_total['presentase'] }}</span>
					</b>
					
				</div>
			</div>

			@if($this->presentase_total['presentase'] != 100)
			<div class="col s12">
				<div class="card-panel blue-grey darken-3 white-text">
					<div class="">
						<div class="alert amber lighten-1 black-text">
							<strong>Data belum lengkap!</strong> Anda harus mengisi semua form yang wajib untuk diisi. Isilah data dengan baik dan benar!
						</div> 
						<br>	
						<div class="btn-data">
							
							<a class="waves-effect waves-light btn {{ $this->presentase_color['data_pribadi'] }}" href="@baseurl/siswa/data/pribadi">
								<span>Data Pribadi: <span class="number">{{ $this->presentase_data->data_pribadi }}</span>%</span>
							</a>

							<a class="waves-effect waves-light btn {{ $this->presentase_color['data_ayah'] }}" href="@baseurl/siswa/data/ayah">
								<span>Data Ayah Kandung: <span class="number">{{ $this->presentase_data->data_ayah }}</span>%</span>
							</a>

							<a class="waves-effect waves-light btn {{ $this->presentase_color['data_ibu'] }}" href="@baseurl/siswa/data/ibu">
								<span>Data Ibu Kandung: <span class="number">{{ $this->presentase_data->data_ibu }}</span>%</span>
							</a>

							<a class="waves-effect waves-light btn {{ $this->presentase_color['data_wali'] }}" href="@baseurl/siswa/data/wali">
								<span>Data Wali: <span class="number">{{ $this->presentase_data->data_wali }}</span>%</span>
							</a>

							<a class="waves-effect waves-light btn {{ $this->presentase_color['data_kontak'] }}" href="@baseurl/siswa/data/kontak">
								<span>Data Kontak: <span class="number">{{ $this->presentase_data->data_kontak }}</span>%</span>
							</a>

							<a class="waves-effect waves-light btn {{ $this->presentase_color['data_periodik'] }}" href="@baseurl/siswa/data/periodik">
								<span>Data Periodik: <span class="number">{{ $this->presentase_data->data_periodik }}</span>%</span>
							</a>

							<a class="waves-effect waves-light btn {{ $this->presentase_color['data_dokumen'] }}" href="@baseurl/siswa/data/dokumen">
								<span>Data Dokumen: <span class="number">{{ $this->presentase_data->data_dokumen }}</span>%</span>
							</a>

						</div>
					</div>
				</div>
			</div>
			
			@endif

			@if($this->data_status == 1)

			<div class="col s12">
					<span class="time"></span>
				<div class="card-panel orange darken-3 white-text center">
					<div><strong>Semua form data telah terisi.</strong></div>
					<i>Data anda sedang ditinjau untuk proses verifikasi data. Jika telah terverifikasi, anda tidak dapat melakukan perubahan data lagi.</i>
				</div>
				<div class="divider"></div>
			</div>
			
			@endif
			
			<div class="col s12">
				<div class="card-panel blue-grey darken-3">
					<div class="card-content white-text">
						<div class="card-title">
							<h4>Profile</h4>
						</div>
						<div class="item">
							<div class="image">
								<img class="materialboxed responsive-img z-depth-5" src="@assets/img/no-image.jpg" alt="">
							</div>
							<div class="data">
								<h5>{{ $this->data_main->nama }}</h5>
								<h6>{{ $this->siswa->nisn }}</h6>
							</div>
						</div>

						<div class="more row">
							<div class="col s12 m8 offset-m2">
								<table class="white-text ">
									<tbody>
										<tr>
											<td><b>Jurusan</b></td>
											<td>{{ $this->data_main->jurusan }}</td>
										</tr>
										<tr>
											<td><b>Status</b></td>
											<td>{{ $this->data_main->status }}</td>
										</tr>
										<tr>
											<td><b>Angkatan</b></td>
											<td>{{ $this->data_main->angkatan }}</td>
										</tr>
										<tr>
											<td><b>Sekolah</b></td>
											<td>SMK Negeri 3 Metro</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="divider"></div>
			</div>
		</div>

	</main>

	@view('siswa.themes.footer')

	@view('siswa.themes.script')

</body>
</html>