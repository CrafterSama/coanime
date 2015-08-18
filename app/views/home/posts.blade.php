@extends('layouts.home')

@section('title','Coanime.net - Tu Fuente de Informacion sobre Manga, Anime, Video Juegos, Tecnologia y Cultura Otaku')   

@section('content')
<aside id="bienvenida">
	@if (Auth::check())
		<h3 class="text-center">Hola {{ ucwords(Auth::user()->username) }}</h3>
		<p id="mensaje_registro">
			Que deseas hacer Hoy?<br />
			<a href="/enciclopedia">Crear Contenido para la Enciclopedia</a><br />
			o<br />
			<a href="/eventos">Agregar un Evento en Tu Ciudad</a>
		</p>
	@else
		<h3 class="text-center">Hola Navegante, Registrate!</h3>
		<p>Si te Registras podras participar en la Web agregando contenido de tu autoria, hagamos la web juntos!</p>
		<a href="/registrarse" id="registrarse" class="btn btn-lg btn-warning btn-block">Registrate Acá!</a>
		<p id="mensaje_registro">
			Animate, queremos conocer mas de ti y tus gustos, Registrate!<br />
			Estas Registrado? <a href="/login" class="btn-link">Ingresa Aqui</a>
		</p>
	@endif
	<div id="social_buttons">
		<a id="twitter" href="http://twitter.com/coanime"></a>
		<a id="facebook" href="http://www.facebook.com/Coanime"></a>
		<a id="gplus" href="http://plus.google.com/114714658140153118922"></a>
		<a id="suscribete" href="#"></a>
	</div>
	<h3 id="titulo_aside">Actividad Reciente</h3>
</aside>
	<section id="contenido">
	@foreach ($posts as $post)
		<article class="post">
			<figure class="post_image_tag">
				<div class="tags_{{ Category::getName($post->category_id) }}"> </div>
			</figure>
			<h2 class="post_title">
				<a href="/posts/{{ $post->id }}/{{ $post->post_slug }}">{{ $post->post_title }}</a>
			</h2>
			<p class="post_autor">
				Por <a href="/usuarios/perfil/{{ $post->user_id }}/{{ strtolower(User::getUsername($post->user_id)) }}">{{ ucwords(User::getUsername($post->user_id)) }}</a>
			</p>
			<hr />
			<p class="post_paragraph text-justify">
				{{ $post->post_intro }}
			</p>
			<hr />
			<p class="post_datos">
				<a class="post_tags {{ Category::getName($post->category_id) }}_tag" href="#">{{ Category::getName($post->category_id) }}</a>
				@if (Auth::check() and Auth::user()->role_id == 1)
					<a href="/dashboard/posts/editar/{{ $post->id }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>					
					<a href="/dashboard/posts/borrar/{{ $post->id }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a> - 
				@endif
				@if (is_null($post->post_created_at))
					<span class="post_date"><strong>{{ Post::getDate(strtotime($post->created_at,0)) }}</strong></span>
				@else
					<span class="post_date"><strong>{{ Post::getDate($post->post_created_at) }}</strong></span>
				@endif
				<a class="post_stars" href="#">355</a>
				<a class="save_stars" href="#"></a>
			</p>
		</article>
	@endforeach
	<div class="text-center">{{ $posts->links() }}</div>
	</section>
@stop			