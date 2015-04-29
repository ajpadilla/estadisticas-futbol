<div id="jugador-add-equipo-div" style="display:none">
	<div id="jugador-add-equipo-div-box" class="box border primary">
		<div class="box-title">
			<h4><i class="fa fa-plus-square"></i>Agregar equipo a {{ $jugador->nombre }}</h4>
			<div class="tools">
				<a href="javascript:;" class="reload">
					<i class="fa fa-refresh"></i>
				</a>
				<a href="javascript:;" class="collapse">
					<i class="fa fa-chevron-up"></i>
				</a>
			</div>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
				<div class="col-md-12">

					<div class="divide-20"></div>
					<div class="box-body big">
						{{ Form::open(['route' => 'jugadores.api.add.equipo','class'=>'form-horizontal','role'=>'form', 'method' => 'POST', 'id'=> 'jugador-add-equipo-form']) }}
							<div class="form-group">
								{{ Form::label('equipo_id','Equipos',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::select('equipo_id', $equipos, null, ['class' => 'form-control chosen-select', 'data-placeholder' => 'Escoge equipo...', 'id'=> 'equipo_id']) }}
								</div>
							</div>	
							<div class="form-group">
								{{ Form::label('numero','Número',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('numero',null, ['class' => 'form-control','id' => 'numero']) }}
								</div>
							</div>	
							<div class="form-group">
								{{ Form::label('desde','Desde',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('desde',null, ['class' => 'form-control datepicker','id' => 'desde', 'placeholder' => 'dd-mm-yyyy']) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('hasta','Hasta',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('hasta',null, ['class' => 'form-control datepicker','id' => 'hasta', 'placeholder' => 'dd-mm-yyyy']) }}
								</div>
							</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
