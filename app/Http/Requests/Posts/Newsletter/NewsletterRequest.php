<?php

namespace App\Http\Requests\Posts\Newsletter;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class NewsletterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Gate::denies('restrict-access', Auth::user()))
        {
        	abort(403);
        }
    	return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'newsletter_title' => 'required|string',
        	'newsletter_body' => 'required'
        ];
    }
    
    public function messages()
    {
    	return [
    			'newsletter_title.*' => 'Veuillez renseigner un titre !',
    			'newsletter_body.required' => 'Veuillez entrer un message !'
    	];
    }
}
