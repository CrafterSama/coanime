<?php

class AuthController extends BaseController {
    /*
    |--------------------------------------------------------------------------
    | Controlador de la autenticación de usuarios
    |--------------------------------------------------------------------------
    */

	/*
     * Muestra el formulario para login.
     */
    public function showLogin()
    {
        // Verificamos que el usuario no esté autenticado
        if (Auth::check())
        {
            // Si está autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
            return Redirect::to('/');
        }
        // Mostramos la vista login.blade.php (Recordemos que .blade.php se omite.)
        return View::make('sign.signin');
    }

    public function postLogin()
    {
        // Guardamos en un arreglo los datos del usuario.
        $userdata = array(
            'username' => Input::get('username'),
            'password'=> Input::get('password')
        );
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        if(Auth::attempt($userdata, Input::get('remember-me', 0)))
        {
            // De ser datos válidos nos mandara a la bienvenida
            return Redirect::to('/');
        }
        // En caso de que la autenticación haya fallado manda un mensaje al formulario de login y también regresamos los valores enviados con withInput().
        return Redirect::to('/login')
                    ->with('mensaje_error', 'Tus datos son incorrectos')
                    ->withInput();
    }
    public function logOut()
    {
        Auth::logout();
        return Redirect::to('/login')
                    ->with('mensaje_error', 'Tu sesión ha sido cerrada.');
    }
    public function showRegister()
    {
        $user = new User();
        return View::make('sign.signup');
    }
    public function postRegister()
    {
        $user = new User();
        $user->full_name = Input::get('full_name');
        $user->username = Input::get('username');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->role_id = 2;
        $validator = User::validate(array(
            'full_name' => Input::get('full_name'),
            'username' => Input::get('username'),
            'email' => Input::get('email'),
            'password' => $user->password,
        ), $user->id);
        if($validator->fails()){
            $errors = $validator->messages()->all();
            $user->password = null;
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $user->save();
            return Redirect::to('/registrarse')->with('notice', 'El usuario ha sido registrado correctamente.');
        }
    }
}