<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Perbarui Data Pribadi - Siswa Panel</title>
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
							<h4>Perbarui Data Pribadi</h4>
						</div>
						<div class="row">

							<form class="col s12 m10 offset-m1" method="post" action="@baseurl/siswa-api/data/pribadi/simpan">
								<div class="row">

									<!-- Nama Lengkap -->
									<div class="input-field col s12">
										<input id="nama_lengkap" type="text" class="white-text" name="nama" value="{{ $this->data_main->nama }}" requiredx>
										<label for="nama_lengkap">*Nama Lengkap</label>
									</div>
									
									<!-- Jenis Kelamin -->
									<div class="input-field col s12"> 
										<div class="horizontal-radio">
											<span>
												<label>
													<input class="with-gap" name="jenis_kelamin" value="l" type="radio" requiredx {{{ if($this->data_pribadi->jenis_kelamin == 'l') echo 'checked' }}} />
													<span>Laki-Laki</span>
												</label>
											</span>
											<span>
												<label>
													<input class="with-gap" name="jenis_kelamin" value="p" type="radio" requiredx {{{ if($this->data_pribadi->jenis_kelamin == 'p') echo 'checked' }}}/>
													<span>Perempuan</span>
												</label>
											</span>
										</div>
									</div>

									<!-- NIK -->
									<div class="input-field col s12 m6">
										<input id="nik" type="text" data-length="16" class="length" requiredx name="nik" value="{{ $this->data_pribadi->nik }}" number-only length="16">
										<label for="nik">NIK</label>
									</div>

									<!-- No. Kartu Keluarga -->
									<div class="input-field col s12 m6">
										<input id="kartu_keluarga" type="text" data-length="16" class="length" requiredx name="no_kartu_keluarga" value="{{ $this->data_pribadi->no_kartu_keluarga }}" number-only length="16">
										<label for="kartu_keluarga">No. Kartu Keluarga</label>
									</div>

									<div class="clear"></div>

									<!-- Tempat Lahir -->
									<div class="input-field col s12 m4">
										<input id="tempat_lahir" type="text" requiredx name="tempat_lahir" value="{{ $this->data_pribadi->tempat_lahir }}">
										<label for="tempat_lahir">Tempat Lahir</label>
									</div>

									<!-- Tanggal Lahir -->
									<div class="input-field col s12 m4">
										<input id="tanggal_lahir" type="text" class="datepicker" requiredx name="tanggal_lahir" value="{{ $this->data_pribadi->tanggal_lahir }}">
										<label for="tanggal_lahir">Tanggal Lahir</label>
									</div>

									<div class="clear"></div>

									<!-- No. Akta Kelahiran -->
									<div class="input-field col s12 m4">
										<input id="akta_kelahiran" type="text" requiredx name="no_akta_kelahiran" value="{{ $this->data_pribadi->no_akta_kelahiran }}">
										<label for="akta_kelahiran">No. Akta Kelahiran</label>
									</div>

									<!-- Anak Ke -->
									<div class="input-field col s12 m3">
										<input id="anak_ke" type="text" requiredx name="anak_ke" value="{{ $this->data_pribadi->anak_ke }}" number-only>
										<label for="anak_ke">Anak Ke</label>
									</div>

									<div class="clear"></div>

									<!-- Agama -->
									<div class="input-field col s12 m4">
										<select id="agama" name="agama" requiredx>
											<option value="0" disabled selected>*Pilih Agama & Kepercayaan</option>

											@foreach($this->agama_obj as $key => $value)
											
											@if($this->data_pribadi->agama == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="agama">Agama & Kepercayaan</label>
									</div>

									<!-- Kewarganegaraan -->
									<div class="input-field col s12 m4">
										<select id="kewarganegaraan" name="kewarganegaraan" requiredx>
											<option value="" disabled selected>*Pilih Kewarganegaraan</option>

											@foreach($this->kewarganegaraan_obj as $key => $value)

											@if($this->data_pribadi->kewarganegaraan == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="kewarganegaraan">Kewarganegaraan</label>
									</div>

									<!-- Berkebutuhan Khusus -->
									<div class="input-field col s12 m4">
										<select id="berkebutuhan_khusus" name="berkebutuhan_khusus" requiredx>
											<option value="" disabled selected>*Pilih</option>

											@foreach($this->berkebutuhan_khusus_obj as $key => $value)
											
											@if($this->data_pribadi->berkebutuhan_khusus == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="berkebutuhan_khusus">Berkebutuhan Khusus</label>
									</div>

									<div class="clear"></div>

									<!-- Alamat -->
									<div class="input-field col s12">
										<textarea id="alamat" class="materialize-textarea" requiredx name="alamat">{{ $this->data_pribadi->alamat }}</textarea>
										<label for="alamat">Alamat</label>
									</div>

									<!-- RT -->
									<div class="input-field col s6 m2">
										<input id="rt" type="text" name="rt" requiredx value="{{ $this->data_pribadi->rt }}" number-only>
										<label for="rt">RT</label>
									</div>

									<!-- RW -->
									<div class="input-field col s6 m2">
										<input id="rw" type="text" name="rw" requiredx value="{{ $this->data_pribadi->rw }}" number-only>
										<label for="rw">RW</label>
									</div>

									<!-- Kode Pos -->
									<div class="input-field col s12 m2">
										<input id="kode_pos" type="text" requiredx value="{{ $this->data_pribadi->kode_pos }}" name="kode_pos" number-only length="5">
										<label for="kode_pos">Kode Pos</label>
									</div>

									<!-- Nama Dusun -->
									<div class="input-field col s12 m3">
										<input id="dusun" type="text" name="dusun" requiredx value="{{ $this->data_pribadi->dusun }}">
										<label for="dusun">Nama Dusun</label>
									</div>

									<!-- Nama Kelurahan/Desa -->
									<div class="input-field col s12 m3">
										<input id="desa" type="text" name="desa" requiredx value="{{ $this->data_pribadi->desa }}">
										<label for="desa">Nama Kelurahan/Desa</label>
									</div>


									<!-- Kecamatan -->
									<div class="input-field col s12 m4">
										<input id="kecamatan" type="text" name="kecamatan" requiredx value="{{ $this->data_pribadi->kecamatan }}">
										<label for="kecamatan">Kecamatan</label>
									</div>

									<!-- Kabupaten -->
									<div class="input-field col s12 m4">
										<input id="kabupaten" type="text" name="kabupaten" requiredx value="{{ $this->data_pribadi->kabupaten }}">
										<label for="kabupaten">Kabupaten</label>
									</div>

									<!-- Provinsi -->
									<div class="input-field col s12 m4">
										<input id="provinsi" type="text" name="provinsi" requiredx value="{{ $this->data_pribadi->provinsi }}">
										<label for="provinsi">Provinsi</label>
									</div>


									<!-- Tempat Tinggal -->
									<div class="input-field col s12 m6">
										<select id="tempat_tinggal" name="tempat_tinggal" requiredx>
											<option value="" disabled selected>*Pilih</option>

											@foreach($this->tempat_tinggal_obj as $key => $value)
											
											@if($this->data_pribadi->tempat_tinggal == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif

											@endforeach

										</select>
										<label for="tempat_tinggal">Tempat Tinnggal</label>
									</div>

									<!-- Transportasi -->
									<div class="input-field col s12 m6">
										<select id="transportasi" name="transportasi" requiredx>
											<option value="" disabled selected>*Pilih</option>

											@foreach($this->transportasi_obj as $key => $value)
											
											@if($this->data_pribadi->transportasi == $key)
											<option value="{{ $key }}" selected>{{ $value }}</option>
											@else
											<option value="{{ $key }}">{{ $value }}</option>
											@endif
											
											@endforeach

										</select>
										<label for="transportasi">Transportasi</label>
									</div>

									<div class="input-field col s12 center">
										<button type="submit" name="simpan_data_pribadi" value="true" class="waves-effect waves-light btn blue darken-1">
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