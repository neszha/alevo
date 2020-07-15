<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Perbarui Data Kontak - Siswa Panel</title>
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
							<h4>Perbarui Data Kontak</h4>
						</div>
						<div class="row">

							<form class="col s12 m10 offset-m1" method="post" action="@baseurl/siswa-api/data/kontak/simpan">
								<div class="row">

									<!-- No. Hp -->
									<div class="input-field col s12 m6">
										<input id="tlp" type="text" class="white-text" name="tlp" value="{{ $this->data_kontak->tlp }}" number-only>
										<label for="tlp">No. HP</label>
									</div>

									<!-- E-Mail -->
									<div class="input-field col s12 m6">
										<input id="email" type="email" name="email" value="{{ $this->data_kontak->email }}" email>
										<label for="email">E-Mail</label>
									</div>

									<!-- button -->
									<div class="input-field col s12 center">
										<button type="submit" name="simpan_data_kontak" value="true" class="waves-effect waves-light btn blue darken-1">
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