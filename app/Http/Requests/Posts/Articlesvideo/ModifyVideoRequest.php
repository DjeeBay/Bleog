<?php

namespace App\Http\Requests\Posts\Articlesvideo;

class ModifyVideoRequest extends AddVideoRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    	$pattern = '/^(?:https?:\/\/)?(?:www\.)?youtu(?:\.be|be\.com)\/(?:watch\?v=)?([\w-]{10,})/';
    	return [
            'video_date' => 'date_format:Y-m-d',
        	'video_title' => 'string',
        	'video_link' => ['regex:'.$pattern]
        ];
    }
    
    public function messages()
    {
    	return [
    			'video_date.date_format' => 'Veuillez entre une date valide !',
    			'video_title.string' => 'Veuillez entrer un titre au format texte !',
    			'video_link.regex' => 'Veuillez entrer un lien Youtube valide !'
    	];
    }
}
