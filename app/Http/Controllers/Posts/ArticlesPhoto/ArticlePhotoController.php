<?php

namespace App\Http\Controllers\Posts\ArticlesPhoto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\ArticlesPhoto\AddPhotoRequest;
use Illuminate\Support\Facades\Session;
use App\MyLibraries\PhotoTreatment;

class ArticlePhotoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function getForm()
    {
    	return view('forms.posts.articles_photo.add_photo');
    }
    
    public function postForm(AddPhotoRequest $request)
    {
    	$treatment = new PhotoTreatment();
    	if ($treatment->fileTreatment($request->file('photo_file')))
    	{
    		return redirect(route('addPhoto'))->with('success', 'La photo a été ajoutée avec succès !');
    	}
    	else
    	{
    		return back()->with('fail', 'Une erreur s\'est produite !');
    	}
    }
}
