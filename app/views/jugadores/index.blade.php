@extends("layouts.main")

@section("page-title")
	Lista de Jugadores
@stop

@section("page-description")
	Jugadores
@stop

@section("content")
<div class="col-md-12">
	<div class="box border green">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Listado De Jugadores</h4>
			<!--<div class="tools hidden-xs">
				<a href="#box-config" data-toggle="modal" class="config">
					<i class="fa fa-cog"></i>
				</a>
				<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
				</a>
				<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a href="javascript:;" class="remove">
					<i class="fa fa-times"></i>
				</a>
			</div>-->
		</div>
		<div class="box-body">
			<div class="row"><br/></div>
			@include('jugadores.partials._jugadores-table')
		</div>
	</div>
</div>
@stop