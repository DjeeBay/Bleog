<?php

namespace App\Http\Controllers\Posts\Newsletter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts\Newsletter;

class UnsuscribeController extends Controller
{
	public function getUnsus($id)
	{
		$unsuscriber = Newsletter::where('uniqid', '=', $id)->firstOrFail();
	    return view('forms.newsletter.unsuscribe')->with('unsuscriber', $unsuscriber);
	}
	
	public function postUnsus(Request $request, $id)
	{
		Newsletter::where('uniqid', '=', $id)->delete();
		
		return '<div>
					<p>La désinscription a bien été prise en compte.</p>
				</div>';
	}
}