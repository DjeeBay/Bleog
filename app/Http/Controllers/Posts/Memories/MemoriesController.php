<?php

namespace App\Http\Controllers\Posts\Memories;

use App\Posts\Memories;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MemoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getForm()
    {
        if (Gate::denies('restrict-access', Auth::user()))
        {
            abort(403);
        }

        setlocale(LC_TIME, 'fr', 'fr_FR.UTF-8');
        $memories = Memories::orderBy('event_date', 'desc')->simplePaginate(5);

        return view('forms.memories.memories')->with('memories', $memories);
    }

    public function postForm(Request $request)
    {
        $memory = new Memories();

        $memory->event_date = $request->event_date;
        $memory->description = $request->description;

        $memory->save();

        setlocale(LC_TIME, 'fr', 'fr_FR.UTF-8');
        $memory->formatted_event_date = $memory->event_date->formatLocalized('%A %d %B %Y');

        $memory->position = $this->getMemoryPosition($memory->id);


        return response()->json(['data' => $memory]);
    }

    private function getMemoryPosition($memoryID)
    {
        $memories = Memories::orderBy('event_date', 'desc')->simplePaginate(5);

        $position = -1;

        $nbRows = count($memories);
        for ($i = 0; $i < $nbRows; $i++) {
            if ($memoryID === $memories[$i]->id) {
                $position = $i;
            }
        }

        return $position;

    }
}
