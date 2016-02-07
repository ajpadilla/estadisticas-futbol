@extends("public.layouts.main")

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
	@include('public.primera.partials._name-phases-for-competition-tpl')
	@include('public.primera.partials._stats-phase-tpl')
	@include('public.primera.partials._scorers-tpl')
@stop
