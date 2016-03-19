<?php

namespace App\Http\Controllers\Posts\Newsletter;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Posts\Newsletter;

class SubscriberController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
	
	public function getList()
    {
    	if (Gate::denies('restrict-access', Auth::user()))
    	{
    		abort(403);
    	}
    	
    	$subscribers = Newsletter::all();
    	return view('forms.newsletter.subscribers')->with('subscribers', $subscribers);
    }
    
    public function postDelAddress(Request $request)
    {
    	$delSub = Newsletter::where('id', '=', $request->subId)->delete();
    	return redirect()->route('subscribers')->with('success', 'L\'adresse <b>'.$request->subAddress.'</b> a bien été supprimée !');
    }
}
