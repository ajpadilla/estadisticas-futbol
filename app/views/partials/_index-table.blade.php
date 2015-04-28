{{ $table->render() }}
@include('equipos.new')
@include('jugadores.new')
@include('paises.new')
@include('paises.view')

@section('scripts')
	{{ $table->script() }}
@stop