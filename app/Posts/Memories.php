<?php

namespace App\Posts;

use Illuminate\Database\Eloquent\Model;

class Memories extends Model
{
    protected $table = 'memories';

    protected $fillable = ['event_date', 'description'];

    protected $dates = ['event_date'];
}
