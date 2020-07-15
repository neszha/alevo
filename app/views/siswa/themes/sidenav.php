<ul id="slide-out" class="sidenav sidenav-fixed">
	<li>
		<div class="user-view">
			<div class="background  blue-grey darken-3">
				<!-- <img src="@assets/img/bg-1.jpg"> -->
			</div>
			<a>
				<img class="circle" src="@assets/img/no-profile.jpg">
			</a>
			<a>
				<span class="white-text name">{{ $this->siswa->nama }}</span> 
			</a>
			<a>
				<span class="white-text email nisn">{{ $this->siswa->nisn }}</span>
			</a>
			<a href="/siswa/dashboard" class="data-status">
				@if($this->data_status == 0)
				<span class="red-text text-lighten-1 email">
					<i class="tooltipped" data-position="top" data-tooltip="Lengkapi data untuk proses verifikasi!">*Belum Lengkap</i>
				</span>
				@endif

				@if($this->data_status == 1)
				<span class="orange-text text-lighten-1 email">
					<i class="tooltipped" data-position="top" data-tooltip="Data sedang di tinjau oleh operator.">*Proses Verifikasi</i>
				</span>
				@endif

				@if($this->data_status == 2)
				<span class="light-green-text text-accent-4 email">
					<i class="tooltipped" data-position="top" data-tooltip="Data telah terverifikasi.">*Terverifikasi</i>
				</span>
				@endif
			</a>
		</div>
	</li>

	<li class="{{{ if($this->nav_active == 'data_pribadi') echo 'active' }}}">
		<a href="@baseurl/siswa/data/pribadi">Data Pribadi <span class="new badge {{ $this->presentase_color['data_pribadi'] }}" data-badge-caption="%">{{ $this->presentase_data->data_pribadi }}</span></a>
	</li>
	<li class="{{{ if($this->nav_active == 'data_ayah') echo 'active' }}}">
		<a href="@baseurl/siswa/data/ayah">Data Ayah Kandung <span class="new badge {{ $this->presentase_color['data_ayah'] }}" data-badge-caption="%">{{ $this->presentase_data->data_ayah }}</span></a>
	</li>
	<li class="{{{ if($this->nav_active == 'data_ibu') echo 'active' }}}">
		<a href="@baseurl/siswa/data/ibu">Data Ibu Kandung <span class="new badge {{ $this->presentase_color['data_ibu'] }}" data-badge-caption="%">{{ $this->presentase_data->data_ibu }}</span></a>
	</li>
	<li class="{{{ if($this->nav_active == 'data_wali') echo 'active' }}}">
		<a href="@baseurl/siswa/data/wali">Data Wali <span class="new badge {{ $this->presentase_color['data_wali'] }}" data-badge-caption="%">{{ $this->presentase_data->data_wali }}</span></a>
	</li>
	<li class="{{{ if($this->nav_active == 'data_kontak') echo 'active' }}}">
		<a href="@baseurl/siswa/data/kontak">Data Kontak <span class="new badge {{ $this->presentase_color['data_kontak'] }}" data-badge-caption="%">{{ $this->presentase_data->data_kontak }}</span></a>
	</li>
	<li class="{{{ if($this->nav_active == 'data_periodik') echo 'active' }}}">
		<a href="@baseurl/siswa/data/periodik">Data Periodik <span class="new badge {{ $this->presentase_color['data_periodik'] }}" data-badge-caption="%">{{ $this->presentase_data->data_periodik }}</span></a>
	</li>
	<li class="{{{ if($this->nav_active == 'data_dokumen') echo 'active' }}}">
		<a href="@baseurl/siswa/data/dokumen">Data Dokumen <span class="new badge {{ $this->presentase_color['data_dokumen'] }}" data-badge-caption="%">{{ $this->presentase_data->data_dokumen }}</span></a>
	</li>
	<div class="divider"></div>
	<li class="no-padding {{{ if($this->nav_active == 'dashboard') echo 'active' }}}">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header" href="@baseurl/siswa/dashboard">Dahsboard</a>
			</li>
		</ul>
	</li>
	<li class="no-padding {{{ if($this->nav_active == 'pengaturan') echo 'active' }}}">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header" href="@baseurl/siswa/pengaturan">Pengaturan</a>
			</li>
		</ul>
	</li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
				<a class="collapsible-header" href="@baseurl/siswa/logout">Keluar</a>
			</li>
		</ul>
	</li>
</ul>