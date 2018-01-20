<?php

namespace App\Http\Controllers\Posts\UploadPhotos;

use App\Http\Controllers\Controller;
use App\MyLibraries\PhotoTreatment;
use App\Posts\Articles\ArticlesPics;
use App\Posts\ArticlesPhoto\Article_photo;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class UploadPhotosController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->middleware('admin');
        $this->model = new Article_photo();
    }

    public function get(Request $request)
    {
        return view('forms.posts.photos.photos');
    }

    public function upload(Request $request)
    {
        $validator = $this->validateRequest($request);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first()], 422);
        }
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {

                $treatment = new PhotoTreatment();
                if ($treatment->fileTreatmentWithIntervention($photo, 'articles_pic')) {
                    $newPhoto = new ArticlesPics([
                        'picsname' => $treatment->getPicsname()
                    ]);
                    $newPhoto->save();
                } else {
                    return response()->json(['success' => false, 'message' => 'Une erreur s\'est produite !']);
                }

            }
            return response()->json(['success' => true, 'message' => 'Les photos ont bien été uploadées.']);
        }
    }

    private function validateRequest(Request $request) : Validator
    {
        $rules = ['photos.*' => 'mimes:jpeg,png|max:5120'];
        $messages = ['max' => 'Une photo est trop volumineuse.'];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages);

        return $validator;
    }
}