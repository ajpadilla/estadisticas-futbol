<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>@yield("title")</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="Presentatenlaweb">
	@include("layouts.partials._css")
</head>
<body>
	@include("layouts.partials._header")
	
	<!-- PAGE -->
	<section id="page">
		@include("layouts.partials._sidebar")
		<div id="main-content">
			<div class="container">
				<div class="row">
					<div id="content" class="col-lg-12">
						@include("layouts.partials._page-header")						
						<div class="row">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/PAGE -->
	@include("layouts.partials._js")
</body>
</html>