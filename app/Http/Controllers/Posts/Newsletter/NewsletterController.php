<?php

namespace App\Http\Controllers\Posts\Newsletter;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Posts\Newsletter;

class NewsletterController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function getForm()
    {
    	if (Gate::denies('restrict-access', Auth::user()))
    	{
    		abort(403);
    	}
    	$subscribers = Newsletter::all();
    	
    	return view('forms.newsletter.newsletter')->with('subscribers', $subscribers);
    }
    
    public function postForm(Request $request)
    {
    	return var_dump($request->all());
    }
}
