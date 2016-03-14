<?php

namespace App\Posts;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'newsletter';
    
    protected $fillable = ['email_address', 'uniqid'];
}
