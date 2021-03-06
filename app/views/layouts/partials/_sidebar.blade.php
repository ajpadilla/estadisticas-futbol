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
					<li><a class="" href="{{ URL::route('players.index') }}"><span class="sub-menu-text">Lista</span></a></li>
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
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Formatos De Competencia</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub">
					<li><a class="" href="{{ URL::route('competitionFormats.index') }}"><span class="sub-menu-text">Lista</span></a></li>
					<li><a id="new-competition-format" class="" href="#new-competition-format-form"><span class="sub-menu-text">Crear</span></a></li>
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

			<li class="has-sub">
				<a href="javascript:;" class="">
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Tipo de alineación</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub">
					<li><a class="" href="{{ URL::route('alignmentsType.index') }}"><span class="sub-menu-text">Lista</span></a></li>
					<li><a id="new-alignment-type" class="" href="#new-alignment-type-form"><span class="sub-menu-text">Crear</span></a></li>
				</ul>
			</li>


			<li class="has-sub">
				<a href="javascript:;" class="">
					<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Juegos</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub">
					<li class="has-sub-sub">
						<a href="javascript:;" class="">
							<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Sanciones</span>
							<span class="arrow"></span>
						</a>
						<ul class="sub-sub">
							<li><a class="" href="{{ URL::route('sanction-types.index') }}"><span class="sub-menu-text">Lista</span></a></li>
							<li><a id="new-sanction-type" class="" href="#new-sanction-type-form-div-box"><span class="sub-menu-text">Crear</span></a></li>
						</ul>
					</li>
					<li class="has-sub-sub">
						<a href="javascript:;" class="">
							<i class="fa fa-bookmark-o fa-fw"></i> <span class="menu-text">Goles</span>
							<span class="arrow"></span>
						</a>
						<ul class="sub-sub">
							<li><a class="" href="{{ URL::route('goal-types.index') }}"><span class="sub-menu-text">Lista</span></a></li>
							<li><a id="new-goal-type" class="" href="#new-goal-type-form-div-box"><span class="sub-menu-text">Crear</span></a></li>
						</ul>
					</li>
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
		<a id="add-player" href="{{ URL::route('players.store') }}"></a>
		<a id="data-player" href="{{ URL::route('players.api.show') }}"></a>
		<a id="update-player" href="{{ URL::route('players.api.update') }}"></a>
		<a id="delete-player" href="{{ URL::route('players.api.delete') }}"></a>
		<a id="list-players" href="{{ URL::route('players.api.select.list') }}"></a>
		<a id="available-player" href="{{ URL::route('players.api.available') }}"></a>
		<!--Routes Equipos-->
		<a id="lista-equipos" href="{{ URL::route('equipos.api.select.list') }}"></a>
		<a id="agregar-equipo" href="{{ URL::route('equipos.store') }}"></a>
		<a id="ver-equipo" href="{{ URL::route('equipos.api.show') }}"></a>
		<a id="editar-equipo" href="{{ URL::route('equipos.api.update') }}"></a>
		<a id="eliminar-equipo" href="{{ URL::route('equipos.api.eliminar') }}"></a>
		<a id="number-exists" href="{{ URL::route('equipos.api.number.exist') }}"></a>
		<a id="verificar-jugador-equipo" href="{{ URL::route('equipos.api.verificar-jugador') }}"></a>
		<!--Route Formato Compentencia-->
		<a id="agregar-tipo-competencia" href="{{-- URL::route('tipos-competencia.store') --}}"></a>
		<a id="editar-tipo-competencia" href="{{-- URL::route('tipos-competencia.api.update') --}}"></a>
		<a id="ver-tipo-competencia" href="{{-- URL::route('tipos-competencia.api.show') --}}"></a>
		<a id="eliminar-tipo-competencia" href="{{-- URL::route('tipos-competencia.api.eliminar') --}}"></a>
		<a id="competition-format-list" href="{{ URL::route('competitionFormats.api.select.list') }}"></a>
		<!--Route Competencía-->
		<a id="agregar-competencia" href="{{ URL::route('competencias.store') }}"></a>
		<a id="eliminar-competencia" href="{{ URL::route('competencias.api.eliminar') }}"></a>
		<a id="list-of-competencies" href="{{ URL::route('competitions.api.select.list') }}"></a>
		{{--<a id="list-of-teams-for-competition" href="{{ URL::route('groups.api.available.teams') }}"></a>--}}
		<!--Groups-->
		<a id="add-new-teams-to-group" href="{{ URL::route('groups.api.add.team') }}"></a>
		<a id="data-group" href="{{ URL::route('groups.api.show') }}"></a>
		<a id="update-group" href="{{ URL::route('groups.api.update') }}"></a>
		<!--Games-->
		<a id="add-new-game-to-group" href="{{ URL::route('groups.api.add.game') }}"></a>
		<a id="exist-game-to-group" href="{{ URL::route('groups.api.exist.game') }}"></a>
		<a id="teams-available-for-games" href="{{ URL::route('groups.api.teams.availables.game') }}"></a>
		<a id="add-new-alignment-for-game" href="{{ URL::route('games.api.add.alignment') }}"></a>
		<a id="delete-group" href="{{ URL::route('groups.api.delete') }}"></a>
		<a id="delete-game" href="{{ URL::route('games.api.delete') }}"></a>
		<!--Phases-->
		<a id="add-new-phase-competition" href="{{ URL::route('competitions.api.add.phase') }}"></a>
		<a id="list-teams-phase-competition" href="{{ URL::route('phases.api.teams.availables.group') }}"></a>
		<a id="add-new-group-to-phase" href="{{ URL::route('phases.api.add.group') }}"></a>
		<a id="delete-phase" href="{{ URL::route('phases.api.delete') }}"></a>
		<a id="data-phase" href="{{ URL::route('phases.api.show') }}"></a>
		<a id="update-phase" href="{{ URL::route('phases.api.update') }}"></a>
		<!--Goals-->
		<a id="add-new-goal-for-game" href="{{ URL::route('games.api.add.goal') }}"></a>
		<a id="data-goal" href="{{ URL::route('goals.api.show') }}"></a>
		<a id="update-data-goal" href="{{ URL::route('goals.api.update') }}"></a>
		<!--Goals Types-->
		<a id="list-of-goal-types" href="{{ URL::route('goal-types.api.select.list') }}"></a>
		<a id="add-new-goal-type" href="{{ URL::route('goal-types.store') }}"></a>
		<a id="data-goal-type" href="{{ URL::route('goal-types.api.show') }}"></a>
		<a id="update-goal-type" href="{{ URL::route('goal-types.api.update') }}"></a>
		<a id="delete-goal-type" href="{{ URL::route('goal-types.api.delete') }}"></a>
		<!--Games-->
		<a id="teams-for-games" href="{{ URL::route('games.api.teams.availables.game') }}"></a>
		<a id="players-for-games" href="{{ URL::route('games.api.available.players.team') }}"></a>
		<a id="delete-goal-game" href="{{ URL::route('games.api.delete.goal') }}"></a>
		<a id="delete-sanction-game" href="{{ URL::route('games.api.delete.sanction') }}"></a>
		<a id="delete-change-game" href="{{ URL::route('games.api.delete.change') }}"></a>
		<a id="data-game" href="{{ URL::route('games.api.show') }}"></a>
		<a id="update-game" href="{{ URL::route('games.api.update') }}"></a>
		<a id="register-time-status-game" href="{{ URL::route('games.api.register-time-status') }}"></a>
		<!--Sanctions Types-->
		<a id="list-of-sanction-types" href="{{ URL::route('sanction-types.api.select.list') }}"></a>
		<a id="add-new-sanction-type" href="{{ URL::route('sanction-types.store') }}"></a>
		<a id="data-sanction-type" href="{{ URL::route('sanction-types.api.show') }}"></a>
		<a id="update-sanction-type" href="{{ URL::route('sanction-types.api.update') }}"></a>
		<a id="delete-sanction-type" href="{{ URL::route('sanction-types.api.delete') }}"></a>

		<!--Sanctions-->
		<a id="add-new-sanction" href="{{ URL::route('games.api.add.sanction') }}"></a>
		<a id="data-sanction" href="{{ URL::route('sanctions.api.show') }}"></a>
		<a id="update-sanction" href="{{ URL::route('sanctions.api.update') }}"></a>
		<!--Change-->
		<a id="add-new-change" href="{{ URL::route('games.api.add.change') }}"></a>
		<a id="data-change" href="{{ URL::route('changes.api.show') }}"></a>
		<a id="update-change" href="{{ URL::route('changes.api.update') }}"></a>
		<!--Alignment Types-->
		<a id="list-of-alignment-types" href="{{ URL::route('alignmentsType.api.select.list') }}"></a>
		<a id="add-new-alignment-type" href="{{ URL::route('alignmentsType.store') }}"></a>
		<a id="data-alignment-type" href="{{ URL::route('alignmentsType.api.show') }}"></a>
		<a id="update-alignmet-type" href="{{ URL::route('alignmentsType.api.update') }}"></a>
		<a id="delete-alignment-type" href="{{ URL::route('alignmentsType.api.delete') }}"></a>
		<!--Alignments-->
		<a id="delete-alignments" href="{{ URL::route('alignments.api.delete') }}"></a>
		<a id="data-alignment" href="{{ URL::route('alignments.api.show') }}"></a>
		<a id="update-alignment" href="{{ URL::route('alignments.api.update') }}"></a>
		<!--Competition Formats-->
		<a id="add-new-competition-format" href="{{ URL::route('competitionFormats.store') }}"></a>
		<a id="delete-competition-format" href="{{ URL::route('competitionFormats.api.delete') }}"></a>
		<a id="data-competition-format" href="{{ URL::route('competitionFormats.api.show') }}"></a>
		<a id="update-competition-format" href="{{ URL::route('competitionFormats.api.update') }}"></a>
		<!--Game types-->
		<a id="list-game-type" href="{{ URL::route('game-types.api.select.list') }}"></a>
		<a id="list-competitions-previous" href="{{ URL::route('allCompetitios.api.select') }}"></a>
		<a id="list-teams-for-promotions" href="{{ URL::route('teamsForPromotions.api.select') }}"></a>
		<a id="add-teams-for-promotions" href="{{ URL::route('competitions.api.add.promotions') }}"></a>
	</div>
</div>
<!-- /SIDEBAR -->