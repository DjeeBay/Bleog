<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class NavController
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function getYears()
    {
        $years = DB::table('posts')
            ->selectRaw('DISTINCT extract(YEAR from posts.defined_date) as year')
            ->orderBy('year', 'desc')
            ->get();
        return $years;
    }

}