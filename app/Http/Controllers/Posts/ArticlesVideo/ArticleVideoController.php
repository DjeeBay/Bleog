<?php

namespace App\Http\Controllers\Posts\ArticlesVideo;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\Articlesvideo\AddVideoRequest;

class ArticleVideoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function getForm()
    {
    	return view('forms.posts.articles_video.add_video');
    }
    
    public function postForm(AddVideoRequest $request)
    {
    	var_dump($request);
    }
}
