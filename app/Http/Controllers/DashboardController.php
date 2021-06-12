<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;
use App\Models\Task;
use App\Models\Subtask;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $subtasks = Subtask::where('user_id', Auth::user()->id)->get();

        foreach($subtasks as $key => $subtask) {
            
            if($subtask->task_id != 0) {
                $subtask->task = $subtask->task()->first();
                if($subtask->task->status == Task::COMPLETED) $subtasks->forget($key);
            } else {
                $subtask->task = [
                    'id' => 0,
                    'title' => 'Свои дела',
                ];
            }
            
        }

        $events = Event::with('task')->where('user_id',Auth::user()->id)->where('seen', 0)->get();

        foreach($events as $event) {
            $event->user = User::card($event->user_id);
        }
        	
        
        return Inertia::render('Dashboard/Index', [
            'tasks' => User::getTasks(),
            'events' => $events, 
            'subtasks' => $subtasks->toArray(), 
        ]);
    }


    public function setEventSeen(Request $request)
    {   
        $event = Event::find($request->id);

        if($event) {
            $event->seen = 1;
            $event->save();
        }
    }

}
