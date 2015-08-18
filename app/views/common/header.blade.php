		<figure id="logo">
			<img src="/../assets/img/logo_old.png" alt="" />
		</figure>
		<figure id="user_avatar">
			@if (Auth::check())
				<a href="#">
					<img src="/../assets/img/avatars/{{ Auth::user()->user_image }}" alt="" class="visible-lg" />
				</a>
				<figcaption id="options">
					<ul class="nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ ucwords(Auth::user()->username) }} <i class="fa fa-caret-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="/usuarios/perfil/{{ Auth::user()->id }}/{{ Auth::user()->username }}">Perfil <i class="fa fa-user"></i></a></li>
								<li><a href="/editar-perfil">Editar Perfil <i class="fa fa-edit"></i></a></li>
								<li><a href="/logout">Cerrar Sesión <i class="fa fa-sign-out"></i></a></li>
							</ul>
						</li>
					</ul>
				</figcaption>
			@else
				<a href="#"><img src="/../assets/img/avatars/avatar.png" alt="" />
				</a>
				<figcaption id="options">
					<ul class="nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-caret-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="/login">Iniciar Sesión <i class="fa fa-sign-in"></i></a></li>
							</ul>
						</li>
					</ul>
				</figcaption>
			@endif
		</figure>