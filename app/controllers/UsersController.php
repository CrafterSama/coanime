<?php

class UsersController extends BaseController {

	private $autorizado;
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
		if(!$this->autorizado) return Redirect::to('/login');
		$users  = 	User::orderBy('id','desc')
						->paginate(10);
		$roles 	= 	Role::all();
		if(is_null($users))
		{
			return View::make('home.users');
		}
		else
		{
			return View::make('home.users')->with(['users' => $users, 'roles' => $roles]);
		}		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$user = new User();
		return View::make('users.form')->with('user', $user);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!$this->autorizado) return Redirect::to('/login');
		$user = new User();
		$user->full_name = Input::get('full_name');
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->role_id = Input::get('role_id');
		/*$user->active = true;*/
		$validator = User::validate(array(
			'full_name' => Input::get('full_name'),
			'username' => Input::get('username'),
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'role_id' => Input::get('role_id'),
		));
		if($validator->fails()){
			$errors = $validator->messages()->all();
			$user->password = null;
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$user->save();
			return Redirect::to('dashboard/usuarios')->with('notice', 'El usuario ha sido creado correctamente.');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user 	= 	User::find(Auth::user()->id);
		$idRol 	= 	$user->role_id;
		$rol 	= 	Role::find($idRol);
		return View::make('users.profile')->with('user', $user)->with('rol', $rol);
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
		$user = User::find($id);
		if (is_null ($user))
		{
			App::abort(404);
		}
		return View::make('users.form')->with('user', $user);
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
		$user = User::find($id);
		$user->full_name = Input::get('full_name');
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->role_id = Input::get('role_id');
		if(is_null(Input::get('password')))
		{
			$password = $user->password;

		}
		else
		{
			$password = Hash::make(Input::get('password'));
		}
		$user->password = $password;
		$validator = User::validate(array(
			'full_name' => Input::get('full_name'),
			'username' => Input::get('username'),
			'email' => Input::get('email'),
			'password' => $password,				
			'role_id' => Input::get('role_id'), 
		), $user->id);
		if($validator->fails()){
			$errors = $validator->messages()->all();
			$user->password = null;
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$user->save();
			return Redirect::to('dashboard/usuarios')->with('notice', 'El usuario ha sido modificado correctamente.');
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
		if(!$this->autorizado) return Redirect::to('/login');
		$user = User::find($id);
		if ($user->id == Auth::user()->id) 
		{
			return Redirect::to('dashboard/usuarios')->with('notice', 'No puedes borrar tu propio usuario.');
		} 
		else 
		{
			if (is_null($user))
			{
				App::abort(404);
			}
		
			$user->forceDelete();
			
			if (Request::ajax())
			{
				return Response::json(array(
					'success' => true,
					'msg'	 => 'Usuario '.$user->full_name.' eliminado',
					'id'	 => $user->id
				));
			} 
			else 
			{
				return Redirect::back()->with('notice', 'El usuario ha sido eliminado correctamente.');	
			}
		}
	}
	public function ShowProfile($id, $username)
	{
       	/*if (Auth::guest()){
            Session::put('mensaje_error', 'Inicie sesión para realizar la compra.');
            Session::put('next_url', '/usuarios/perfil');
            return View::make('/login');
        }else{*/
			$user = User::find($id);
			$count = Post::where('user_id','=',$id)
						->count();
			return View::make('home.profile')->with(['user' => $user, 'count' => $count]);
		/*{*/
	}
	public function EditProfile($id)
	{
		$user = User::find(Auth::user()->id);

		return View::make('home.useredit')->with('user',$user);
	}
	public function UpdateProfile($id)
	{
		$user = User::find(Auth::user()->id);
		$user->username = Input::get('username');
		$user->full_name = Input::get('full_name');
		$user->email = Input::get('email');
		if(is_null(Input::get('password')))
		{
			$password = $user->password;

		}
		else
		{
			$password = Hash::make(Input::get('password'));
		}
		$user->password = $password;
		$user->biography = Input::get('biography');
		$user->twitter = Input::get('twitter');
		$user->facebook = Input::get('facebook');
		$user->tumblr = Input::get('tumblr');
		$user->pinterest = Input::get('pinterest');
		$user->instagram = Input::get('instagram');
		$user->googleplus = Input::get('googleplus');
		$file = Input::file('user_image');
		
		$filename = str_random(16).'_'.$file->getClientOriginalName();
		$user->user_iamge = $filename;
		$rules = array(
			'username'	=> 'required|unique:users,username,id',
			'email'	=> 'required|unique:users,email,id',
			'full_name'	=> 'required',
			'user_image' => 'image|max:512|image_size:250,250',
			'password' => 'confirmed|min:8|max:13',
			);
		$inputs = array(
			'username'	=> Input::get('username'),
			'email'	=> Input::get('email'),
			'fullname'	=> Input::get('fullname'),
			'user_image' => Input::file('user_image'),
			'password' => Input::file('password'),
			);
		$validation = Validator::make($inputs, $rules);
		if( $validation->passes() )
		{
			//Upload the file
			$uploadPath = 'assets/img/avatars';
			$upload 	= $file->move($uploadPath,$filename);
			if ($upload) {
				$user->save();
				return Redirect::to('home.useredit')->with('notice', 'El usuario ha sido editado correctamente.');
			}
		}
		else
		{
			return Redirect::to('home.useredit')->withInput()->withErrors($user->errors);
		}
	}
	
	/*----------------------------------*/
	/* Funcion para Banear a un Usuario */
	/*----------------------------------*/
	public function banUser($id) 
	{
		$user = User::find($id);
		$user->delete();

		return Redirect::back()->with('notice', 'El usuario ha sido Baneado correctamente.');
	}

	/*------------------------------------*/
	/* Funcion para ver Usuarios Baneados */
	/*------------------------------------*/
    public function bannedUsers()
    {
    	if(!$this->autorizado) return Redirect::to('/login');
    	$users = User::onlyTrashed()->get();
		$roles 	= 	Role::all();
		foreach ($users as $user) {
			$rol 	= 	Role::find($user->role_id);	# code...
		}
		if(is_null($users))
		{
			return View::make('users.banned');
		}
		else
		{
			return View::make('users.banned')->with('users',$users)->with('roles',$roles);
		}	

    }
    
	/*------------------------------------------*/
	/* Funcion para restaurar Usuarios Baneados */
	/*------------------------------------------*/
    public function restoreUser($id)
    {
    	if(!$this->autorizado) return Redirect::to('/login');
    	$user = User::withTrashed()->where('id', $id)->restore();
    	return Redirect::back()->with('notice', 'El usuario ha sido restaurado correctamente.');
    }

}
