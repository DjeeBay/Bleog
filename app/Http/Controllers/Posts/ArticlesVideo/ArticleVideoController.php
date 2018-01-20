<?php

namespace App\Http\Controllers\Posts\ArticlesVideo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\ArticlesVideo\AddVideoRequest;
use App\Posts\ArticlesVideo\Article_video;
use App\Http\Controllers\Posts\PostController;
use Illuminate\Support\Facades\Auth;
use App\MyLibraries\VideoTreatment;
use Illuminate\Support\Facades\Gate;

class ArticleVideoController extends Controller
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
    	
    	return view('forms.posts.articles_video.add_video');
    }
    
    public function postForm(AddVideoRequest $request)
    {
    	$newVideo = new Article_video();
    	$newVideo->title = $request->video_title;
    	$newVideo->link = VideoTreatment::getIdYoutube($request->video_link);
    	$newVideo->save();
    	
    	new PostController('video', Auth::user()->id, $newVideo->getKey(), $request->video_date);
    	
    	return back()->with('success', 'La vidéo a été ajoutée avec succès !');
    }
}
