<div class="col-md-12">
	<!-- BOX -->
	<div  id="add-teams-to-group-form-div" class="box border primary col-md-12">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">Agregar Equipos</span></h4>
		</div>
		<div class="box-body">
			{{ Form::open(['route' => ['groups.api.add.team'],'class'=>'form-horizontal','role'=>'form', 'id'=> 'add-team-to-group-form']) }}

			<div class="form-group" style="display: none;">
				{{ Form::label('group_id','Id',['class'=>'col-sm-2 control-label']) }}
				<div class="col-sm-6">
					{{ Form::text('group_id',null, ['class' => 'form-control','id' => 'group_id']) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('teams_ids[]','Equipos',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('teams_ids[]',array(),null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Equipos...','id'=>'new-teams-for-groups-ids','multiple' => true]) }}
				</div>
			</div>	
			{{ Form::close() }}
		</div>
	</div>
	<!-- /BOX -->					
</div>
