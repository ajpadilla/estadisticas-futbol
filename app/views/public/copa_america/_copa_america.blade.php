@extends("public.layouts.main")

@section("content")
	<div style="clear: both;"></div>
	<br/>
	<div style="clear: both;"></div>
	<br/>
	@include('public.copa_america.partials._google-syndication')
	<div style="clear: both;"></div>
	<br>
	@include('public.copa_america.partials._info-cup')
	<div style="clear: both;"></div>
	<br/>
	@include('public.copa_america.partials._phases')
	<div style="clear: both;"></div>
	<br/>
	<br>
	@include('public.copa_america.partials._group-stage')
	<div style="clear: both;"></div>
	<br/>
	{{--@include('public.copa_america.partials._historical')
	<div style="clear: both;"></div>
	<br/>--}}
@stop