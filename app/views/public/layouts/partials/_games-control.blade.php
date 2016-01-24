<span class="verdegrande">

	@if(!empty($showTomorrow) && $showTomorrow)
		<div style="float: left;width:225px;color: white;font-size:12px">
			<br>
			<a href="{{ route('public.home') }}" style="font-size: 14px;">Hoy</a>
		</div>
		<div style="float: left;width:500px;text-align: center;margin: auto">
		PARTIDOS DE MAÑANA<br><span style="font-size: 10px;">Los partidos se actualizan automaticamente!</span><br style="clear: both;">
		</div>
	@endif
	
	@if(!empty($showToday) && $showToday)
		<div style="float: left;width:225px;color: white;font-size:12px">
			<br>
			<a href="{{ route('gamesforday','yesterday') }}" style="font-size: 14px;">Ayer</a>
		</div>
		<div style="float: left;width:500px;text-align: center;margin: auto">
			PARTIDOS DE HOY<br><span style="font-size: 10px;">Los partidos se actualizan automaticamente!</span><br style="clear: both;">
		</div>
		<div style="float: left;width:225px;color: white;font-size:12px">
			<br>
			<a href="{{ route('gamesforday','tomorrow') }}" style="font-size: 14px;">Mañana</a>
		</div>
	@endif
	
	@if(!empty($showYesterday) && $showYesterday)
		<div style="float: left;width:225px;color: white;font-size:12px">
			<br>
		</div>
		<div style="float: left;width:500px;text-align: center;margin: auto">
		PARTIDOS DE AYER<br><span style="font-size: 10px;">Los partidos se actualizan automaticamente!</span><br style="clear: both;">
		</div>
		<div style="float: left;width:225px;color: white;font-size:12px">
			<br>
			<a href="{{ route('public.home') }}" style="font-size: 14px;">Hoy</a>
		</div>
	@endif

	<div style="clear: both;"></div>
</span>