<?php

namespace App\Http\Controllers\GetPost\Article;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function getArticle($id)
    {
    	$queryArticle = DB::table('posts')
    		->join('articles', function($join){
    			$join->on('posts.type_key_id', '=', 'articles.id')
    				->on('posts.type', '=', DB::raw('\'article\''));
    		})
    		->selectRaw('posts.type_key_id as id, DATE_FORMAT(posts.defined_date, \'%d/%m/%Y\') as date, articles.title as title, articles.bodytext as body')
    		->where('articles.id', '=', $id)
    		->get();
    	
    	return view('getPost.getArticle.article')->with('queryArticle', $queryArticle);
    }
    
    public function modifyArticle($id)
    {
    	
    }
    
    public function getEditableArticle($id)
    {
    	echo $id;
    }
    
    public function editArticle($id)
    {
    	echo $id;
    }
}
