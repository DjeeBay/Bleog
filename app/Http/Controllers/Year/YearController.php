<?php

namespace App\Http\Controllers\Year;


use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class YearController extends Controller
{

    public function get($id)
    {
        $months = DB::table('posts')
            ->leftJoin('articles', function ($join) {
                $join->on('posts.type_key_id', '=', 'articles.id')
                    ->on('posts.type', '=', DB::raw('\'article\''));
            })
            ->leftJoin('articles_photo', function ($join) {
                $join->on('posts.type_key_id', '=', 'articles_photo.id')
                    ->on('posts.type', '=', DB::raw('\'photo\''));
            })
            ->leftJoin('articles_video', function ($join) {
                $join->on('posts.type_key_id', '=', 'articles_video.id')
                    ->on('posts.type', '=', DB::raw('\'video\''));
            })
            ->selectRaw('EXTRACT(YEAR_MONTH FROM posts.defined_date) as Date, posts.type, articles.id as article_id, articles.title as article_title,
    				articles_photo.id as photo_id, articles_photo.picsname as photo_name,
    				articles_video.id as video_id, articles_video.link as video_link, articles_video.title as video_title')
            ->orderBy('posts.defined_date', 'desc')
            ->where(DB::Raw('EXTRACT(YEAR FROM posts.defined_date)'), $id)
            ->get();

        if (!$months)
            return Redirect::to('/');

        return view('year.year')->with([
            'months' => $this->makeTheMonths($months),
            'year' => $id,
        ]);
    }

    private function makeTheMonths($months)
    {
        $allMonths = [];
        $byMonths = [];

        // First array to recover all months (format yyyymm)
        foreach ($months as $month)
        {
            array_push($allMonths, $month->Date);
        }

        // Removes duplicated months
        $uniqueMonths = array_unique($allMonths);

        // Second and final array containing as many arrays as months (one month = 1 empty array)
        // Keys are months (yyyymm)
        foreach ($uniqueMonths as $key => $value)
        {
            $byMonths[$value] = [];
        }

        // Dispatches all posts in correct empty array
        // If post's date == $key, add the post (object)
        foreach ($months as $data)
        {
            foreach ($byMonths as $key => $value)
            {
                if ($data->Date == $key)
                {
                    array_push($byMonths[$key], $data);
                }
            }
        }

        return $byMonths;
    }
}