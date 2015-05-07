{{ $table->render() }}
@include('players.new')
@include('players.view')
@include('players.partials._form_view-template')	

@section('scripts')
	{{ $table->script() }}
@stop