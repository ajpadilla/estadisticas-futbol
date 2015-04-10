<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
	<div class="sidebar-menu nav-collapse">
		<div class="divide-20"></div>
		<!-- SEARCH BAR -->
		<div id="search-bar">
			<input class="search" type="text" placeholder="Search"><i class="fa fa-search search-icon"></i>
		</div>
		<!-- /SEARCH BAR -->
		
		<!-- SIDEBAR MENU -->
		<ul>
			<li>
				<a href="index.html">
					<i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
				</a>
			</li>
			<li class="has-sub">
				<a href="javascript:;" class="">
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Jugadores</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub">
					<li><a class="" href="{{ URL::route('jugadores.index') }}"><span class="sub-menu-text">Lista</span></a></li>
					<li><a id="new-player" class="" href="#new-player-form"><span class="sub-menu-text">Crear</span></a></li>
				</ul>
			</li>
		</ul>
		<!-- /SIDEBAR MENU -->
		<a id="lista-paises" href="{{ URL::route('paises.lista') }}"></a>
		<a id="lista-posiciones" href="{{ URL::route('posiciones.lista') }}"></a>
	</div>
</div>
<!-- /SIDEBAR -->