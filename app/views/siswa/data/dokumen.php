<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Data Dokumen - Siswa Panel</title>
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
								<span class="new badge {{ $this->presentase_color['data_dokumen'] }}" data-badge-caption="%">{{ $this->presentase_data->data_dokumen }}</span>
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
					<span><b>Data dokumen</b> terakhir diperbarui pada </span>
					<span class="time">{{ $this->update_time->d }} {{ $this->update_time->m }} {{ $this->update_time->y }} - {{ $this->update_time->h }}:{{ $this->update_time->i }}</span>
				</div>
				<div class="divider"></div>
			</div>
		</div>

		<div class="row">
			<div class="col s12 m6">
				<div class="card">
					<div class="card-image">
						<?php if (is_file($this->ijazah_depan)) : ?>
							<img class="materialboxed responsive-img" src="@baseurl/{{ $this->ijazah_depan }}">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light blue-grey darken-3" download="{{ $this->siswa->nama }} - Ijazah Bagian Depan" role="button" href="@baseurl/{{ $this->ijazah_depan }}">
								<i class="material-icons">file_download</i>
							</a>
						<?php else : ?>
							<img class="materialboxed responsive-img" src="@assets/img/no-file-found.jpg">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light blue-grey darken-3 disabled">
								<i class="material-icons">file_download</i>
							</a>
						<?php endif ?>

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
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light blue-grey darken-3" download="{{ $this->siswa->nama }} - Ijazah Bagian Belakang" role="button" href="@baseurl/{{ $this->ijazah_belakang }}">
								<i class="material-icons">file_download</i>
							</a>
						<?php else : ?>
							<img class="materialboxed responsive-img" src="@assets/img/no-file-found.jpg">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light blue-grey darken-3 disabled">
								<i class="material-icons">file_download</i>
							</a>
						<?php endif ?>
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
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light blue-grey darken-3" download="{{ $this->siswa->nama }} - SKHU" role="button" href="@baseurl/{{ $this->skhu }}">
								<i class="material-icons">file_download</i>
							</a>
						<?php else : ?>
							<img class="materialboxed responsive-img" src="@assets/img/no-file-found.jpg">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light blue-grey darken-3 disabled">
								<i class="material-icons">file_download</i>
							</a>
						<?php endif ?>
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
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light blue-grey darken-3" download="{{ $this->siswa->nama }} - Kartu Keluarga" role="button" href="@baseurl/{{ $this->kartu_keluarga }}">
								<i class="material-icons">file_download</i>
							</a>
						<?php else : ?>
							<img class="materialboxed responsive-img" src="@assets/img/no-file-found.jpg">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light blue-grey darken-3 disabled">
								<i class="material-icons">file_download</i>
							</a>
						<?php endif ?>
					</div>
					<div class="card-content">
						<span class="card-title">
							<b>Kartu Keluarga</b>
						</span>
						<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem sequi dignissimos ipsa temporibus reprehenderit iusto et vitae, quod, placeat. Pariatur voluptates magni necessitatibus voluptas non quo quam corrupti, ad ratione!</p> -->
					</div>
				</div>
			</div>
		</div>


	</main>

	@view('siswa.themes.footer')

	@view('siswa.themes.script')

</body>
</html>