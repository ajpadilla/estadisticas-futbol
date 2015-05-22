{{ $table->render() }}

@if(!isset($scriptTableTemplate))
	@if(!$scriptSection)
		@section('scripts')	
			{{ $table->script() }}
		@stop
	@else
		@section('scripts' . $scriptSection)
			{{ $table->script() }}
		@stop
	@endif
@endif
