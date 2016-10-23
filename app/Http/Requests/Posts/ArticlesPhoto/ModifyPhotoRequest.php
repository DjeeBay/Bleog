<?php
namespace App\Http\Requests\Posts\ArticlesPhoto;

class ModifyPhotoRequest extends AddPhotoRequest
{
	public function rules()
	{
		return [
				'photo_date' => 'date_format:Y-m-d',
				'description' => 'string',
				'photo_file' => 'mimes:jpeg,png'/*|max:2080'*/
		];
	}
	
	public function messages()
	{
		return [
				'photo_date.*' => 'Date non valide !',
				'description.*' => 'Titre invalide !',
				'photo_file.mimes' => 'Format d\'image non valide !',
    			'photo_file.max' => 'Veuillez réduire le poids de la photo !'
		];
	}
}