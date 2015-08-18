@extends('layouts.dashboard')

<?php

    if ($post->exists):
        $form_data = array('url' => '/dashboard/posts/editar/'.$post->id.'', 'method' => 'POST');
        $action    = 'Editar';
    else:
        $form_data = array('url' => '/dashboard/posts/agregar','role'=>'form', 'method' => 'POST');
        $action    = 'Agregar';        
    endif;

?>

@section('title') Formulario para {{ $action }} un Post  - Coanime.net @stop  

@section('content')
    <section class="row">
      <div id="contenido">
      <section class="container">
        <article class="post">
	<h1>{{ $action }} Posts</h1>
	<div class="alert alert-info">
		Formulario para {{ strtolower($action) }} los Posts en el sistema. 
	</div>
	<br>
	<section class="panel">
		<header class="panel-heading">
			<a href="/dashboard" class="btn btn-info"><i class="fa fa-chevron-left"></i> Volver</a>	
		</header>
		<div class="panel-body">
			<section id="{{ strtolower($action) }}_modelos">
				{{ Form::model($post, $form_data, array('role' => 'form')) }}
					@include ('common/errors', array('errors' => $errors))
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('post_title', 'Titulo del Post') }}
								{{ Form::text('post_title', null, array('placeholder'=>'Titulo del Post','class'=>'form-control', 'required'=>'')) }}
							</div> 
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('category_id', 'Categoria del Post') }}
								{{ Form::select('category_id', $opciones, $post->category_id, array('class'=>'form-control')) }}
							</div>
						</div>
						<div class="col-md-12">
							<!-- div class="alert alert-info"><a href="http://images.coanime.net" target="_blank">
								<strong>Click Aca</strong></a> para Subir Imagenes a Nuestro Hosting de Imagenes</div>
							<div class="form-group" -->
								{{ Form::label('post_intro', 'Introduccón del Post') }}
								{{ Form::textarea('post_intro', null, array('id'=>'introduccion','placeholder'=>'Introduccion del Post','class'=>'textarea form-control', 'required'=>'')) }}
							</div>
							<div class="form-group">
								{{ Form::label('post_content', 'Resto del Contenido') }}
								{{ Form::textarea('post_content', null, array('id'=>'contenido','placeholder'=>'Contenido del Post','class'=>'textarea form-control', 'required'=>'')) }}
							</div>
						</div>
					</div>
					{{ Form::submit('Guardar', array('class'=>'btn btn-warning btn-block')) }}
				{{ Form::close() }}
			</section>
		</div>
	</section>
        </article>
      </section>
      </div>
    </section>
@stop