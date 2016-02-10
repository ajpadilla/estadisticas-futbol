@extends("public.layouts.main")

@section("content")
	<div style="clear: both;"></div>
	<br/>
	<div style="clear: both;"></div>
	<br/>
	@include('public.copa_argentina.partials._google-syndication')
	<div style="clear: both;"></div>
	<br>
	@include('public.copa_argentina.partials._info-cup')
	<div style="clear: both;"></div>
	<br/>
	@include('public.copa_argentina.partials._phases')
	<div style="clear: both;"></div>
	<br/>
	@include('public.copa_argentina.partials._games-for-phase')
	<div style="clear: both;"></div>
	<br/>
	<br/>
@stop