<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	<div style="width: 250px;float: left">
		@if (!empty($currentCompetition))
			<strong>{{ $currentCompetition->nombre }}</strong><br>
		@endif
		@if(!empty($winner))
			<img src="{{  $winner->foto->url('thumb') }}" width="64px"><br>
			{{ $winner->nombre }}
		@endif
	</div>
	
	<div style="width: 400px;float: left">
		@if($winner)
			<img src="$winner->escudo->url('thumb')" border="0" width="400px">
		@endif
	</div>

	<div style="width: 250px;float: left">
		<img src="images/arrow-down.png"> <strong>Descensos</strong><br>

		<img src="images/s30/nuevachicago.png" width="25px"><br>
		<img src="images/s30/crucerom.png" width="25px"><br>
	</div>
	<div style="clear: both;"></div>
	<br>
</div>
