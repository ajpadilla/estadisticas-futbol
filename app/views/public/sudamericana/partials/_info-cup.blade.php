@if(!empty($sudamericanaCups))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	{{ $sudamericanaCups->links() }}
</div>
@foreach($sudamericanaCups as $sudamericanaCups)
<span class="verdegrande">
	COPA SUDAMERICANA {{ $sudamericanaCups->year }}
</span>
<div style="clear: both;"></div>
<br/>
@if(!empty($winner))
<div style="width: 980px;height: auto;background: #17573d;font-size:12px;color:white;text-align: center;">
	<br>
	Campeón {{ $sudamericanaCups->year }}<br>
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