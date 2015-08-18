@extends('layouts.dashboard')

@section('title','Opciones para Usuarios - Coanime.net')   

@section('content')

    <section class="row">
      <div id="contenido">
      <section class="container">
        @if(Session::has('notice'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('notice') }}
          </div>
          <br>
        @endif
        <article class="post">
          <h3>Administracion de Usuarios</h3>
          <div class="alert alert-info">
            A continuacion tiene los post ordenados desde el mas nuevo al mas viejo, cuenta tambien con una serie de opciones para aplicarlos a cada post.
          </div>
          <div><a href="/dashboard/usuarios/agregar" class="btn btn-warning btn-xs pull-right"><i class="fa fa-plus"></i> Agregar Usuario</a></div>
          <br />
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" id="indexTabs">
            <li class="active"><a href="#activos" data-toggle="tab">Activos</a></li>
            <li><a href="#baneados" data-toggle="tab">Baneados</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="activos">
              <br />
              <section id="no-more-tables">
                <table class="table table-hover table-condensed table-stripped">
                  <thead>
                    <tr>
                      <th class="text-center">Usuario</th>
                      <th class="text-center">Rol</th>
                      <th class="text-center">Fecha de Registro</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
  	                @foreach ($users as $user)
                      <tr>
                        <td class="text-left" data-title="Titulo">
                          <?php //var_dump(Post::getImage($post->post_intro)); ?>
                           <img src="/../assets/img/avatars/{{ $user->user_image }}" alt="{{ $user->username }}" width="100px" class="img-thumbnail" />
                          <a href="/dashboard/usuarios/perfil/{{ $user->id }}/{{ $user->username }}" class="btn-link">{{ $user->full_name }}</a>
                        </td>
                        <td class="text-center" data-title="Rol">{{ Role::getName($user->role_id) }}</td>
                        <td class="text-center" data-title="Fecha">
							<span class="post_date"><strong>{{ Post::getDate(strtotime($user->created_at,0)) }}</strong></span>
                        </td>
                        <td class="text-center" data-title="Acciones">
                          <a href="/dashboard/usuarios/perfil/{{ $user->id }}" class="btn btn-info btn-xs"><i class="fa fa-user"></i> Perfil</a>
                          <a href="/dashboard/usuarios/editar/{{ $user->id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Editar</a>
                          <a href="/dashboard/usuarios/borrar/{{ $user->id }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar</a>
                          <a href="/dashboard/usuarios/banear/{{ $user->id }}" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i> Banear</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <span class="text-center">{{ $users->links() }}</span>
              </section>
            </div>
            <div class="tab-pane" id="baneados">
              <br />
            	<section id="no-more-tables">
	                <table class="table table-hover table-condensed table-stripped">
	                  <thead>
	                    <tr>
	                      <th class="text-center">Usuario</th>
	                      <th class="text-center">Rol</th>
	                      <th class="text-center">Fecha de Registro</th>
	                      <th class="text-center">Fecha de Baneo</th>
	                      <th class="text-center">Acciones</th>
	                    </tr>
	                  </thead>
	                  <tbody>
	  	                @foreach ($bUsers as $bUser)
	                      <tr>
	                        <td class="text-left" data-title="Titulo">
	                          <?php //var_dump(Post::getImage($post->post_intro)); ?>
	                           <img src="/../assets/img/avatars/{{ $bUser->user_image }}" alt="{{ $bUser->username }}" width="100px" class="img-thumbnail" />
	                          <a href="/dashboard/usuarios/perfil/{{ $bUser->id }}/{{ $bUser->username }}" class="btn-link">{{ $bUser->full_name }}</a>
	                        </td>
	                        <td class="text-center" data-title="Rol">{{ Role::getName($bUser->role_id) }}</td>
	                        <td class="text-center" data-title="Registro">
								<span class="post_date"><strong>{{ Post::getDate(strtotime($bUser->created_at,0)) }}</strong></span>
	                        </td>
	                        <td class="text-center" data-title="Baneo">
								<span class="post_date"><strong>{{ Post::getDate(strtotime($bUser->deleted_at,0)) }}</strong></span>
	                        </td>
	                        <td class="text-center" data-title="Acciones">
	                          <a href="/dashboard/usuarios/restaurar/{{ $bUser->id }}" class="btn btn-success btn-xs"><i class="fa fa-undo"></i> Restaurar</a>
	                          <a href="/dashboard/usuarios/perfil/{{ $bUser->id }}" class="btn btn-info btn-xs"><i class="fa fa-user"></i> Perfil</a>
	                          <a href="/dashboard/usuarios/editar/{{ $bUser->id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Editar</a>
	                          <a href="/dashboard/usuarios/borrar/{{ $bUser->id }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar</a>
	                        </td>
	                      </tr>
	                    @endforeach
	                  </tbody>
	                </table>
	                <span class="text-center">{{ $users->links() }}</span>
              	</section>
            </div>
          </div>
        </article>
      </section>
      </div>
    </section>

@stop