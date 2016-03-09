<?php

namespace App\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Table associated with the model.
     * 
     * @var string $table
     */
	protected $table = 'posts';
	
	/**
	 * Attributes that are mass assignable.
	 * 
	 * @var array
	 */
	protected $fillable = ['type', 'user_id', 'type_key_id', 'defined_date'];
}
