{{ $scriptTableTemplate }}

@if($tableTemplate)
	{{ $table->render($tableTemplate) }}
@else
	{{ $table->render() }}
@endif
