<?php

namespace App\Http\Requests\Posts\Articles;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class AddGalleryPic extends Request
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
            'photo_file' => 'required|mimes:jpeg,png|max:2080'
        ];
    }
    
    public function messages()
    {
    	return [
    			'photo_file.*' => 'Erreur. Vérifier le type / poids de l\'image.'
    	];
    }
}
