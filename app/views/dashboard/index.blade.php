@extends('layouts.dashboard')

@section('title','Panel de Administracion - Coanime.net')   

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
          <h3>Administracion de los Posts</h3>
          <div class="alert alert-info">
            A continuacion tiene los post ordenados desde el mas nuevo al mas viejo, cuenta tambien con una serie de opciones para aplicarlos a cada post.
          </div>
          <div><a href="/dashboard/posts/agregar" class="btn btn-warning pull-right"><i class="fa fa-plus"></i> Agregar Post</a></div>
          <br />
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" id="indexTabs">
            <li class="active"><a href="#posts" data-toggle="tab">Posts</a></li>
            <li><a href="#borradores" data-toggle="tab">Borradores</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="posts">
              <br />
              <section id="no-more-tables">
                <table class="table table-hover table-condensed table-stripped">
                  <thead>
                    <tr>
                      <th class="text-center">Titulo</th>
                      <th class="text-center">Categoria</th>
                      <th class="text-center">Fecha de Publicacion</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($posts as $post)
                      <tr>
                        <td class="text-left" data-title="Titulo">
                          <?php //var_dump(Post::getImage($post->post_intro)); ?>
                           <img src="{{ Post::getImage($post->post_intro) }}" alt="{{ $post->post_title }}" width="100px" class="img-thumbnail" />
                          <a href="/posts/{{ $post->id }}/{{ $post->post_slug }}" class="btn-link">{{ $post->post_title }}</a>
                        </td>
                        <td class="text-center" data-title="Categoria">{{ Category::getName($post->category_id) }}</td>
                        <td class="text-center" data-title="Fecha">
                          @if (is_null($post->post_created_at))
                            <span class="post_date"><strong>{{ Post::getDate(strtotime($post->created_at,0)) }}</strong></span>
                          @else
                            <span class="post_date"><strong>{{ Post::getDate($post->post_created_at) }}</strong></span>
                          @endif
                        </td>
                        <td class="text-center" data-title="Acciones">
                          <a href="/dashboard/posts/editar/{{ $post->id }}" class="btn btn-info"><i class="fa fa-edit"></i> Editar</a>
                          <a href="/dashboard/posts/borrar/{{ $post->id }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Borrar</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <span class="text-center">{{ $posts->links() }}</span>
              </section>
            </div>
            <div class="tab-pane" id="borradores">
              <br />
              <section id="no-more-tables">
                <table class="table table-rounded table-striped table-condensed cf">
                  <thead class="cf">
                    <tr>
                      <th>Titulo</th>
                      <th>Categoria</th>
                      <th>Fecha de Publicacion</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($drafts as $draft)
                      <tr>
                        <td data-title="Titulo"><img src="{{ Post::getImage($draft->post_intro) }}" alt="{{ $draft->post_title }}" width="100px" class="pull-left img-thumbnail"> {{ $draft->post_title }}</td>
                        <td data-title="Categoria">{{ Category::getName($draft->category_id) }}</td>
                        <td data-title="Fecha">
                          @if (is_null($draft->post_created_at))
                            <span class="post_date"><strong>{{ Post::getDate(strtotime($draft->created_at,0)) }}</strong></span>
                          @else
                            <span class="post_date"><strong>{{ Post::getDate($draft->post_created_at) }}</strong></span>
                          @endif
                        </td>
                        <td data-title="Acciones">
                          <a href="/dashboard/posts/aprobar/{{ $draft->id }}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Aprobar</a>
                          <a href="/dashboard/posts/editar/{{ $draft->id }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Editar</a>
                          <a href="/dashboard/posts/borrar/{{ $draft->id }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <span class="text-center">{{ $drafts->links() }}</span>
              </section>
            </div>
          </div>
        </article>
      </section>
      </div>
    </section>

@stop