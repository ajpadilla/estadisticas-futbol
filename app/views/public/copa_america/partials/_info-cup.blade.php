@if(!empty($americaCups))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	{{ $americaCups->links() }}
</div>
@foreach($americaCups as $americaCup)
<span class="verdegrande">
	<div style="width: 300px;float: left;padding-top: 10px;">
	<span style="color:#b70c13;font-size:24px;font-weight: bold">COPA AMERICA</span><br>
	<span style="color:#054388;font-size:30px;font-weight: bold">{{ $americaCup->nombre }}</span><br>

	</div>
	<div style="width: 280px;float: left">
	<img src="http://lh3.googleusercontent.com/-R7rOnMxHr1k/VOebBHJXFTI/AAAAAAAADnE/1XyefVsoRAM/w100-h99-no/pelota2015.png">
	</div>
	<div style="width: 300px;float: left;font-size:12px">
	<br>
	Partido Inaugural: {{ $americaCup->formatFrom }}<br>
	Partido Final: {{ $americaCup->formatTo }}<br>
	Equipos participantes: 12 selecciones<br>
	</div>

	<div style="clear: both;"></div>
</span>
<div style="clear: both;"></div>
<br/>
<?php $winner = $competitionRepository->winner($americaCup->id) ?>
@if(!empty($winner))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	<br>
	Campeón de América {{ $americaCup->year; }}<br>
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