<div class="left-sidebar-pro">
	<nav id="sidebar">
		<div class="sidebar-header">
			<a href="#">
				<img src="@assets/admin/img/no-image.png" alt="" />
			</a>
			<h3>{{ $this->admin->nama_pendek }}</h3>
			<p>Admin</p>
			<strong>AP+</strong>
		</div>
		<div class="left-custom-menu-adp-wrap">
			<ul class="nav navbar-nav left-sidebar-menu-pro">
				<li class="nav-item">
					<a href="@baseurl/admin/dashboard" class="nav-link">
						<i class="fa big-icon fa-home"></i><span class="mini-dn"> Dashboard</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
						<i class="fa big-icon fa-table"></i> <span class="mini-dn">Siswa</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span>
					</a>
					<div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
						<a href="@baseurl/admin/siswa/tambah-data" class="dropdown-item">Tambah Data</a>
						<a href="@baseurl/admin/siswa/verifikasi" class="dropdown-item">Verifikasi Data</a>
						<a href="@baseurl/admin/siswa/data" class="dropdown-item">Data Siswa</a>
						<a href="@baseurl/admin/siswa/sampah" class="dropdown-item">Kotak Sampah</a>
						<a href="@baseurl/admin/siswa/aktifitas" class="dropdown-item">Aktifitas Siswa</a>
					</div>

				</li>
				<li class="nav-item">
					<a href="@baseurl/admin/pengaturan" class="nav-link">
						<i class="fa big-icon fa-cog"></i><span class="mini-dn"> Pengaturan</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="@baseurl/admin/logout" class="nav-link">
						<i class="fa big-icon fa-lock"></i><span class="mini-dn"> Keluar</span>
					</a>
				</li>
			</ul>
		</div>
	</nav>
</div>