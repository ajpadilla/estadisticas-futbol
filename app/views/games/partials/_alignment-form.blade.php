<div class="row">
	{{ Form::open(['route' => ['games.api.add.alignment'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'add-team-to-group-form']) }}
		<input type="hidden" name="game-id" value="{{ $game->id }}">
		<input type="hidden" name="team-id" value="{{ $team->id }}">
		<table>
			<thead>
				<th>Jugador</th>
				<th>Posicion</th>
				<th>Condición Inicial</th>
			</thead>
			<tbody>
				@foreach($team->players as $player)
					<tr>
						<td>{{ $player->name }}</td>
						<td>
							<div class="form-group">
								<div class="col-md-6">
									{{ Form::select('position_player_{{ $player->id }}', $positions, null, ['class' => 'form-control chosen-select','data-placeholder' => 'Escoger posición...', 'id'=>'posicion_id-for-alignment']) }}
								</div>
							</div>																
						</td>
						<td>
							<div class="form-group">
								<div class="col-md-6">
									{{ Form::select('type__player_{{ $player->id }}', $alignmentTypes, null, ['class' => 'form-control chosen-select','data-placeholder' => 'Escoger condición...', 'id'=>'type_id-for-alignment']) }}
								</div>
							</div>									
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>		
	{{ Form::close() }}	
</div>
						
