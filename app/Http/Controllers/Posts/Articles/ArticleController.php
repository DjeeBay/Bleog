<?php

namespace App\Http\Controllers\Posts\Articles;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Posts\Articles\AddArticleRequest;
use App\Posts\Articles\Article;
use App\Http\Controllers\Posts\PostController;

class ArticleController extends Controller
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
    	return view('forms.posts.articles.add_article');
    }
    
    public function postForm(AddArticleRequest $request)
    {
    	$newArticle = new Article([
    			'title' => $request->article_title,
    			'bodytext' => $request->article_body
    	]);
    	$newArticle->save();
    	
    	new PostController('article', Auth::user()->id, $newArticle->getKey(), $request->article_date);
    	
    	return redirect(route('addArticle'))->with('success', 'L\'article a été ajouté avec succès !');
    }
}
