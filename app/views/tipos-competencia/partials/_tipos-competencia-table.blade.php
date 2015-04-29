{{ $table->render() }}
@include('equipos.new')
@include('jugadores.new')
@include('tipos-competencia.new')
@section('scripts')
	{{ $table->script() }}
@stop