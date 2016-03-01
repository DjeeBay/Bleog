<?php

namespace App\Http\Controllers\Posts\ArticlesPhoto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\ArticlesPhoto\AddPhotoRequest;
use App\MyLibraries\PhotoTreatment;
use App\Posts\ArticlesPhoto\Article_photo;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Posts\PostController;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ArticlePhotoController extends Controller
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
    	return view('forms.posts.articles_photo.add_photo');
    }
    
    public function postForm(AddPhotoRequest $request)
    {
    	$treatment = new PhotoTreatment();
    	if ($treatment->fileTreatment($request->file('photo_file')))
    	{
    		$newPhoto = new Article_photo([
    				'title' => $request->photo_description,
    				'picsname' => $treatment->getPicsname()
    		]);
    		$newPhoto->save();
    		
    		new PostController('photo', Auth::user()->id, $newPhoto->getKey(), $request->photo_date);
    		
    		return redirect(route('addPhoto'))->with('success', 'La photo a été ajoutée avec succès !');
    	}
    	else
    	{
    		return back()->with('fail', 'Une erreur s\'est produite !');
    	}
    }
}
