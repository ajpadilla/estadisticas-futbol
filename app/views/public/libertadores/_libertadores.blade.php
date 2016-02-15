@extends("public.layouts.main")

@section("content")
	<div style="clear: both;"></div>
	<br/>
	<div style="clear: both;"></div>
	<br/>
	@include('public.libertadores.partials._google-syndication')
	<div style="clear: both;"></div>
	<br>
	@include('public.libertadores.partials._info-cup')
	<div style="clear: both;"></div>
	<br/>
	@include('public.libertadores.partials._phases')
	<div style="clear: both;"></div>
	<br/>
	@include('public.libertadores.partials._games-for-phase')
	<div style="clear: both;"></div>
	<br/>
	<br>
	@include('public.libertadores.partials._group-stage')
	<div style="clear: both;"></div>
	<br/>
@stop