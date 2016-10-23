<?php

namespace App\Http\Controllers\GetPost\Photo;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Posts\ArticlesPhoto\Article_photo;
use App\Posts\Post;
use App\Http\Requests\Posts\ArticlesPhoto\ModifyPhotoRequest;
use App\MyLibraries\PhotoTreatment;

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
    
    public function modifyPhoto(ModifyPhotoRequest $request, $id)
    {
    	// Modify the date.
    	if ($request->has('photo_date'))
    	{
    		Post::where('type', 'photo')
    		->where('type_key_id', $id)
    		->update(['defined_date' => $request->photo_date]);
    		
    		return redirect(route('photosPage', [$id]))->with('success', 'La date a bien été modifiée !');
    	}
    	
    	// Modify the title.
    	elseif ($request->has('description'))
    	{
    		$newTitle = $request->description;
    		Article_photo::where('id', $id)
    		->update(['title' => $newTitle]);
    
    		return redirect(route('photosPage', [$id]))->with('success', 'La description a bien été modifiée !');
    	}
    	
    	// Delete the title.
    	elseif ($request->has('delDescr'))
    	{
    		Article_photo::where('id', $id)
    		->update(['title' => null]);
    	
    		return redirect(route('photosPage', [$id]))->with('success', 'La description a bien été supprimée !');
    	}
    	
    	// Delete the post with the pics.
    	elseif ($request->has('delThePost'))
    	{
    		$picsName = $this->getFileName($id);
    		
    		Article_photo::where('id', $id)
    		->delete();
    		
    		Post::where('type', 'photo')
    		->where('type_key_id', $id)
    		->delete();
    		
    		$this->delPics($picsName);
    		 
    		return redirect(route('index'))->with('success', 'La photo a bien été supprimée !');
    	}
    	
    	// Modify the picture and delete the old one.
    	elseif ($request->file('photo_file'))
    	{
    		$picsName = $this->getFileName($id);
    		
    		$treatment = new PhotoTreatment();
    		if ($treatment->fileTreatmentWithIntervention($request->file('photo_file'), 'photo'))
    		{
    			Article_photo::where('id', $id)
    			->update(['picsname' => $treatment->getPicsname()]);
    		}
    		else
    		{
    			return redirect(route('photosPage', [$id]))->with('fail', 'Une erreur s\'est produite !');
    		}
    		
    		$this->delPics($picsName);
    		 
    		return redirect(route('photosPage', [$id]))->with('success', 'La photo a bien été modifiée !');
    	}
    	
    	return redirect(route('photosPage', [$id]));
    }
    
    private function delPics($name)
    {
    	unlink(public_path('/pics/'.$name));
    	unlink(public_path('/pics/mini/'.$name));
    }
    
    private function getFileName($id)
    {
    	$picture = Article_photo::where('id', $id)
    	->get();
    	foreach ($picture as $name)
    	{
    		$picsName = $name->picsname;
    	}
    	
    	return $picsName;
    }
}
