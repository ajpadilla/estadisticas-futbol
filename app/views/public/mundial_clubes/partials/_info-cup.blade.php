@if($mundialClubesCups)
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	 {{ $mundialClubesCups->links() }} 
</div>
<span class="verdegrande">
<div style="width:500px;text-align: center;margin: auto">
	MUNDIAL DE CLUBES {{ $currentCup->year }}
	<br style="clear: both;">
</div>

<div style="clear: both;"></div>
</span>
<br>
<br style="clear: both;">
<?php 
	if(!empty($currentCup->hasPhases))
		$firstPhase = $currentCup->phases->first();
	if(!empty($firstPhase))
		$groupsForfirstPhase = $firstPhase->groups;
?>
@if(!empty($groupsForfirstPhase))
@foreach($groupsForfirstPhase as $group)
@foreach($group->teams as $team)
<div style="width: 138px;float: left;text-align:center">
	<!--<span class="datosequipo2">Campeón Champions<br> League 2013/14</span><br>-->
	<img src="{{ $team->escudo->url('thumb') }}"><br>
	<span class="datosequipo2"><img src="" title="{{ $team->nombre }}" alt="{{ $team->nombre }}">{{ $team->nombre }}</span>
</div>
@endforeach
@endforeach
@endif
<div style="clear: both;"></div>
<br/>
<div align="center" style="width: 728px;margin-top:10px;margin-bottom: 10px">
	<script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- 970x90 -->
	<ins class="adsbygoogle" style="display:inline-block;width:970px;height:90px" data-ad-client="ca-pub-4253255337568552" data-ad-slot="7097114614"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>
<div style="clear: both;"></div>
<br>
@if(!empty($winner))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	<br>
	Campeón {{ $currentCup->year }}<br>
	<img src="{{ $winner->escudo->url('thumb') }}" width="50" height="50"><br>
	<img src="{{ $winner->escudo->url('thumb') }}"> {{ $winner->nombre }}
	<br>
@endif
@endif