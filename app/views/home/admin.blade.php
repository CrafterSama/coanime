@extends('layouts.home')

@section('title', $post->post_title )   

@section('content')

<br />
<br />
  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="form-signin-heading text-center">Inicio de Sesion</h2>
        {{-- Preguntamos si hay algún mensaje de error y si hay lo mostramos  --}}
        @if(Session::has('mensaje_error'))
            <br />
            <div class="alert alert-danger">{{ Session::get('mensaje_error') }}</div>
        @endif
      </div>
      <div class="panel-body">
        {{ Form::open(array('url' => '/login','class' => 'form-signin')) }}
            <div class="form-group">
              <input class="form-control" placeholder="Usuario" name="username" type="text">
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Contraseña" name="password" type="password">
            </div>
            <div class="checkbox">
              <label>
                <input name="remember" type="checkbox" value="Remember Me"> Remember Me
              </label>
            </div>
            <button type="submit" class="btn btn-lg btn-warning btn-block">Iniciar Sesión</button>
            <span class="login text-center">No Estas Registrado? <a class="btn-link" href="/registrarse">Ingresa Aqui</a></span>
        {{ Form::close() }}
      </div>
    </div>
  </div>

@stop