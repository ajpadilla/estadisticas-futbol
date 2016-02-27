<div class="col-md-12">
	<div  id="add-promotions-to-competition-form-div" class="box border primary col-md-12">
	<div class="box-title">
		<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">Agregar Ascensos</span></h4>
	</div>
	<div class="box-body">
	{{ Form::open(['route' => 'competitions.api.add.phase','class'=>'form-horizontal', 'role'=>'form', 'method' => 'POST', 'id' => 'add-phase-to-competition-form']) }}
	<div class="form-group">
				{{ Form::label('promotions','Equipos',['class'=>'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::select('promotions',[],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge Tipo...','id'=> 'teams-promotions']) }}
		</div>
	</div>
	{{ Form::close() }}
	</div>
	</div>
</div>