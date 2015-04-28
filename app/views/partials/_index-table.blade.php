{{ $table->render() }}
@include('equipos.new')
@include('jugadores.new')
@include('paises.new')
@include('paises.view')
@include('posiciones.new')

@section('scripts')
	{{ $table->script() }}
@stop