<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\Login\LoginRequest;

class LoginController extends Controller
{
    public function __construct()
    {
    	
    }
    
    public function getLogin()
    {
    	if (Auth::check())
    	{
    		return redirect()->route('index');
    	}
    	if (isset($_COOKIE['username']) && isset($_COOKIE['_pwd']))
    	{
    		if (Auth::attempt(['login' => $_COOKIE['username'], 'password' => 'visiteur']))
    		{
    			return redirect()->route('index');
    		}
    	}
    	return view('forms.login.login');
    }
    
    public function postLogin(LoginRequest $request)
    {
    	if (Auth::attempt(['login' => $request->get('inputPseudo'), 'password' => $request->get('inputPassword')]))
    	{
    		if ($request->has('rememberMe') && $request->rememberMe == 'rememberMe' && $request->inputPseudo == 'visiteur')
    		{
    			setcookie('username', Auth::user()->login, time() + 3600*24*365*10, null, null, false, true);
    			setcookie('_pwd', 'visiteur', time() + 3600*24*365*10, null, null, false, true);
    		}
    		return redirect()->route('index');
    	}
    	return redirect()->route('login')->with('fail', 'Erreur, mauvaise combinaison Pseudo / Mot de passe !');
    }
}
