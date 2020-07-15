<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Perbarui Data Dokumen - Siswa Panel</title>
	@view('siswa.themes.link')
	<script>var audio = new Audio('@assets/sounds/notifikasi.ogg')</script>
</head>
<body>
	@view('siswa.themes.nav')

	@view('siswa.themes.sidenav')

	<main>
		<div class="row">
			<div class="col s12">
				<div class="card-panel blue-grey darken-3 white-text">
					<div>Format file yang di izinkan untuk di upload adalah <b class="orange-text">.jpg, .jpeg</b> dan <b class="orange-text">.png</b></div>
					<div>Dipastikan ukuran file yang akan di upload berukuran kurang dari <b class="orange-text">300 kb</b></div>
				</div>
				<div class="divider"></div>
			</div>
		</div>
		
		<form action="@baseurl/siswa-api/data/dokumen/simpan" method="post" enctype="multipart/form-data">
			
			<div class="row">
				<div class="col s12 m6">
					<div class="card">
						<div class="card-image">
							<?php if (is_file($this->ijazah_depan)) : ?>
								<img class="materialboxed responsive-img" src="@baseurl/{{ $this->ijazah_depan }}">
								<button type="button" input-click="#ijazah_depan" class="btn-floating btn-large halfway-fab waves-effect waves-light red">
									<i class="material-icons">image</i>
								</button>
								<?php else : ?>
									<img class="materialboxed responsive-img" src="@assets/img/no-file-found.jpg">
									<button type="button" input-click="#ijazah_depan" class="btn-floating btn-large halfway-fab waves-effect waves-light red">
										<i class="material-icons">image</i>
									</button>
								<?php endif; ?>
								<input type="file" id="ijazah_depan" class="document-input d-none" name="ijazah_depan" accept="image/x-png,image/jpeg">
							</div>
							<div class="card-content">
								<span class="card-title">
									<b>Ijazah Asli SMP (Depan)</b>
								</span>
								<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem sequi dignissimos ipsa temporibus reprehenderit iusto et vitae, quod, placeat. Pariatur voluptates magni necessitatibus voluptas non quo quam corrupti, ad ratione!</p> -->
							</div>
						</div>
					</div>
					<div class="col s12 m6">
						<div class="card">
							<div class="card-image">
								<?php if (is_file($this->ijazah_belakang)) : ?>
								<img class="materialboxed responsive-img" src="@baseurl/{{ $this->ijazah_belakang }}">
								<button type="button" input-click="#ijazah_belakang" class="btn-floating btn-large halfway-fab waves-effect waves-light red">
									<i class="material-icons">image</i>
								</button>
								<?php else : ?>
									<img class="materialboxed responsive-img" src="@assets/img/no-file-found.jpg">
									<button type="button" input-click="#ijazah_belakang" class="btn-floating btn-large halfway-fab waves-effect waves-light red">
										<i class="material-icons">image</i>
									</button>
								<?php endif; ?>
								<input type="file" id="ijazah_belakang" class="document-input d-none" name="ijazah_belakang" accept="image/x-png,image/jpeg">
							</div>
							<div class="card-content">
								<span class="card-title">
									<b>Ijazah Asli SMP (Belakang)</b>
								</span>
								<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem sequi dignissimos ipsa temporibus reprehenderit iusto et vitae, quod, placeat. Pariatur voluptates magni necessitatibus voluptas non quo quam corrupti, ad ratione!</p> -->
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="col s12 m6">
						<div class="card">
							<div class="card-image">
								<?php if (is_file($this->skhu)) : ?>
								<img class="materialboxed responsive-img" src="@baseurl/{{ $this->skhu }}">
								<button type="button" input-click="#skhu" class="btn-floating btn-large halfway-fab waves-effect waves-light red">
									<i class="material-icons">image</i>
								</button>
								<?php else : ?>
									<img class="materialboxed responsive-img" src="@assets/img/no-file-found.jpg">
									<button type="button" input-click="#skhu" class="btn-floating btn-large halfway-fab waves-effect waves-light red">
										<i class="material-icons">image</i>
									</button>
								<?php endif; ?>
								<input type="file" id="skhu" class="document-input d-none" name="skhu" accept="image/x-png,image/jpeg">
							</div>
							<div class="card-content">
								<span class="card-title">
									<b>SKHU Asli SMP</b>
								</span>
								<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem sequi dignissimos ipsa temporibus reprehenderit iusto et vitae, quod, placeat. Pariatur voluptates magni necessitatibus voluptas non quo quam corrupti, ad ratione!</p> -->
							</div>
						</div>
					</div>
					<div class="col s12 m6">
						<div class="card">
							<div class="card-image">
								<?php if (is_file($this->kartu_keluarga)) : ?>
								<img class="materialboxed responsive-img" src="@baseurl/{{ $this->kartu_keluarga }}">
								<button type="button" input-click="#kartu_keluarga" class="btn-floating btn-large halfway-fab waves-effect waves-light red">
									<i class="material-icons">image</i>
								</button>
								<?php else : ?>
									<img class="materialboxed responsive-img" src="@assets/img/no-file-found.jpg">
									<button type="button" input-click="#kartu_keluarga" class="btn-floating btn-large halfway-fab waves-effect waves-light red">
										<i class="material-icons">image</i>
									</button>
								<?php endif; ?>
								<input type="file" id="kartu_keluarga" class="document-input d-none" name="kartu_keluarga" accept="image/x-png,image/jpeg">
							</div>
							<div class="card-content">
								<span class="card-title">
									<b>Kartu Keluarga</b>
								</span>
								<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem sequi dignissimos ipsa temporibus reprehenderit iusto et vitae, quod, placeat. Pariatur voluptates magni necessitatibus voluptas non quo quam corrupti, ad ratione!</p> -->
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="col s12">
						<div class="center input-field">
							<button name="simpan-dokumen" value="true" class="waves-effect waves-light btn-large blue"><i class="material-icons right">file_upload</i>Simpan Dokumen</button>
						</div>
					</div>
				</div>

			</form>


		</main>

		@view('siswa.themes.footer')

		@view('siswa.themes.script')

	</body>
	</html>