<nav>
	<div class="nav-wrapper blue-grey darken-3">
		<div class="brand-logo right">				
			<img src="@assets/img/no-profile.jpg" alt="">
		</div>
		<ul class="left">
			<li>
				<a href="javascript:" data-target="slide-out" class="sidenav-trigger">
					<i class="material-icons">menu</i>
				</a>
			</li>
		</ul>	
		<div class="col s12 nav-link">

			@foreach($this->nav_link as $x)

			<a href="@baseurl{{ $x['link'] }}" class="breadcrumb">{{ $x['text'] }}</a>
			
			@endforeach

		</div>
	</div>
</nav>