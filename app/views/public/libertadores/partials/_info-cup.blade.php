@if(!empty($libertadoresCups))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	{{ $libertadoresCups->links() }}
</div>
@foreach($libertadoresCups as $libertadoresCup)
<span class="verdegrande">
	<div style="width: 300px;float: left;padding-top: 10px;">
	<span style="color:#fff;font-size:24px;font-weight: bold">COPA LIBERTADORES {{ $libertadoresCup->year  }}</span><br>

	</div>
	<div style="width: 280px;float: left">
	<img src="http://upload.wikimedia.org/wikipedia/en/3/3a/Copa_Bridgestone_Libertadores_logo.png" width="140px">
	</div>
	<div style="width: 300px;float: left;font-size:12px">
	<br>
	Partido Inaugural: {{ $libertadoresCup->formatFrom }}<br>
	Partido Final: {{ $libertadoresCup->formatTo }}<br>
	Equipos participantes: 12 selecciones<br>
	</div>

	<div style="clear: both;"></div>
</span>
<div style="clear: both;"></div>
<br/>
<?php $winner = $competitionRepository->winner($libertadoresCup->id) ?>
@if(!empty($winner))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	<br>
	Campeón de América {{ $libertadoresCup->year }}<br>
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