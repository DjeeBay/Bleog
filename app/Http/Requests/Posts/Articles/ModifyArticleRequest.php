<?php

namespace App\Http\Requests\Posts\Articles;

use App\Http\Requests\Request;

class ModifyArticleRequest extends AddArticleRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
public function rules()
    {
        return [
            'article_date' => 'date_format:Y-m-d',
        	'article_title' => 'string',
        	'article_body' => 'string'
        ];
    }
    
    public function messages()
    {
    	return [
    		'article_date.*' => 'Date non valide !',
    		'article_title.string' => 'Veuillez entrer un titre au format texte !',
        	'article_body.*' => 'Veuillez renseigner le corps de l\'article !'
    	];
    }
}
