@if(!empty($championsCups))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	{{ $championsCups->links() }}
</div>
@foreach($championsCups as $champion)
<span class="verdegrande">
	CHAMPIONS LEAGUE {{$champion->year}} / {{ $champion->yearEnd  }}
</span>
<div style="clear: both;"></div>
<br/>
<?php $winner = $competitionRepository->winner($champion->id) ?>
@if(!empty($winner))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	<br>
	Campeón {{ $champion->year }}<br>
	<img src="{{ $winner->escudo->url('thumb') }}" width="50" height="50"><br>
	<img src="{{ $winner->escudo->url('thumb') }}"> {{ $winner->nombre }}
	<br>

	<div style="clear: both;"></div>
	<br>
</div>
@endif
<br/>
@endforeach
@endif