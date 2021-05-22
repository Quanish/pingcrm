<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\Task;

class CalendarController extends Controller
{
    public function calendar()
    {
    	
    	$array = [
                    'title' => 'test',
                    'start' => '2021-05-10',
                    'end' => '2021-05-19',
                    'department' => 'BioChemistry',
                    'description' => 'Lecture'
                ];
        return Inertia::render('Calendar/Index', [
            'event' => Task::select('title', 'created_at as start', 'deadline as end', 'audition as department', 'description')->get(),
        	/*'event' => [$array, $array],
	        'task' => Task::first()->get(),*/
        ]);
    }
}
