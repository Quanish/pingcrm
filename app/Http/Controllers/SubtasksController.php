<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SubtasksController extends Controller
{
    //
    public function store(Request $request)
    {
    	$subtask = Subtask::create([
            'task_id' => $request->task,
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

    	return Inertia::render('/');
    }
}
