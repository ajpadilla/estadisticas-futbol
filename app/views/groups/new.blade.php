<div class="col-md-12">
	<!-- BOX -->
	<div  id="add-group-to-phase-form-div" class="box border primary col-md-12">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">Agregar Nuevo Grupo</span></h4>
		</div>
		<div class="box-body">
			{{ Form::open(['route' => 'phases.api.add.group','class'=>'form-horizontal', 'role'=>'form', 'method' => 'POST', 'id' => 'add-group-to-phase-form']) }}
				
			<div class="form-group">
				{{ Form::label('name', 'Nombre', ['class' => 'col-md-2 control-label']) }}	
				<div class="col-md-6">{{ Form::text('name', null, ['class' => 'form-control','id' =>'name-new-group-to-phase' ]) }}</div>
			</div>

			<div class="form-group">
				{{ Form::label('teams_ids[]','Equipos',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('teams_ids[]',array(),null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Equipos...','id'=>'phase-new-teams-ids','multiple' => true]) }}
				</div>
			</div>	

			{{ Form::close() }}
		</div>
	</div>
	<!-- /BOX -->					
</div>
