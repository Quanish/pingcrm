<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Auth;
use App\Models\Task;

class SubtasksController extends Controller
{
    //
    public function store(Request $request)
    {
        $task = Task::find($request->task);
        
    	$subtask = Subtask::create([
            'task_id' => $request->task,
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'deadline' => $request->deadline,
            'status' => $request->substatus,
            'user_id' => $request->task == 0 ? Auth::user()->id : $task->user,
        ]);

    	return redirect('/tasks/' . $request->task);
    }
}
