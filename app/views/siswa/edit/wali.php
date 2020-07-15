<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Perbarui Data Wali - Siswa Panel</title>
	@view('siswa.themes.link')
</head>
<body>

	@view('siswa.themes.nav')

	@view('siswa.themes.sidenav')

	<main id="edit-page" class="{{ $this->wali_class }}">

		<div class="row">
			<div class="col s12">
				<div class="card-panel blue-grey darken-3">
					<div class="card-content white-text">
						<div class="card-title">
							<h4>Perbarui Data Wali</h4>
						</div>
						<div class="row">

							<form class="col s12 m10 offset-m1" method="post" action="@baseurl/siswa-api/data/wali/simpan">
								<div class="row">
									<!-- Nama Wali -->
									<div class="input-field col s12">
										<!-- Switch -->
										<div class="switch">
											<p>Apakah anda mempunyai wali?</p>
											<label>
												Tidak
												@if($this->data_wali->memiliki_wali)
												<input id="memiliki_wali" type="checkbox" name="memiliki_wali" checked>
												@else
												<input id="memiliki_wali" type="checkbox" name="memiliki_wali">
												@endif
												<span class="lever"></span>
												Iya
											</label>
										</div>
									</div>
								</div>
								<div class="row">

									<!-- Nama Wali -->
									<div class="input-field col s12 m4 wali-hide">
										<input id="nama" type="text" class="white-text" name="nama" value="{{ $this->data_wali->nama }}">
										<label for="nama">Nama Wali</label>
									</div>

									<!-- NIK Wali -->
									<div class="input-field col s12 m4 wali-hide">
										<input id="nik" type="text" data-length="16" class="length" name="nik" value="{{ $this->data_wali->nik }}" number-only length="16">
										<label for="nik">NIK Wali</label>
									</div>

									<!-- Tahun Lahir -->
									<div class="input-field col s12 m4 wali-hide">
										<input id="tahun_lahir" type="text" data-length="4" class="length" name="tahun_lahir" value="{{ $this->data_wali->tahun_lahir }}" number-only length="4">
										<label for="tahun_lahir">Tahun Lahir</label>
									</div>

									<div class="clear"></div>

									<!-- Pendidikan -->
									<div class="input-field col s12 m6 wali-hide">
										<select id="pendidikan" name="pendidikan">
											<option value="" disabled selected>*Pilih Pendidikan</option>

											@foreach($this->pendidikan_obj as $key => $value)
											
											@if($this->data_wali->pendidikan == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="pendidikan">Pendidikan Wali</label>
									</div>

									<!-- Pekerjaan -->
									<div class="input-field col s12 m6 wali-hide">
										<select id="pekerjaan" name="pekerjaan">
											<option value="" disabled selected>*Pilih Pekerjaan</option>

											@foreach($this->pekerjaan_obj as $key => $value)
											
											@if($this->data_wali->pekerjaan == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="pekerjaan">Pekerjaan Wali</label>
									</div>

									<!-- Penghasilan Bulanan -->
									<div class="input-field col s12 m6 wali-hide">
										<select id="penghasilan" name="penghasilan">
											<option value="" disabled selected>*Pilih Penghasilan</option>

											@foreach($this->penghasilan_obj as $key => $value)
											
											@if($this->data_wali->penghasilan == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="penghasilan">Penghasilan Bulanan</label>
									</div>

									<!-- Berkebutuhan Khusus -->
									<div class="input-field col s12 m6 wali-hide">
										<select id="berkebutuhan_khusus" name="berkebutuhan_khusus">
											<option value="" disabled selected>*Pilih</option>

											@foreach($this->berkebutuhan_khusus_obj as $key => $value)
											
											@if($this->data_wali->berkebutuhan_khusus == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="berkebutuhan_khusus">Berkebutuhan Khusus</label>
									</div>

									<div class="input-field col s12 center">
										<button type="submit" name="simpan_data_wali" value="true" class="waves-effect waves-light btn blue darken-1">
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