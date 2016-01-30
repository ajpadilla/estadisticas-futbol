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
	@include('public.layouts.partials._google-syndication')
	@include('public.primera.partials._info-league')
	<div style="clear: both;"></div>
	<br>
	@include('public.primera.partials._leagues')
	<div style="clear: both;"></div>
	<br>
	<br>
	@include('public.primera.partials._positions')
			
@stop
