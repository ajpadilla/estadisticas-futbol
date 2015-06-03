<div id="add-goal-type-form-div" class="box border primary">
	<div class="box-title">
		<h4><i class="fa fa-plus-square"></i>Crear Tipo De Gol</h4>
	</div>
	<div class="box-body" style="display: block;">
		<div class="row">
			<div class="col-md-12">

				<div class="divide-20"></div>
				<div class="box-body big">
					{{ Form::open(['route' => 'goal-types.store','class'=>'form-horizontal','role'=>'form',
					'method' => 'POST','files' => true,'id'=> 'new-goal-type-form']) }}
						<div class="row">
							<div class="form-group">
								{{ Form::label('name','Nombre',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('name',null, ['class' => 'form-control','id' => 'goal-type-name']) }}
								</div>
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
