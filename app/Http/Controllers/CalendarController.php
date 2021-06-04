<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\Task;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function calendar()
    {
        $events = Task::select('title', 'created_at', 'created_at as end', 'auditor_id as department', 'description')->get();

        foreach($events as $event) {
            $event->start = $event->created_at->format('Y-m-d\TH:i:s');
        }
        
        return Inertia::render('Calendar/Index', [
            'event' => $events
        	/*'event' => [$array, $array],
	        'task' => Task::first()->get(),*/
        ]);
    }
}
