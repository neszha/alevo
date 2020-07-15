<!DOCTYPE html>
<html lang="en">
<head>
	@view('themes.guest_meta')
	<title>Data Center - SMK Negeri 3 Metro</title>
	@view('themes.guest_link')
</head>
<body id="index">

	<header>
		<div class="wrapper scroll">
			<div class="nav">

				<div class="nav-col">
					<div class="image-logo">
						<img src="@assets/img/logo.png" alt="">
					</div>
				</div>

				<div class="nav-col dekstop">
					<div class="nav-link">
						<ul>
							<li>
								<a href="#main-banner">HOME</a>
							</li>
							<li>
								<a href="#about">INFORMATION</a>
							</li>
							<li>
								<a href="#">CONTACT</a>
							</li>
							<li>
								<a href="#">HELP</a>
							</li>
							<li>
								<a href="@baseurl/siswa/login" class="btn waves-effect waves-teal cyan btn-flat">
									<span>LOGIN SISWA</span>
								</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="nav-col mobile">
					<div class="menu-icon" data-open="open">
						<i class="material-icons">menu</i>
					</div>
					<div class="nav-toggle">
						<!-- content duplicate from .nav-link.dekstop -->
					</div>
				</div>

			</div>
		</div>	
	</header>

	<section id="main-banner">

		<div class="banner-content">
			<div class="wrapper">
				<h1>DATA SISWA SMK NEGERI 3 METRO</h1>

				<h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto expedita ut modi esse, illum deleniti voluptatibus nobis sunt sapiente assumenda.</h3>

				@if($this->portal_cs)
				<div class="banner-btn">
					<div class="row">
						<form class="col s12">
							<div class="row">
								<div class="input-field col m5 offset-m2 s12">
									<input id="input_nisn" type="text" data-length="10" class="active" autofocus="">
									<label for="input_nisn">NISN</label>
								</div>
								<div class="input-field col m3 s12">
									<a href="#" class="btn-large waves-effect waves-teal btn-flat blue lighten-5">
										<i class="material-icons left">search</i>
										<span>CARI SISWA</span>
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				@endif

			</div>
		</div>

		<!-- <div class="overlay">
			<img src="@assets/img/logo.png" alt="">
		</div> -->
		
	</section>

	<section id="about">
		<div class="wrapper container">
			<h3>Information</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In cupiditate voluptates optio suscipit vero rem aspernatur ratione officia? Nostrum, aperiam doloremque modi laborum placeat facere natus temporibus cum recusandae rem? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, officia blanditiis quidem et, animi sunt itaque, cupiditate quam inventore quas fugit rem facilis beatae. Dolor velit atque delectus dignissimos! Vel.</p>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum delectus excepturi ratione, eum amet voluptatibus veritatis fugiat qui nihil incidunt sequi, consequatur aliquid soluta doloribus dolor, unde quo alias, voluptates!</p>
		</div>
	</section>

	<footer>
		<div class="copy">
			2020 &copy; <a href="#">Alevo Production</a> | All rights reserved.
		</div>
	</footer>

	@view('themes.guest_script')

</body>
</html>