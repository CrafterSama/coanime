@if (Auth::user()->role_id != 1)
    No tienes Acceso a esta Seccion! <a href="/">Volver al Inicio</a>
@else
<!DOCTYPE html>
<html lang="es">
  <head>
  	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  	<title>@yield('title')</title>
    {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css', array('media'=>'screen')) }}
    {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array('media'=>'screen')) }}
    {{ HTML::style('/../assets/css/normalize.css', array('media'=>'screen')) }}
    {{ HTML::style('/../assets/css/dashboard.css', array('media'=>'screen')) }}
    {{ HTML::style('/../assets/css/table-responsive.css', array('media'=>'screen')) }}
    {{ HTML::style('/../assets/css/bootstrap.css', array('media'=>'screen')) }}
    {{ HTML::style('/../assets/css/bootstrap-wysihtml5.css', array('media'=>'screen')) }}
  </head>
  <body>
  	<header role="banner" class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
          <div class="navbar-header">
            <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-inverse side-collapse in">
            <nav role="navigation" class="navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="/dashboard"><i class="fa fa-rebel"></i> Inicio</a></li>
                <li><a href="/dashboard/enciclopedia"><i class="fa fa-book"></i> Enciclopedia</a></li>
                <li><a href="/dashboard/eventos"><i class="fa fa-group"></i> Eventos</a></li>
                <li><a href="/dashboard/usuarios"><i class="fa fa-users"></i> Usuarios</a></li>
                <li><a href="/dashboard/afiliados"><i class="fa fa-code-fork"></i> Afiliados</a></li>
                <li><a href="/" class="btn"><i class="fa fa-chevron-left"></i> Volver a la Web</a></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="username">{{ Auth::user()->full_name; }}</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li><a href="/dashboard/usuarios/{{ Auth::user()->id }}/perfil"><i class=" fa fa-suitcase"></i> Perfil</a></li>
                        <li><a href="/dashboard/configuracion"><i class="fa fa-cog"></i> Configuracion</a></li>
                        <li><a href="/logout"><i class="fa fa-key"></i> Cerrar Sesion</a></li>
                    </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </header>
      <section>
      
      	@yield('content')
      
      </section>
    <script src="/../assets/js/advance.js"></script>
    <script src="/../assets/js/wysihtml5-0.3.0.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
    <script src="/../assets/js/common.js"></script>
    <script>tinymce.init({selector:'textarea'});</script>
  </body>
</html>
@endif