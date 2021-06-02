<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Subtask;

class DashboardController extends Controller
{
    public function index()
    {   

        $subtasks = Subtask::where('user_id', Auth::user()->id)->get();

        foreach($subtasks as $subtask) {
            
            
            if($subtask->task_id != 0) {
                $subtask->task = $subtask->task()->first();
            } else {
                $subtask->task = [
                    'id' => 0,
                    'title' => 'Свои дела',
                ];
            }
            
           
        }

        return Inertia::render('Dashboard/Index', [
            'tasks' => Auth::user()->account
                ->tasks()
                ->with('subtask')
                ->where('user',Auth::user()->id)
                ->orWhere('audition',Auth::user()->id)
                ->orderBy('user')
                ->get(),
            'events' => Event::with('user','task')->where('user',Auth::user()->id)->get(), 
            'subtasks' => $subtasks, 
        ]);
    }

}
