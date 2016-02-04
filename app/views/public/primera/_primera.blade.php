@extends("public.layouts.main")
 {{--
@section("page-title")
	INICIO
@stop

@section("page-description")
	Página Inicial
@stop
--}}
@section("content")
	<div style="clear: both;"></div>
	<br/>
	<div style="clear: both;"></div>
	@include('public.primera.partials._paginator-games')
	<div style="clear: both;"></div>
	@include('public.primera.partials._shields')
	<div style="clear: both;"></div>
	<div style="clear: both;"></div>
	<br>
	@include('public.primera.partials._info-league')
	<div style="clear: both;"></div>
	<br>
	@include('public.primera.partials._leagues')
	<div style="clear: both;"></div>
	<br>
	<br>
	@include('public.primera.partials._positions')
	@include('public.primera.partials._phases');
	<br>
	<div style="clear: both;"></div>
	<br>
	@include('public.primera.partials._averages')
	@include('public.primera.partials._scorers')
	<br>
	<div style="clear: both;"></div>
	<br>
	<br>
	<div style="clear: both;"></div>
	<br>
	@include('public.primera.partials._table-games-phase-tpl')
@stop
