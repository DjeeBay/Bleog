<?php

namespace App\Http\Controllers\GetPost\Photo;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function getPhoto($id)
    {
    	$queryPhoto = DB::table('posts')
    		->leftJoin('articles_photo', 'posts.type_key_id', '=', 'articles_photo.id')
    		->selectRaw('DATE_FORMAT(posts.defined_date, \'%d/%m/%Y\') as date, articles_photo.title as title, articles_photo.picsname')
    		->where('articles_photo.id', '=', $id)
    		->get();
    	
    	return view('getPost.getPhoto.photo')->with('queryPhoto', $queryPhoto);
    }
}
