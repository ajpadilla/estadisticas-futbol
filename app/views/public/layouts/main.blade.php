<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="NIGHTZPY" /> 
	<title>Estadísticas Fútbol</title>
          
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="image_src" href="logo_social_kb.jpg" />
    <meta name="keywords" content="futbol argentino, apertura 2011, futbol en vivo, futbol online, river plate, boca juniors, independiente, san lorenzo, descenso, posiciones, promedios, promiedos, fixture, tabla de descenso, b nacional, promociones, copa libertadores, copa sudamericana" />
    <meta name="description" content="La pagina mas completa del FUTBOL ARGENTINO. Tabla de posiciones, Copas, Copa Libertadores, Apertura 2011, descensos, promociones" />      

    {{-- CSS --}}
	@include('public.layouts.partials._css')
</head>
<body>
	<div id="somediv" style="display: none;"></div>
	<div id="contenido">		
		@include('public.layouts.partials._header')		
		@yield('content')
		<div style="clear: both;"><br/></div>
		<br/>
		<br/>
		<div style="clear: both;"><br/></div>
	</div>
	@include('public.layouts.partials._footer')
	{{-- JAVASCRIPT --}}
	@include('public.layouts.partials._js')	
</body>
</html>