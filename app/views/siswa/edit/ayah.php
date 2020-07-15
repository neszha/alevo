<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Perbarui Data Ayah Kandung - Siswa Panel</title>
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
							<h4>Perbarui Data Ayah Kandung</h4>
						</div>
						<div class="row">

							<form class="col s12 m10 offset-m1" method="post" action="@baseurl/siswa-api/data/ayah/simpan">
								<div class="row">

									<!-- Nama Ayah -->
									<div class="input-field col s12 m4">
										<input id="nama" type="text" class="white-text" name="nama" value="{{ $this->data_ayah->nama }}">
										<label for="nama">Nama Ayah</label>
									</div>

									<!-- NIK Ayah -->
									<div class="input-field col s12 m4">
										<input id="nik" type="text" data-length="16" class="length" name="nik" value="{{ $this->data_ayah->nik }}" number-only length="16">
										<label for="nik">NIK Ayah</label>
									</div>

									<!-- Tahun Lahir -->
									<div class="input-field col s12 m4">
										<input id="tahun_lahir" type="text" data-length="4" class="length" name="tahun_lahir" value="{{ $this->data_ayah->tahun_lahir }}" number-only length="4">
										<label for="tahun_lahir">Tahun Lahir</label>
									</div>

									<div class="clear"></div>

									<!-- Pendidikan -->
									<div class="input-field col s12 m6">
										<select id="pendidikan" name="pendidikan">
											<option value="" disabled selected>*Pilih Pendidikan</option>

											@foreach($this->pendidikan_obj as $key => $value)
											
											@if($this->data_ayah->pendidikan == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="pendidikan">Pendidikan Ayah</label>
									</div>

									<!-- Pekerjaan -->
									<div class="input-field col s12 m6">
										<select id="pekerjaan" name="pekerjaan">
											<option value="" disabled selected>*Pilih Pekerjaan</option>
											
											@foreach($this->pekerjaan_obj as $key => $value)
											
											@if($this->data_ayah->pekerjaan == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="pekerjaan">Pekerjaan Ayah</label>
									</div>

									<!-- Penghasilan Bulanan -->
									<div class="input-field col s12 m6">
										<select id="penghasilan" name="penghasilan">
											<option value="" disabled selected>*Pilih Penghasilan</option>
											
											@foreach($this->penghasilan_obj as $key => $value)
											
											@if($this->data_ayah->penghasilan == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="penghasilan">Penghasilan Bulanan</label>
									</div>

									<!-- Berkebutuhan Khusus -->
									<div class="input-field col s12 m6">
										<select id="berkebutuhan_khusus" name="berkebutuhan_khusus">
											<option value="" disabled selected>*Pilih</option>
											
											@foreach($this->berkebutuhan_khusus_obj as $key => $value)
											
											@if($this->data_ayah->berkebutuhan_khusus == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="berkebutuhan_khusus">Berkebutuhan Khusus</label>
									</div>

									<div class="input-field col s12 center">
										<button type="submit" name="simpan_data_ayah" value="true" class="waves-effect waves-light btn blue darken-1">
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