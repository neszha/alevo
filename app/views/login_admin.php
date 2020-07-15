<!DOCTYPE html>
<html lang="en">
<head>
	@view('themes.guest_meta')
	<title>Login Admin</title>
	@view('themes.guest_link')
</head>
<body id="login-siswa">

	<!-- <div class="go-home">
		<a href="@baseurl">
			<i class="material-icons">home</i>
		</a>
	</div> -->

	<section id="main-banner" class="blue-grey darken-4">

		<div class="wrapper">
			<div class="login-item">
				<div class="head">
					<div class="logo">
						<img src="@assets/img/logo.png" alt="">
					</div>
					<div class="title">
						<h3 class="white-text">LOGIN ADMIN</h3>
					</div>
				</div>
				<div class="body">
					<div class="login-wrapper">
						<div class="row">
							<form action="" method="post">
								<div class="input-field col s12">
									<i class="material-icons prefix">account_circle</i>
									<input id="username" type="text" name="username" autofocus="">
									<label for="username">Username/E-Mail</label>
								</div>
								<div class="input-field col s12">
									<i class="material-icons prefix">lock</i>
									<input id="password" type="password" class="validate" name="password">
									<label for="password">Password</label>
								</div>
								<div class="input-field col s12">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="always-login" />
											<span>Ingin tetap login?</span>
										</label>
									</div>
								</div>

								@if(_session('admin_login') == 'falied')

								<div class="input-field col s12 login-info red-text" style="display: flex; justify-content: center;">
									<span>Username atau password salah!</span>
								</div>

								@endif

								<div class="input-field col s12 mx-auto">
									<button class="waves-effect waves-light btn-large blue" name="login-admin" type="submit">
										LOGIN
									</button>
								</div>
								<div class="col s12">
									<div class="lupa-pass">
										<div><a href="#">Lupa password?</a></div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- <div class="footer">
					<p>Lorem ipsum dolor sit.</p>
				</div> -->
			</div>
		</div>
		
	</section>
	
	@view('themes.guest_script')
</body>
</html>