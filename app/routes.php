<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'PostsController@index');

Route::pattern('id', '[0-9]+');
Route::pattern('title', '[a-z0-9-]+');
Route::pattern('username', '[a-zA-Z0-9-_]+');

Route::get('posts/{id}/{title?}', 'PostsController@show');
//Route::get('posts/{title}', 'PostsController@show');

/* Formularios de Login y Registro de Usuario */
Route::get('login', 'AuthController@showLogin');
Route::post('login', 'AuthController@postLogin');

Route::get('registrarse', 'AuthController@showRegister');
Route::post('registrarse', 'AuthController@postRegister');


/* Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado. */
Route::group(array('before' => 'auth'), function()
{
	
	/* Panel de Administracion */
	Route::group(['prefix' => 'dashboard'], function() {
	
		Route::get('/', 'AdminController@index');
		
		/* Administracion de Usuarios */
		Route::group(['prefix' => 'usuarios'], function() {

			Route::get('/', 'AdminController@getUsers');

			Route::get('/agregar', 'UsersController@create');
			Route::get('/editar/{id}', 'UsersController@edit');
			Route::get('/perfil/{id}/{username}', 'UsersController@showProfile');
			Route::get('/banear/{id}', 'UsersController@banUser');
			
			Route::post('/agregar', 'UsersController@store');
			Route::post('/editar/{id}', 'UsersController@update');
			Route::get('/borrar/{id}', 'UsersController@destroy');
			
			Route::get('/baneados', 'UsersController@bannedUsers');
			Route::get('/restaurar/{id}', 'UsersController@restoreUser');

		});
		
		/* Administracion de Enciclopedia */
		Route::group(['prefix' => 'enciclopedia'], function() {

		});
		
		/* Administracion de Eventos */	
		Route::group(['prefix' => 'eventos'], function() {

		});

		/* Administracion de Afiliados */
		Route::group(['prefix' => 'afiliados'], function() {
			
		});
		/* Administracion de Posts */
		Route::group(['prefix' => 'posts'], function() {

			Route::get('/agregar','PostsController@create');
			Route::get('/editar/{id}','PostsController@edit');
			Route::get('/borrar/{id}','PostsController@destroy');
			Route::get('/aprobar/{id}','PostsController@approvePost');

			Route::post('/agregar','PostsController@store');
			Route::post('/editar/{id}','PostsController@update');

			//Route::get('/hacer-slug', 'PostsController@slugToAll');
			
		});
		
		
	});
	
	/* Perfil de Usuario Logueado */
	Route::group(['prefix' => 'usuarios'], function() {

		Route::get('/perfil/{id}/{username}', 'UsersController@showProfile');
		Route::get('/editar/{id}', 'UsersController@EditProfile');
		
		Route::post('/editar/{id}', 'UsersController@UpdateProfile');

	});

	Route::controller('usuarios', 'UsersController');
	/*Route::controller('enciclopedia', 'EncyclopediaController');
	Route::controller('eventos', 'EventsController');
	Route::controller('afiliados', 'AffilitiesController');*/

	Route::controller('dashboard', 'AdminController');

    
    /* Cierre de Sesion */
    Route::get('logout', 'AuthController@logOut');
});
