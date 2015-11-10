@extends("public.layouts.main")

@section("content")
@foreach($data as $d)
	<br>
	<pre>
	{{ print_r($d) }}
	</pre>
@endforeach
@stop