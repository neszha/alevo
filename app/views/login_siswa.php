<!DOCTYPE html>
<html lang="en">
<head>
	@view('themes.guest_meta')
	<title>Login Siswa</title>
	@view('themes.guest_link')
</head>
<body id="login-siswa">

	@if(!$this->portal_ls)
	<div class="login-lock">
		<div>
			<i class="material-icons prefix">lock</i>
			<h5 class="white-text">Portal login siswa ditutup!</h5>
		</div>
	</div>
	@endif

	<div class="go-home">
		<a href="@baseurl">
			<i class="material-icons">home</i>
		</a>
	</div>

	<section id="main-banner">

		<div class="wrapper">
			<div class="login-item">
				<div class="head">
					<div class="logo">
						<img src="@assets/img/logo.png" alt="">
					</div>
					<div class="title">
						<h3>LOGIN SISWA SMK NEGERI 3 METRO</h3>
					</div>
				</div>
				<div class="body">
					<div class="login-wrapper">
						<div class="row">
							<form action method="post">

								<div class="input-field col s12">
									<i class="material-icons prefix">account_circle</i>
									<input {{ $this->disabled }} name="nisn" id="input_nisn" type="text">
									<label for="input_nisn">NISN</label>
								</div>
								
								<div class="input-field col s12">
									<i class="material-icons prefix">lock</i>
									<input {{ $this->disabled }} name="password" id="input_password" type="password" class="validate">
									<label for="input_password">Password</label>
								</div>
								
								@if(_session('siswa_login') == 'falied')
								<div class="input-field col s12 login-info red-text" style="display: flex;justify-content: center;">
									<span>NISN atau password salah!</span>
								</div>
								@endif
								
								<div class="input-field col s12 mx-auto">
									<button class="waves-effect waves-light btn-large {{ $this->disabled }}" name="login-siswa" type="submit">
										LOGIN
									</button>
								</div>
								
								<div class="col s12">
									<div class="lupa-pass">
										<div>Lupa password? <a href="#">Tanya operator</a></div>
									</div>
								</div>
							
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</section>
	
	@view('themes.guest_script')
</body>
</html>