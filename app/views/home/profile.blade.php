@extends('layouts.home')

@section('title') Perfil de {{ $user->full_name }} - Coanime.net  @stop

@section('content')

	<section id="contenido_post">
		<article class="user-profile radius">
			<header class="header-profile">
				<div class="title-profile pull-left"><h3>Perfil de {{ $user->full_name }}</h3></div>
				<span class="button pull-right"><a class="btn btn-warning" href="/usuario/editar/{{ $user->id }}"><i class="fa fa-edit"></i>&nbsp;&nbsp;Editar Perfil</a></span>
			</header>
			<br />
			<br />
			<br />
			<div class="body-profile">
				<div class="avatar-profile text-center">
					<figure class="avatar-image">
						<img src="/../assets/img/avatars/{{ $user->user_image }}" alt="{{ $user->username }}" width="200px" class="img-thumbnail img-circle">
					</figure>
				</div>
				<div class="biography-profile">
					<fieldset class="radius">
						<legend class="radius"><strong>Bio :</strong> </legend>
						<p class="fieldset"><i style="color:gray; font-size:1.5em;" class="fa fa-quote-left pull-left"></i><i class="fa fa-qoute-right pull-right"></i>&nbsp;&nbsp;{{ $user->biography }}&nbsp;&nbsp;</p>
					</fieldset>
					<div class="register-date radius">
						<strong>Registro:</strong> {{ Post::getDate(strtotime($user->created_at,0)) }}
					</div>
					<div class="register-date radius">
						<strong>Post Publicados:</strong> {{ $count }}
					</div>
				</div>
				<br />
				<div class="title-profile"><h3>Links Sociales</h3></div>
				<hr />
				<br />
				<div class="social-profile">
					<div class="social-block">
						<a href="http://twitter.com/{{ $user->twitter }}" class="btn social-link twitter radius" rel="nofollow"><i style="font-size:1.5em;" class="fa fa-twitter"></i>&nbsp;&nbsp;{{ $user->twitter }}</a>
					</div>
					<div class="social-block">
						<a href="http://facebook.com/{{ $user->facebook }}" class="btn social-link facebook radius" rel="nofollow"><i style="font-size:1.5em;" class="fa fa-facebook"></i>&nbsp;&nbsp;{{ $user->facebook }}</a>
					</div>
					<div class="social-block">
						<a href="http://instagram.com/{{ $user->instagram }}" class="btn social-link instagram radius" rel="nofollow"><i style="font-size:1.5em;" class="fa fa-instagram"></i>&nbsp;&nbsp;{{ $user->instagram }}</a>
					</div>
					<div class="social-block">
						<a href="http://plus.google.com/{{ $user->googleplus }}" class="btn social-link googleplus radius" rel="nofollow"><i style="font-size:1.5em;" class="fa fa-google-plus"></i>&nbsp;&nbsp;{{ $user->googleplus }}</a>
					</div>
					<div class="social-block">
						<a href="http://pinterest.com/{{ $user->pinterest }}" class="btn social-link pinterest radius" rel="nofollow"><i style="font-size:1.5em;" class="fa fa-pinterest"></i>&nbsp;&nbsp;{{ $user->pinterest }}</a>
					</div>
					<div class="social-block">
						<a href="http://{{ $user->tumblr }}.tumblr.com/" class="btn social-link tumblr radius" rel="nofollow"><i style="font-size:1.5em;" class="fa fa-tumblr"></i>&nbsp;&nbsp;{{ $user->tumblr }}</a>
					</div>
				</div>
			</div>
			</header>
		</article>
	</section>

@stop