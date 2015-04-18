@extends("layouts.main")

@section("page-title")
	INICIO
@stop

@section("page-description")
	Página Inicial
@stop

@section("content")
	<div class="col-xs-2"></div>
	<div class="col-xs-8">
		@include('jugadores.new')
		@include('equipos.new')
		@include('paises.new')
	</div>
@stop

