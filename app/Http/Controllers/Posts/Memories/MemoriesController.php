<?php

namespace App\Http\Controllers\Posts\Memories;

use App\Posts\Memories;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MemoriesController extends Controller
{
    protected $nbToDisplay = 20;

    public function __construct()
    {
        setlocale(LC_TIME, 'fr', 'fr_FR.UTF-8');
        $this->middleware('auth');
    }

    public function getForm()
    {
        if (Gate::denies('restrict-access', Auth::user()))
        {
            abort(403);
        }

        setlocale(LC_TIME, 'fr', 'fr_FR.UTF-8');
        $memories = Memories::orderBy('event_date', 'desc')->simplePaginate($this->nbToDisplay);

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

        $memory->totalMemories = Memories::count();


        return response()->json(['data' => $memory]);
    }

    public function deleteMemory(Request $request)
    {
        $dataToReturn = array();
        $dataToReturn['position'] = $this->getMemoryPosition($request->json('id'));
        $dataToReturn['formatted_event_date'] = Carbon::createFromFormat('Y-m-d h:i:s', $request->json('event_date'))->formatLocalized('%A %d %B %Y');

        $memories = new Memories();
        $nbMemories = $memories->count();

        if ($nbMemories > $this->nbToDisplay) {
            $memoryToDisplay = $memories->orderBy('event_date', 'desc')->skip($this->nbToDisplay)->take(1)->first();
            $memoryToDisplay->position = $this->nbToDisplay -1;
            $memoryToDisplay->formatted_event_date = $memoryToDisplay->event_date->formatLocalized('%A %d %B %Y');

            $dataToReturn['memoryToDisplay'] = $memoryToDisplay;
            $dataToReturn['memoryToDisplay']['totalMemories'] = $nbMemories;
        }

        $memory = Memories::find($request->json('id'));
        $memory->delete();

        return response()->json(['data' => $dataToReturn]);
    }

    private function getMemoryPosition($memoryID)
    {
        $memories = Memories::orderBy('event_date', 'desc')->simplePaginate($this->nbToDisplay);

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
