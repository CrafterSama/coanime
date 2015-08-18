@extends('layouts.sign')

@section('title','Coanime.net - Formulario de Registro')   

@section('content')
<br />
<br />
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
		<div class="panel-heading">
	        <h2 class="form-signin-heading text-center">Registrarse</h2>
            @if(Session::has('notice'))
                <div class="alert alert-success">{{ Session::get('notice') }}</div>
                <br>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                <br>
            @endif
    	</div>
	    <div class="panel-body">
	        {{ Form::open(array('url' => '/registrarse','class' => 'form-signin')) }}
	            <p>Ingresa tus Datos a Continuación</p>
	            <div class="form-group">
	            	{{ Form::text('full_name', Input::old('full_name'), array('class' => 'form-control','placeholder' => 'Nombre Completo')); }}
	            </div>
	            <div class="form-group">
	            	{{ Form::email('email', Input::old('email'), array('class' => 'form-control','placeholder' => 'Correo Electronico')); }}
	            </div>
	            <p> Ingresa los detalles para tu Cuenta</p>
	            <div class="form-group">
	            	{{ Form::text('username', Input::old('username'), array('class' => 'form-control','placeholder' => 'Usuario')); }}
	            </div>
	            <div class="form-group">
	            	{{ Form::password('password', array('class' => 'form-control','placeholder' => 'Contraseña')); }}
	            </div>
	            <div class="form-group">
	            	{{ Form::password('password_confirmation', array('class' => 'form-control','placeholder' => 'Re-ingresa Contraseña')); }}
	            </div>
	            <button class="btn btn-lg btn-warning btn-block" type="submit">Registrarse</button>
	            <span class="registration text-center">Estas Registrado? <a class="btn-link" href="/login">Ingresa Aqui</a></span>
	    	{{ Form::close() }}
    	</div>
	</div>
</div>
@stop