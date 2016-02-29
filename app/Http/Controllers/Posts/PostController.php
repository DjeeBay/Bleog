<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Posts\Post;

class PostController extends Controller
{
    public function __construct($type, $user, $foreign, $date)
    {
    	$newPost = new Post();
    	$newPost->type = $type;
    	$newPost->user_id = $user;
    	$newPost->type_key_id = $foreign;
    	$newPost->defined_date = $date;
    	$newPost->save();
    }
}
