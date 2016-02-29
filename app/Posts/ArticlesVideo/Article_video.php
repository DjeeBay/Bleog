<?php

namespace App\Posts\ArticlesVideo;

use Illuminate\Database\Eloquent\Model;

class Article_video extends Model
{
    protected $table = 'articles_video';
    
    protected $fillable = ['title', 'link'];
}
