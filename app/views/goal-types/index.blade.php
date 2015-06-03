@extends("layouts.main")

@section("page-title")
Lista Tipo De Goles
@stop

@section("page-description")
Tipo De Goles
@stop

@section("content")
<div class="col-md-12">
	<div class="box border green">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Lista De Tipo De Goles </h4>
		<!--<div class="tools hidden-xs">
			<a href="#box-config" data-toggle="modal" class="config">
				<i class="fa fa-cog"></i>
			</a>
			<a href="javascript:;" class="reload">
				<i class="fa fa-refresh"></i>
			</a>
			<a href="javascript:;" class="collapse">
				<i class="fa fa-chevron-up"></i>
			</a>
			<a href="javascript:;" class="remove">
				<i class="fa fa-times"></i>
			</a>
		</div>-->
	</div>
	<div class="box-body">
		<button class="add-goal-type pull-left btn btn-lg btn-primary" href="#">Agregar Tipo De Gol</button>
		<div class="row"><br/></div>
		@include('partials._index-table')
	</div>
</div>
<div id="edit-sanction-type-div" class="hidden">
	@include('sanction-types.edit')
</div>
@include('sanction-types.edit-tpl')
</div>

@stop