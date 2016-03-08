<?php
namespace App\Http\Requests\Posts\ArticlesPhoto;

class ModifyPhotoDate extends AddPhotoRequest
{
	public function rules()
	{
		return [
				'photo_date' => 'required|date'
		];
	}
	
	public function messages()
	{
		return [
				'photo_date.*' => 'Date non valide !'
		];
	}
}