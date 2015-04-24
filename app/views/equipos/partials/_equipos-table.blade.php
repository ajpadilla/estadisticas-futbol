{{ $table->render() }}
@include('equipos.new')
@include('jugadores.new')

@section('scripts')
	{{ $table->script() }}
@stop