@extends("public.layouts.main")

@section("content")
	<div style="clear: both;"></div>
	<br/>
	<div style="clear: both;"></div>
	<br/>
	@include('public.champions.partials._google-syndication')
	<div style="clear: both;"></div>
	<br>
	@include('public.champions.partials._info-cup')
	<div style="clear: both;"></div>
	<br/>
	@include('public.champions.partials._games-for-phase')
	<div style="clear: both;"></div>
	<br/>
	@include('public.champions.partials._phases')
	<div style="clear: both;"></div>
	<br/>
	<br>
	@include('public.champions.partials._group-stage')
	<div style="clear: both;"></div>
	<br/>
@stop