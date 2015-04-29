{{ $table->render() }}
@include('equipos.new')
@include('jugadores.new')
@include('paises.new')
@include('paises.view')
@include('posiciones.new')
@include('tipos-competencia.new')
@section('scripts')
	{{ $table->script() }}
@stop