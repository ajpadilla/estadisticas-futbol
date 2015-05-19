<ul class="nav nav-tabs">
	@foreach ($competition->phasesWithGames as $phaseTableIndex => $phase)
		@if($phase->isFirst)
			<li class="active">
		@else
			<li>
		@endif
			<a href="#tab-{{ $phase->id }}" data-toggle="tab"><span class="hidden-inline-mobile">{{ $phase->name }}</span></a>
		</li>
	@endforeach
</ul>