<?php

namespace App\Http\Controllers\GetPost\Photo;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Posts\ArticlesPhoto\Article_photo;
use App\Http\Requests\Posts\ArticlesPhoto\AddPhotoRequest;
use App\Posts\Post;
use App\Http\Requests\Posts\ArticlesPhoto\ModifyPhotoDate;

class PhotoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function getPhoto($id)
    {
    	$queryPhoto = DB::table('posts')
    		->join('articles_photo', function($join){
    			$join->on('posts.type_key_id', '=', 'articles_photo.id')
    				->on('posts.type', '=', DB::raw('\'photo\''));
    		})
    		->selectRaw('posts.type_key_id as id, DATE_FORMAT(posts.defined_date, \'%d/%m/%Y\') as date, articles_photo.title as title, articles_photo.picsname')
    		->where('articles_photo.id', '=', $id)
    		->get();
    	
    	return view('getPost.getPhoto.photo')->with('queryPhoto', $queryPhoto);
    }
    
    public function modifyDate(ModifyPhotoDate $request, $id)
    {
    	$post = Post::where('type', 'photo')
    			->where('type_key_id', $id)
    			->update(['defined_date' => $request->photo_date]);
    	
    	return back()->with('success', 'La date a bien été modifiée !');
    }
}
