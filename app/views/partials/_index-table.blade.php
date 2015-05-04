{{ $table->render() }}

@section('scripts')
	{{ $table->script() }}
	@if($indexDatatableColumn)
	<script>{{ $indexDatatableColumn }}</script>
	@endif
@stop