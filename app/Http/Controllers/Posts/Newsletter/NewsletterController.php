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
    	/*$subs = Newsletter::all();
    	foreach ($subs as $sub)
    	{
    		echo $sub->email_address;
    		echo $sub->uniqid.'<br><br>';
    	}*/
    	
    	$test = 'test';
    	
    	$to = 'thebestjb@gmail.com';
    	$headers  = 'MIME-Version: 1.0' . "\r\n";
    	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    	$message = $request->newsletter_body;
    	$message .= '<br><a href="http://www.bleog.fr"><strong>Bleog.fr</strong></a><hr>
						<small>Pour ne plus recevoir les newsletters, vous pouvez vous désinscrire en cliquant
						<a href="http://www.bleog.fr/newsletter/unsuscribe/'.$test.'">ici</a></small>';
    	mail($to, $request->newsletter_title, $message, $headers);
    	
    	return redirect()->route('newsletter')->with('success', 'La newsletter a bien été envoyée !');
    }
}
