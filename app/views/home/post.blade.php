@extends('layouts.home')

@section('title', $post->post_title )   

@section('content')
	<section id="contenido_post">
		<article class="post">
			<figure class="post_image_tag">
				<div class="tags_{{ Category::getName($post->category_id) }}"> </div>
			</figure>
			<h2 class="post_title">
				{{ $post->post_title }}
			</h2>
			<p class="post_autor">
				Por <a href="/usuarios/perfil/{{ $post->user_id }}/{{ strtolower(User::getUsername($post->user_id)) }}">{{ ucwords(User::getUsername($post->user_id)) }}</a>&nbsp;&nbsp;
				@if (is_null($post->post_created_at))
					<span class="post_date"><strong>{{ Post::getDate(strtotime($post->created_at,0)) }}</strong></span>
				@else
					<span class="post_date"><strong>{{ Post::getDate($post->post_created_at) }}</strong></span>
				@endif
			</p>
			<hr />
			<p class="post_paragraph text-justify">
				{{ $post->post_intro }}
			</p>
			<p class="post_body text-justify">
				{{ $post->post_content }}
			</p>
			<hr />
			<p class="post_datos">
				<a class="btn post_tags {{ Category::getName($post->category_id) }}_tag" href="#"><i class="fa fa-tag"></i>&nbsp;&nbsp;{{ Category::getName($post->category_id) }}</a>
				@if (Auth::check() and Auth::user()->role_id == 1)
					<a href="/dashboard/posts/editar/{{ $post->id }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>					
					<a href="/dashboard/posts/borrar/{{ $post->id }}" class="btn btn-danger"><i class="fa fa-trash-o" onclick="return confirm('¿Esta seguro que desea borrar este Post?');"></i></a>					
				@endif

				<a class="btn post_stars" href="#">355</a>
				<a class="save_stars" href="#"></a>
			</p>
			{{-- <div class="autor row-fluid">
				<div class="autor-box top-radius">
					<span class="autor-avatar span2">
						<img class="img-circle shadow" src="<?php echo $userAvatar; ?>" alt="CrafterSama" />
					</span>
					<span class="autor-name span3">
						<strong class="autor-full-name"><h4><?php echo $userName.' '.$userLast; ?></h4></strong><br>
						<span><a rel="" href="<?php echo $profileTwitter ?>"><?php echo '@'.$userTwitter; ?></a></span>
					</span>
					<span class="autor-about text-justify span7">
						<?php echo $userAbout; ?>
					</span>
				</div>
				<div class="autor-box-footer bottom-radius text-right">
					<?php if (!empty($userUrl)){ ?>
						<span class="wb-button"><a href="<?php echo $userUrl; ?>" class="btn-social btn-social-small btn-web">Web</a></span>
					<?php }else{} ?>
					<?php if (!empty($userTwitter)){ ?>
						<span class="tt-button"><a href="<?php echo $profileTwitter; ?>" class="btn-social btn-twitter btn-social-small">@<?php echo $userTwitter; ?></a></span>
					<?php }else{} ?>
					<?php if (!empty($userTumblr)){ ?>
						<span class="tb-button"><a href="<?php echo $webTumblr; ?>" class="btn-social btn-tumblr btn-social-small"><?php echo $userTumblr; ?></a></span>
					<?php }else{} ?>
					<?php if (!empty($userFacebook)){ ?>
						<span class="fb-button"><a href="<?php echo $profileFacebook; ?>" class="btn-social btn-facebook btn-social-small"><?php echo $userFacebook; ?></a></span>
					<?php }else{} ?>
					<?php if (!empty($userGplus)){ ?>
					<span class="gp-button"><a href="<?php echo $userGplus; ?>" class="btn-social btn-gplus btn-social-small"><?php echo $userName.' '.$userLast; ?></a></span>
					<?php }else{} ?>
					<?php if (!empty($userPinterest)){ ?>
					<span class="pt-button"><a href="<?php echo $userPinterest; ?>" class="btn-social btn-pinterest btn-social-small"><?php echo $userName.' '.$userLast; ?></a></span>
					<?php }else{} ?>
				</div>
			</div> --}}
			<div class="autor-perfil over">
				<div class="avatar">
					<a href="" title="Más artículos de {{ $user->full_name }}" rel="nofollow">
						<img src="/../assets/img/avatars/{{ $user->user_image }}" class="avatar img-thumbnail user-{{ $user->id }}-avatar avatar-100 photo" alt="Imagen de avatar" height="100" width="100">
					</a>
				</div>
				<h3 class="subtituloGeneral">
					<a href="#" title="" rel="nofollow">{{ $user->full_name }}</a>
				</h3>
				<div class="descripcion">
					{{ $user->biography }}
				</div>
				<div class="social over">
					<a href="http://twitter.com/{{ $user->twitter }}" class="twitter" rel="nofollow">Twitter</a>
					<a href="http://facebook.com/{{ $user->facebook }}" class="facebook" rel="nofollow"> Facebook</a>
					<a href="http://plus.google.com/{{ $user->googleplus }}" class="gplus" rel="me">Google+</a>
					<a href="/perfil/users/{{ $user->id }}" title="Perfil en Conanime" class="perfil" rel="nofollow"><span>Perfil en Coanime</span></a>		
				</div>
			</div>
		</article>
		<article class="post">
			<div id="disqus_thread"></div>
			<script type="text/javascript">
				/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
				var disqus_shortname = 'coanimenet'; // required: replace example with your forum shortname

				/* * * DON'T EDIT BELOW THIS LINE * * */
				(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
				})();
			</script>
			<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
			<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
		</article>
	</section>
@stop