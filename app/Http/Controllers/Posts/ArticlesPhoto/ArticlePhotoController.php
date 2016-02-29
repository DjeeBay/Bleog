<?php

namespace App\Http\Controllers\Posts\ArticlesPhoto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\ArticlesPhoto\AddPhotoRequest;
use App\MyLibraries\PhotoTreatment;
use App\Posts\ArticlesPhoto\Article_photo;
use App\Posts\Post;
use Illuminate\Support\Facades\Auth;

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
    		$newPhoto = new Article_photo([
    				'title' => $request->photo_description,
    				'picsname' => $treatment->getPicsname()
    		]);
    		$newPhoto->save();
    		
    		$newPost = new Post();
    		$newPost->type = 'photo';
    		$newPost->user_id = Auth::user()->id;
    		$newPost->defined_date = $request->photo_date;
    		$newPost->type_key_id = $newPhoto->getKey();
    		$newPost->save();
    		
    		return redirect(route('addPhoto'))->with('success', 'La photo a été ajoutée avec succès !');
    	}
    	else
    	{
    		return back()->with('fail', 'Une erreur s\'est produite !');
    	}
    }
}
