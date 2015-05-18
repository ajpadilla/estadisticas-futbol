<div class="col-md-12">
	<!-- BOX -->
	<div  id="add-phase-to-competition-form-div" class="box border primary col-md-12">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">Agregar Nuevo Grupo</span></h4>
		</div>
		<div class="box-body">
			{{ Form::open(['route' => 'competitions.api.add.phase','class'=>'form-horizontal', 'role'=>'form', 'method' => 'POST', 'id' => 'add-phase-to-competition-form']) }}
				
			<div class="form-group">
				{{ Form::label('name', 'Nombre', ['class' => 'col-md-2 control-label']) }}	
				<div class="col-md-6">{{ Form::text('name', null, ['class' => 'form-control','id' =>'name-new-phase-to-competition' ]) }}</div>
			</div>

			<div class="form-group">
				{{ Form::label('from', 'Desde', ['class' => 'col-md-2 control-label .datepicker']) }}	
				<div class="col-md-6">{{ Form::text('from', null, ['class' => 'form-control','id' =>'from-new-phase-to-competition' ]) }}</div>
			</div>			

			<div class="form-group">
				{{ Form::label('to', 'Hasta', ['class' => 'col-md-2 control-label .datepicker']) }}	
				<div class="col-md-6">{{ Form::text('to', null, ['class' => 'form-control','id' =>'to-new-phase-to-competition' ]) }}</div>
			</div>						

			<div class="form-group">
				{{ Form::label('format_id','Formatos',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('format_id', $formats, null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger formato...','id'=>'competition-new-format-id']) }}
				</div>
			</div>	

			{{ Form::close() }}
		</div>
	</div>
	<!-- /BOX -->					
</div>