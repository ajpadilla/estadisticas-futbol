@extends("public.layouts.main")

@section("content")
	<div style="clear: both;"></div>
	<br/>
	@include('public.mundial.partials._google-syndication')
	@include('public.mundial.partials._info-cup')
	<div style="clear: both;"></div>
	<br>
	<br>
	@include('public.mundial.partials._games-for-day')
	<div style="clear: both;"></div>
	<br>
	@include('public.mundial.partials._final-phase')
@stop
