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
	@include('public.layouts.partials._google-syndication')
	<div style="clear: both;"></div>
	@include('public.layouts.partials._games-control')
	@include('public.layouts.partials._shout-goal')
	@if(!empty($today))
		@include('public.layouts.partials._today-games')
	@else
		@include('public.layouts.partials._next-games')
	@endif
	@include('public.layouts.partials._google-syndication')
	{{-- <div style="clear: both;"><br/></div>		
	<span class="verdegrande">PROXIMOS PARTIDOS</span>
	@include('public.layouts.partials._next-games') --}}		
@stop
