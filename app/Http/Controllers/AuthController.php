<?php namespace urialc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
	public function __construct()
	{
	}
	public function getLogin()
	{
		$title = "Inicio de sesión | Urialc";
		return view('admin.auth.login')
		->with('title',$title);
	}
	public function postLogin(Request $request)
	{
		$data = $request->input();
		$rules = [
			'username' => 'required|exists:users,username',
			'password' => 'required',
		];
		$msg  = [];
		$attr = [
			'username' => 'Nombre de usuario'
		];
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors());
		}
		$auth = [
			'username' => $data['username'],
			'password' => $data['password'],
			'deleted'  => 0,
			'suspended'=> 0,
		];
		if ($request->has('remember')) {
			$remember = 1;
		}else
		{
			$remember = 0;

		}
		if (Auth::attempt($auth, $remember)) {
			return redirect('administrador');
		}
		Session::flash('danger','Error, usuario o contraseña incorrectos');
		return redirect()->back();
	}
	public function logout()
	{
		Auth::logout();
		return redirect('administrador/login');
	}
}
