<span class="verdegrande">
	<!--<div style="float: left;width:225px;color: white;font-size:12px">
		Anterior<br>
		<a href="transicion2014.php" style="font-size: 14px;">Torneo Transición 2014</a>
	</div>-->
	<div>
		{{ $competitions->links() }}
	</div>
	@foreach($competitions as $competition)
		<div style="float: left;width:500px;text-align: center;margin: auto">
			{{ $competition->nombre }}
			<br style="clear: both;">
		</div>
	@endforeach
	<div style="clear: both;"></div>
</span>
