<!DOCTYPE html>
<html lang="es">

	<head>

		@include('common.head')

	</head>

	<body>
		
		<header class="header_banner">
		
			@include('common.header')
		
		</header>
		
		<section id="wrapper">
			
			<div role="banner" class="navbar navbar-inverse">
		
				@include('common.nav')

			</div>
			
			@yield('content')
		
		</section>
		
		<footer>

			@include('common.footer')
		
		</footer>
		
		@include('common.scripts')

	</body>

</html>