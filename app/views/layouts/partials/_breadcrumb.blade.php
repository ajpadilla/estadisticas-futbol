<!-- BREADCRUMBS -->
{{--<ul class="breadcrumb">
	<li>
		<i class="fa fa-home"></i>
		<a href="{{ route('pages.home') }}">Inicio</a>
	</li>
	@foreach($urlSegments as $segment)
	<li>
		<a href="">{{ ucfirst($segment) }}</a>
	</li>
	@endforeach
</ul>--}}

{{ $breadcrumbs }}
<!-- /BREADCRUMBS -->