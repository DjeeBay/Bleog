<?php

namespace App\Http\Requests\Posts\ArticlesPhoto;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class AddPhotoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->admin == 1)
        {
        	return true;
        }
    	return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo_date' => 'required|date',
        	'photo_description' => 'string',
        	'photo_file' => 'required|mimes:jpeg,png|max:2080',
        ];
    }
    
    public function messages()
    {
    	return [
    		'photo_date.*' => 'Date non valide !',
    		'photo_description.string' => 'Veuillez entrer une description textuelle !',
    		'photo_file.required' => 'Veuillez sélectionner une photo !',
    		'photo_file.mimes' => 'Format d\'image non valide !',
    		'photo_file.max' => 'Veuillez réduire le poids de la photo !'
    	];
    }
}
