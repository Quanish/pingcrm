<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function calendar()
    {

        
        return Inertia::render('Calendar/Index', [
            'event' => User::getTasks()
        	/*'event' => [$array, $array],
	        'task' => Task::first()->get(),*/
        ]);
    }
}
