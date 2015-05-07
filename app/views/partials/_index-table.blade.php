{{ $table->render() }}

@if(!$scriptTableTemplate)
	@section('scripts')	
		{{ $table->script() }}
	@stop
@endif
