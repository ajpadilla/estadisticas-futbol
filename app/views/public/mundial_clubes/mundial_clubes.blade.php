@extends("public.layouts.main")

@section("content")
	<div style="clear: both;"></div>
	<br/>
	@include('public.mundial_clubes.partials._info-cup')
	<div style="clear: both;"></div>
	<br/>
	@include('public.mundial_clubes.partials._phases')
	<br/>
@stop