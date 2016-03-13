<?php

namespace App\Posts\Articles;

use Illuminate\Database\Eloquent\Model;

class ArticlesPics extends Model
{
    protected $table = 'articles_pics';
    
    protected $fillable = ['picsname'];
}
