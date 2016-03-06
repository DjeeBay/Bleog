<?php

namespace App\Http\Controllers\GetPost\Photo;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    
    public function getPhoto($id)
    {
    	echo $id;
    }
}
