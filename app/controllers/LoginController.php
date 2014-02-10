<?php

class LoginController {

	public function get() 
	{
		return View::make('login.php');
	}

	public function post()
	{
		$input = Input::allPost();
		$password = md5($input['password']);
		$username = $input['username'];

		$result = User::where('password', '=', $password)
					  	->where('username', '=', $username)
						->first();

		if(!$result) {
			Session::getFlashBag()->add('warning', 'Username and password combination wrong');
			Redirect::to(Url::generate('login.get'));
			return false;
		}

		Session::set('username', $username);
		Session::getFlashBag()->add('message', 'Logged in succesfully!');
		Redirect::to(Url::generate('task.index'));
	}

	public function logout()
	{
		Session::remove('username');
		Session::getFlashBag()->add('message', 'Logged out succesfully!');
		Redirect::to(Url::generate('task.index'));
	}

}
