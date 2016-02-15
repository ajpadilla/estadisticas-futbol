@if(!empty($argentinaCups))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	{{ $argentinaCups->links() }}
</div>
@foreach($argentinaCups as $argentinaCup)
<span class="verdegrande">
	COPA ARGENTINA  {{$argentinaCup->year}}
</span>
<div style="clear: both;"></div>
<br/>
@if(!empty($winner))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	<br>
	Campeón {{ $argentinaCup->year }}<br>
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