<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Perbarui Data Periodik - Siswa Panel</title>
	@view('siswa.themes.link')
</head>
<body>

	@view('siswa.themes.nav')

	@view('siswa.themes.sidenav')

	<main id="edit-page">

		<div class="row">
			<div class="col s12">
				<div class="card-panel blue-grey darken-3">
					<div class="card-content white-text">
						<div class="card-title">
							<h4>Perbarui Data Periodik</h4>
						</div>
						<div class="row">

							<form class="col s12 m10 offset-m1" method="post" action="@baseurl/siswa-api/data/periodik/simpan">
								<div class="row">

									<!-- Tinggi Badan -->
									<div class="input-field col s12 m4">
										<input id="tinggi_badan" type="text" name="tinggi_badan" value="{{ $this->data_periodik->tinggi_badan }}" number-only>
										<label for="tinggi_badan">Tinggi Badan</label>
										<span class="helper-text orange-text">*Satuan CM</span>
									</div>

									<!-- Berat Badan -->
									<div class="input-field col s12 m4">
										<input id="berat_badan" type="text" name="berat_badan" value="{{ $this->data_periodik->berat_badan }}" number-only>
										<label for="berat_badan">Berat Badan</label>
										<span class="helper-text orange-text">*Satuan KG</span>
									</div>

									<!-- Lingkar Kepala -->
									<div class="input-field col s12 m4">
										<input id="lingkar_kepala" type="text" name="lingkar_kepala" value="{{ $this->data_periodik->lingkar_kepala }}" number-only>
										<label for="lingkar_kepala">Lingkar Kepala</label>
										<span class="helper-text orange-text">*Satuan CM</span>
									</div>

									<!-- Jarak Tempat Tinggal -->
									<div class="input-field col s12 m4">
										<input id="jarak_tinggal" type="text" name="jarak_tinggal" value="{{ $this->data_periodik->jarak_tinggal }}" number-only>
										<label for="jarak_tinggal">Jarak Tempat Tinggal</label>
										<span class="helper-text orange-text">*Satuan KM</span>
									</div>

									<!-- Waktu Tempuh ke Sekolah -->
									<div class="input-field col s12 m4">
										<input id="waktu_tempuh" type="text" name="waktu_tempuh" value="{{ $this->data_periodik->waktu_tempuh }}" number-only>
										<label for="waktu_tempuh">Waktu Tempuh ke Sekolah</label>
										<span class="helper-text orange-text">*Satuan Menit</span>
									</div>

									<!-- Jumlah Saudara Kandung -->
									<div class="input-field col s12 m4">
										<input id="saudara_kandung" type="text" name="saudara_kandung" value="{{ $this->data_periodik->saudara_kandung }}" number-only>
										<label for="saudara_kandung">Jumlah Saudara Kandung</label>
									</div>

									<div class="input-field col s12 center">
										<button type="submit" name="simpan_data_periodik" value="true" class="waves-effect waves-light btn blue darken-1">
											<i class="material-icons left">save</i>
											SIMPAN DATA
										</button>
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
				<!-- <div class="divider"></div> -->
			</div>
		</div>

	</main>

	@view('siswa.themes.footer')

	@view('siswa.themes.script')

</body>
</html>