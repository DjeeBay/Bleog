<?php

namespace App\Http\Requests\Posts\Articlesvideo;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class AddVideoRequest extends Request
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
            'video_date' => 'required|date',
        	'video_title' => 'required|string',
        	'video_link' => 'required'
        ];
    }
    
    public function messages()
    {
    	return [
    			'video_date.required' => 'Veuillez entre une date !',
    			'video_date.date' => 'Veuillez entre une date valide !',
    			'video_title.required' => 'Veuillez entrer un titre !',
    			'video_title.string' => 'Veuillez entrer un titre au format texte !',
    			'video_link.required' => 'Veuillez entrer un lien !'
    	];
    }
}
