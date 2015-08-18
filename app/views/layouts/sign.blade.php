<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>@yield('title')</title>
	{{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css', array('media'=>'screen')) }}
	{{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array('media'=>'screen')) }}
	{{ HTML::style('/../assets/css/normalize.css', array('media'=>'screen')) }}
	{{ HTML::style('/../assets/css/estilo.css', array('media'=>'screen')) }}
	{{ HTML::style('/../assets/css/bootstrap.css', array('media'=>'screen')) }}
	{{ HTML::style('/../assets/css/responsive.css', array('media'=>'screen')) }}
</head>
<body>

	@yield('content')
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="/../assets/js/commons.js"></script>
</body>
</html>