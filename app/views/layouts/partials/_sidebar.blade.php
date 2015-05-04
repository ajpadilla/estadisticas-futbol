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
			<li class="has-sub">
				<a href="javascript:;" class="">
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Equipos</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub">
					<li><a class="" href="{{ URL::route('equipos.index') }}"><span class="sub-menu-text">Lista</span></a></li>
					<li><a id="new-team" class="" href="#new-team-form"><span class="sub-menu-text">Crear</span></a></li>
				</ul>
			</li>	
			<li class="has-sub">
				<a href="javascript:;" class="">
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Tipos de Competencia</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub">
					<li><a class="" href="{{ URL::route('tipos-competencia.index') }}"><span class="sub-menu-text">Lista</span></a></li>
					<li><a id="new-type-of-competition" class="" href="#new-type-of-competition-form"><span class="sub-menu-text">Crear</span></a></li>
				</ul>
			</li>	
			<li class="has-sub">
				<a href="javascript:;" class="">
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Competencias</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub">
					<li><a class="" href="{{ URL::route('competencias.index') }}"><span class="sub-menu-text">Lista</span></a></li>
					<li><a id="new-competition" class="" href="#new-competition-form"><span class="sub-menu-text">Crear</span></a></li>
				</ul>
			</li>					
			<li class="has-sub">
				<a href="javascript:;" class="">
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Paises</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub">
					<li><a class="" href="{{ URL::route('paises.index') }}"><span class="sub-menu-text">Lista</span></a></li>
					<li><a id="new-country" class="" href="#new-country-form"><span class="sub-menu-text">Crear</span></a></li>
				</ul>
			</li>	
			
			<li class="has-sub">
				<a href="javascript:;" class="">
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Posiciones</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub">
					<li><a class="" href="{{ URL::route('posiciones.index') }}"><span class="sub-menu-text">Lista</span></a></li>
					<li><a id="new-position" class="" href="#new-position-form"><span class="sub-menu-text">Crear</span></a></li>
				</ul>
			</li>

		</ul>
		<!-- /SIDEBAR MENU -->
		<!--Routes Paises-->
		<a id="lista-paises" href="{{ URL::route('paises.api.select.list') }}"></a>
		<a id="agregar-pais" href="{{ URL::route('paises.store') }}"></a>
		<a id="datos-pais" href="{{ URL::route('paises.api.show') }}"></a>
		<a id="editar-pais" href="{{ URL::route('paises.update') }}"></a>
		<a id="eliminar-pais" href="{{ URL::route('paises.delete-ajax') }}"></a>
		<!--Routes Posiciones-->
		<a id="agregar-posicion" href="{{ URL::route('posiciones.store') }}"></a>
		<a id="lista-posiciones" href="{{ URL::route('posiciones.api.select.list') }}"></a>
		<a id="ver-posicion" href="{{ URL::route('posiciones.api.show') }}"></a>
		<a id="editar-posicion" href="{{ URL::route('posiciones.api.update') }}"></a>
		<a id="eliminar-posicion" href="{{ URL::route('posiciones.api.eliminar') }}"></a>	
		<!--Routes Jugadores-->
		<a id="agregar-jugador" href="{{ URL::route('jugadores.store') }}"></a>
		<a id="datos-jugador" href="{{ URL::route('jugadores.data') }}"></a>
		<a id="editar-jugador" href="{{ URL::route('jugadores.api.update') }}"></a>
		<a id="eliminar-jugador" href="{{ URL::route('jugadores.api.eliminar') }}"></a>
		<a id="lista-jugadores" href="{{ URL::route('jugadores.api.select.list') }}"></a>
		<!--Routes Equipos-->
		<a id="lista-equipos" href="{{ URL::route('equipos.api.select.list') }}"></a>
		<a id="agregar-equipo" href="{{ URL::route('equipos.store') }}"></a>
		<a id="ver-equipo" href="{{ URL::route('equipos.data') }}"></a>	
		<a id="editar-equipo" href="{{ URL::route('equipos.api.update') }}"></a>
		<a id="eliminar-equipo" href="{{ URL::route('equipos.api.eliminar') }}"></a>
		<a id="verificar-jugador-equipo" href="{{ URL::route('equipos.api.verificar-jugador') }}"></a>
		<!--Route Tipo Compentencia-->
		<a id="agregar-tipo-competencia" href="{{ URL::route('tipos-competencia.store') }}"></a>
		<a id="editar-tipo-competencia" href="{{ URL::route('tipos-competencia.api.update') }}"></a>
		<a id="ver-tipo-competencia" href="{{ URL::route('tipos-competencia.api.show') }}"></a>
		<a id="eliminar-tipo-competencia" href="{{ URL::route('tipos-competencia.api.eliminar') }}"></a>
		<a id="lista-tipos-competencias" href="{{ URL::route('tipos-competencia.api.select.list') }}"></a>
		<!--Route Competencía-->
		<a id="agregar-competencia" href="{{ URL::route('competencias.store') }}"></a>
		<a id="eliminar-competencia" href="{{ URL::route('competencias.api.eliminar') }}"></a>
		
	</div>
</div>
<!-- /SIDEBAR -->