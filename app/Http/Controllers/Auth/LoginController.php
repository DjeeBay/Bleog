<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\Login\LoginRequest;

class LoginController extends Controller
{
    public function __construct()
    {
    	if (Auth::check())
    	{
    		return redirect(route('index'));
    	}
    }
    
    public function getLogin()
    {
    	return view('forms.login.login');
    }
    
    public function postLogin(LoginRequest $request)
    {
    	//var_dump($request->all());
    	if (Auth::attempt(['login' => $request->get('inputPseudo'), 'password' => $request->get('inputPassword')]))
    	{
    		return redirect()->route('index');
    	}
    	return redirect()->route('login')->with('fail', 'Erreur, mauvaise combinaison Pseudo / Mot de passe !');
    	
    }
}
