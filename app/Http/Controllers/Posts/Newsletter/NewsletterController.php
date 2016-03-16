<?php

namespace App\Http\Controllers\Posts\Newsletter;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Posts\Newsletter;
use App\Http\Requests\Posts\Newsletter\NewsletterRequest;

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
    
    public function postForm(NewsletterRequest $request)
    {
    	return redirect()->route('newsletter')->with('success', 'La newsletter a bien été envoyée !');
    }
}
