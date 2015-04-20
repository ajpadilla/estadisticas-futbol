{{ $table->render() }}
@include('jugadores.new')
@include('jugadores.view')
@include('jugadores.partials._form_view-template')	

@section('scripts')
	{{ $table->script() }}
@stop