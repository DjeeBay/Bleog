<?php

namespace App\Http\Requests\Posts\Articles;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class AddArticleRequest extends Request
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
            'article_date' => 'required|date_format:Y-m-d',
        	'article_title' => 'required|string',
        	'article_body' => 'required|string'
        ];
    }
    
    public function messages()
    {
    	return [
    		'article_date.*' => 'Date non valide !',
        	'article_title.required' => 'Veuillez entrer un titre !',
    		'article_title.string' => 'Veuillez entrer un titre au format texte !',
        	'article_body.*' => 'Veuillez renseigner le corps de l\'article !'
    	];
    }
}
