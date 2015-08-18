<?php

class AdminController extends \BaseController {

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
		$posts = DB::table('posts')
					->orderBy('id', 'desc')
					->where('post_approved','=','yes')
					->paginate(10);
		$drafts = DB::table('posts')
					->orderBy('id', 'desc')
					->where('post_approved','=','no')
					->paginate(10);					
		return View::make('dashboard.index')->with(['posts' => $posts, 'drafts' => $drafts]);
	}
	public function getAffiliate()
	{
		
	}
	public function getPedia()
	{
		# code...
	}
	public function getEvents()
	{
		# code...
	}
	public function getUsers()
	{
		$users = User::orderBy('id', 'desc')
					->paginate(10);
		$bUsers = User::onlyTrashed()->get();
		$roles = Role::all();
		$options = array();
		foreach ($roles as $role) {
			$options[$role->id] = $role->role_name;
		}
		return View::make('dashboard.users')->with(['users' => $users, 'bUsers' => $bUsers, 'roles' => $roles, 'options' => $options]);
	}
}
