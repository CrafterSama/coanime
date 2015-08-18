<?php

class PostsController extends BaseController {

	private $autorizado;

	public $opciones;
	
	public function __construct() {
		$this->autorizado = (Auth::check() and Auth::user()->role_id == 1);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::orderBy('id', 'desc')
					->where('post_approved','=','yes')
					->paginate(5);
		return View::make('home.posts')->with('posts',$posts);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$categories = Category::all();
		$post = new Post();
		$opciones = array();
		foreach ($categories as $category) {
			$opciones[$category->id] = $category->name;
		}		
		return View::make('posts.form')->with(['post' => $post,'categories' => $categories,'opciones' => $opciones]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$post = new Post();
		$post->user_id = Auth::user()->id;
		$post->category_id = Input::get('category_id');
		$post->post_title = Input::get('post_title');
		$post->post_intro = Input::get('post_intro');
		$post->post_content = Input::get('post_content');
		$post->post_slug = Post::makeSlug(Input::get('post_title'));
		$post->post_approved = 'no';
		$validator = Post::validate(array(
			'category_id' => Input::get('category_id'),
			'post_title' => Input::get('post_title'),
			'post_intro' => Input::get('post_intro'),
			'post_content' => Input::get('post_content')
		));
		if($validator->fails()){
			$errors = $validator->messages()->all();
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$post->save();
			return Redirect::to('/dashboard')->with('notice', 'El Post ha sido creado correctamente.');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id,$title=null)
	{
		$post = Post::find($id);
		$user = User::find($post->user_id);
		//print_r($user);
		/*$post = Response::json($post);
		var_dump($post);*/
		return View::make('home.post')->with(['post' => $post, 'user' => $user]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$post = Post::find($id);
		$categories = Category::all();
		if (is_null ($post))
		{
			App::abort(404);
		}
		$opciones = array();
		foreach ($categories as $category) {
			$opciones[$category->id] = $category->name;
		}
		return View::make('posts.form')->with(['post'=>$post, 'categories'=>$categories,'opciones'=> $opciones]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$post = Post::find($id);
		$post->user_id = $post->user_id;
		$post->category_id = Input::get('category_id');
		$post->post_title = Input::get('post_title');
		$post->post_intro = Input::get('post_intro');
		$post->post_content = Input::get('post_content');
		$post->post_slug = Post::makeSlug(Input::get('post_title'));
		$post->post_approved = $post->post_approved;
		$validator = Post::validate(array(
			'category_id' => Input::get('category_id'),
			'post_title' => Input::get('post_title'),
			'post_intro' => Input::get('post_intro'),
			'post_content' => Input::get('post_content')
		));
		if($validator->fails()){
			$errors = $validator->messages()->all();
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$post->save();
			return Redirect::to('/dashboard')->with('notice', 'El Post ha sido Editado correctamente.');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	public function approvePost($id)
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$post = Post::find($id);
		//print_r($post);
		$post->post_approved = 'yes';
		if($post->save())
		{
		//print_r($post);
			return Redirect::to('/dashboard')->with('notice', 'El Post ha Publicado Correctamente.');
		}
		else
		{
			return Redirect::to('/dashboard')->with('notice', 'No se Pudo publicar el Post');
		}
	}

	/*public function slugToAll()
	{
		$posts = Post::all();
		foreach ($posts as $post) {
			$post->post_slug = Post::makeSlug($post->post_title);
			$post->save();
		}
		return Redirect::to('/dashboard')->with('notice', 'Se ha Creado el Slug de todos los Posts');
	}*/


}
