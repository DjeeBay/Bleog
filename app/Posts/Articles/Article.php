<?php

namespace App\Posts\Articles;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
/**
     * Table associated with the model.
     * 
     * @var string $table
     */
	protected $table = 'articles';
	
	/**
	 * Attributes that are mass assignable.
	 * 
	 * @var array
	 */
	protected $fillable = ['title', 'bodytext'];
}
