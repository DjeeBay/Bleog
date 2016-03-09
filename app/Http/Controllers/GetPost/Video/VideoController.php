<?php

namespace App\Http\Controllers\GetPost\Video;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Posts\ArticlesVideo\ModifyVideoRequest;
use App\Posts\ArticlesVideo\Article_video;
use App\Posts\Post;
use App\MyLibraries\VideoTreatment;

class VideoController extends Controller
{
    public function getVideo($id)
    {
    	$queryVideo = DB::table('posts')
    		->join('articles_video', function($join){
    			$join->on('posts.type_key_id', '=', 'articles_video.id')
    				->on('posts.type', '=', DB::raw('\'video\''));
    		})
    		->selectRaw('posts.type_key_id as id, DATE_FORMAT(posts.defined_date, \'%d/%m/%Y\') as date, articles_video.title as title, articles_video.link')
    		->where('articles_video.id', '=', $id)
    		->get();
    	
    	return view('getPost.getVideo.video')->with('queryVideo', $queryVideo);
    }
    
    public function modifyVideo(ModifyVideoRequest $request, $id)
    {
    	// Modify the date.
    	if ($request->has('video_date'))
    	{
    		Post::where('type', 'video')
    		->where('type_key_id', $id)
    		->update(['defined_date' => $request->video_date]);
    	
    		return redirect(route('videosPage', [$id]))->with('success', 'La date a bien été modifiée !');
    	}
    	 
    	// Modify the title.
    	elseif ($request->has('video_title'))
    	{
    		$newTitle = $request->video_title;
    		Article_video::where('id', $id)
    		->update(['title' => $newTitle]);
    	
    		return redirect(route('videosPage', [$id]))->with('success', 'Le titre a bien été modifié !');
    	}
    	 
    	// Delete the post.
    	elseif ($request->has('delThePost'))
    	{
    		Article_video::where('id', $id)
    		->delete();
    	
    		Post::where('type', 'video')
    		->where('type_key_id', $id)
    		->delete();
    	
    		return redirect(route('index'))->with('success', 'La vidéo a bien été supprimée !');
    	}
    	 
    	// Modify the link of the video.
    	elseif ($request->has('video_link'))
    	{
    	
    		$idLink = VideoTreatment::getIdYoutube($request->video_link);
    		
    		Article_video::where('id', $id)
    		->update(['link' => $idLink]);
    		 
    		return redirect(route('videosPage', [$id]))->with('success', 'Le lien de la vidéo a bien été modifié !');
    	}
    	 
    	return redirect(route('videosPage', [$id]));
    }
}
