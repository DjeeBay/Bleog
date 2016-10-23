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
use App\Posts\Articles\ArticlesPics;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\Posts\Articles\AddGalleryPic;
use Illuminate\Support\Facades\Session;
use App\MyLibraries\PhotoTreatment;

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
    
    public function getGallery()
    {
    	if (Gate::denies('restrict-access', Auth::user()))
    	{
    		abort(403);
    	}
    	$pics = ArticlesPics::all()->sortByDesc('created_at');
    	
    	return view('forms.posts.articles.picslist')->with('pics', $pics);
    }
    
    public function delGallery(Request $request)
    {
    	if ($request->has('selectedPics'))
    	{
    		$pic = ArticlesPics::find($request->get('selectedPics'));
    		if (file_exists(public_path('/pics/articles_pics/'.$pic->picsname)))
    		{
    		    unlink(public_path('/pics/articles_pics/'.$pic->picsname));
            }
            if (file_exists(public_path('/pics/articles_pics/'.$pic->picsname)))
            {
                unlink(public_path('/pics/articles_pics/mini/'.$pic->picsname));
            }
    		$pic->delete();
    		return redirect($request->server('HTTP_REFERER'))->with('success', 'La photo a bien été supprimée !');
    	}
    	return redirect($request->server('HTTP_REFERER'))->with('fail', 'Veuillez cocher la case avant de cliquer sur supprimer !');
    }
    
    public function sendAGalleryPic(AddGalleryPic $request)
    {
    	if (session()->get('errors') != null)
    	{
    		return redirect($request->server('HTTP_REFERER'));
    	}
    	$treatment = new PhotoTreatment();
    	if ($treatment->fileTreatmentWithIntervention($request->file('photo_file'), 'articles_pic'))
    	{
    		$newPhoto = new ArticlesPics([
    				'picsname' => $treatment->getPicsname()
    		]);
    		$newPhoto->save();
    	
    		return redirect($request->server('HTTP_REFERER'))->with('success', 'La photo a bien été ajoutée !');
    	}
    	else
    	{
    		redirect($request->server('HTTP_REFERER'))->with('fail', 'Une erreur s\'est produite !');
    	}
    }
}
