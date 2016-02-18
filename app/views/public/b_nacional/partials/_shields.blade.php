<div class="expand-down-liga" align="center" style="width: 900px;">
	<!--<span class="datosequipo2">Click en el escudo para ver info <span class="elequipo"></span></span><br>-->
	@foreach($competitions as $competition)
		<?php 
			if(!empty($competition->hasPhases))
				$firstPhase = $competition->phases->first();
				if(!empty($firstPhase))
					$groupsForfirstPhase = $firstPhase->groups;
		?>
		<ul>
			@if(!empty($groupsForfirstPhase))
				@foreach($groupsForfirstPhase as $group)
					@foreach($group->teams as $team)
					<li>
						<a href=""><img src="{{ $team->escudo->url('thumb') }}"></a>
					</li>
					@endforeach
				@endforeach
			@endif
		</ul>
	@endforeach
</div>
