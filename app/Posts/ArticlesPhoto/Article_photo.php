<?php

namespace App\Posts\ArticlesPhoto;

use Illuminate\Database\Eloquent\Model;

class Article_photo extends Model
{
    /**
     * Table associated with the model.
     * 
     * @var string $table
     */
	protected $table = 'articles_photo';
	
	/**
	 * Attributes that are mass assignable.
	 * 
	 * @var array
	 */
	protected $fillable = ['title', 'picsname'];
	
	public function post()
	{
		$this->belongsTo('App\Posts\Post');
	}
}
