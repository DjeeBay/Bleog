<?php

namespace App\Http\Controllers\GetPost\Article;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Posts\Articles\ModifyArticleRequest;
use App\Posts\Articles\Article;
use App\Posts\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getArticle($id)
    {
    	$queryArticle = $this->getModel($id);
    	
    	return view('getPost.getArticle.article')->with('queryArticle', $queryArticle);
    }
    
    public function modifyArticle(ModifyArticleRequest $request, $id)
    {
    	// Modify the date.
    	if ($request->filled('article_date'))
    	{
    		Post::where('type', 'article')
    		->where('type_key_id', $id)
    		->update(['defined_date' => $request->article_date]);
    		 
    		return redirect(route('articlesPage', [$id]))->with('success', 'La date a bien été modifiée !');
    	}
    	
    	// Modify the title.
    	elseif ($request->filled('article_title'))
    	{
    		$newTitle = $request->article_title;
    		Article::where('id', $id)
    		->update(['title' => $newTitle]);
    		 
    		return redirect(route('articlesPage', [$id]))->with('success', 'Le titre a bien été modifié !');
    	}
    	
    	// Delete the post.
    	elseif ($request->filled('delThePost'))
    	{
    		Article::where('id', $id)
    		->delete();
    		 
    		Post::where('type', 'article')
    		->where('type_key_id', $id)
    		->delete();
    		 
    		return redirect(route('index'))->with('success', 'L\'article a bien été supprimé !');
    	}
    	
    	return redirect(route('articlesPage', [$id]));
    }
    
    public function getEditableArticle($id)
    {
    	if (Gate::denies('restrict-access', Auth::user()))
    	{
    		abort(403);
    	}
    	$queryArticle = $this->getModel($id);
    	
    	return view('forms.posts.articles.modify_body')->with('queryArticle', $queryArticle);
    }
    
    public function editArticle(ModifyArticleRequest $request, $id)
    {
    	Article::where('id', $id)
    	->update(['bodytext' => $request->article_body]);
    	
    	return redirect(route('articlesPage', [$id]))->with('success', 'L\'article à bien été modifié !');
    }
    
    private function getModel($id)
    {
    	$queryArticle = DB::table('posts')
    	->join('articles', function($join){
    		$join->on('posts.type_key_id', '=', 'articles.id')
    		->on('posts.type', '=', DB::raw('\'article\''));
    	})
    	->selectRaw('posts.type_key_id as id, DATE_FORMAT(posts.defined_date, \'%d/%m/%Y\') as date, articles.title as title, articles.bodytext as body')
    	->where('articles.id', '=', $id)
    	->get();
    	
    	return $queryArticle;
    }
}
