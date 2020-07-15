<!DOCTYPE html>
<html lang="en">
<head>
	@view('siswa.themes.meta')
	<title>Pengaturan - Siswa Panel</title>
	@view('siswa.themes.link')
</head>
<body>

	@view('siswa.themes.nav')

	@view('siswa.themes.sidenav')

	<main>
		<div class="row">
			<div class="col s12">
				<div class="card-panel blue-grey darken-3">
					<div class="card-content white-text">
						<div class="card-title">
							<h4>Keamanan</h4>
						</div>
						<div class="row">
							<div class="col">
								@if($this->akun_updated->created_at == $this->akun_updated->updated_at)
								<div class="alert amber lighten-1 black-text">
									<strong>Password anda yang sekarang dibuat oleh sistem.</strong> Password ini tidak aman untuk melindungi data anda. Oleh karena itu, tingkatkan sistem keamanan akun anda dengan password yang lebih aman.
								</div>
								@else
								<div class="alert green darken-1 white-text data-update">
									<strong>Password telah diubah pada: </strong>
									<span class="time">{{ $this->update_time->d }} {{ $this->update_time->m }} {{ $this->update_time->y }} - {{ $this->update_time->h }}:{{ $this->update_time->i }}</span>
								</div>
								@endif
							</div>
						</div>

						@if(_session('ubah_password') == 'success')
						<p class="orange-text center-align">
							<i>"Password berhasil diubah"</i>
						</p>
						@endif

						<div class="row">
							<form class="col s12" method="post" action="@baseurl/siswa-api/pengaturan/password/ubah">
								<div class="row">
									<div class="input-field col s12">
										<i class="material-icons prefix">lock_outline</i>
										<input id="password_lama" name="password_lama" type="password" class="white-text">
										<label for="password_lama">Passowrd Lama</label>
										@if(_session('ubah_password') == 'password_lama_tidak_sama')
										<span class="helper-text red-text">Password yang anda masukan salah</span>
										@endif
									</div>
									<div class="input-field col s12">
										<i class="material-icons prefix">lock</i>
										<input id="password_baru" name="password_baru" type="password" class="white-text" required>
										<label for="password_baru">Password Baru</label>
									</div>
									<div class="input-field col s12">
										<i class="material-icons prefix">lock</i>
										<input id="verifikasi_passowrd_baru" name="verifikasi_passowrd_baru" type="password" class="white-text" required>
										<label for="verifikasi_passowrd_baru">Verifikasi Password Baru</label>
										@if(_session('ubah_password') == 'password_baru_tidak_sama')
										<span class="helper-text red-text">Password varifikasi tidak sama</span>
										@endif
									</div>
									<div class="input-field col s12 center">
										<button type="submit" name="ubah-password" value="true" class="waves-effect waves-light btn blue">Ubah Password</button>
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