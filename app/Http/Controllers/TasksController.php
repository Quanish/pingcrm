<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Event;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class TasksController extends Controller
{
    //
	public function index(){
        if (Auth::user()->owner) {
            # code...
            return Inertia::render('Tasks/Index', [
                'filters' => Request::all('search', 'trashed'),
                'tasks' => Task::with('user','audition')->get(),
            ]);
        }else{
    		return Inertia::render('Tasks/Index', [
    			'filters' => Request::all('search', 'trashed'),
                'tasks' => Task::where('user',Auth::user()->id)->get(),
                'users' => User::pluck('first_name'),//['John','Percival','Lemuel'],
            ]);
        }
	}

    public function accept(Task $task){
        $task->update(
            Request::validate([
                'status' => ['required', 'max:50'],
            ])
        );

        return Redirect::route('dashboard')->with('success', 'Задание принято.');
    }

    public function show(Task $task){
        return Inertia::render('Tasks/Show',[
            'task' => [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'deadline' => $task->deadline,
                'progress' => $task->progress,
                'date_created' => $task->date_created,
                'status' => $task->status,
            ],
            'audition' => User::select('first_name')->where('id',$task->audition)->get(),
            'user' => User::select('first_name')->where('id',$task->user)->get(),
            'messages' => Comment::where('task_id',$task->id)->get(),
        ]);
    }
    public function message(String $message,$id){
        Comment::insert([
            'task_id' => $id,
            'user_id' => Auth::user()->id,
            'comment' => $message,
        ]);
        return Inertia::render('Tasks/Show',[
            'task' => [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'deadline' => $task->deadline,
                'progress' => $task->progress,
                'date_created' => $task->date_created,
                'status' => $task->status,
            ],
            'audition' => User::select('first_name')->where('id',$task->audition)->get(),
            'user' => User::select('first_name')->where('id',$task->user)->get(),
            'messages' => Comment::where('task_id',$task->id)->get(),
        ]);
        
    }

    public function create()
    {
        return Inertia::render('Tasks/Create', [
            'users' => Auth::user()->account
                ->tasks()
                ->orderBy('user')
                ->get()
                ->map
                ->only('id', 'user','deadline','description'),
            'select' => User::all(),
        ]);
    }

    public function getUsers(){
        $data = User::get();
        return $response()->json($data);
    }

	public function store()
    {
        Auth::user()->account->tasks()->create(
            Request::validate([
                'user' => ['required', 'max:50'],
                'deadline' => ['required', 'max:50'],
                'description' => ['nullable', 'max:500'],
                'title' => ['required', 'max:200'],
                'audition' => ['required','max:100'],
                'type' => ['required','max:100'],
            ])
        );
        
        $event = new Event();
        $event->user = Request::input('user');
        $event->description = "Назначил вас ответственным по задаче : ".Request::input('title');
        $event->responsible = Auth::user()->id;
        $event->save();
        return Redirect::route('tasks')->with('success', 'Task created.');
    }

    public function edit(Task $task){ 
        return Inertia::render('Tasks/Edit', [
            'task' => [
                'id' => $task->id,
                'user' => $task->user,
                'date_created' => $task->date_created,
                'deadline' => $task->deadline,
                'description' => $task->description,
                'deleted_at' => $task->deleted_at,
                'title' => $task->title,
                'audition' => $task->audition,
            ],
            'current_user' => User::find($task->user),
            'users' => User::all(),
        ]);
    }

    public function update(Task $task)
    {
        $task->update(
            Request::validate([
                'user' => ['required', 'max:50'],
                'deadline' => ['required', 'max:50'],
                'description' => ['required', 'max:50'],
            ])
        );

        return Redirect::back()->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return Redirect::back()->with('success', 'Task deleted.');
    }

    public function restore(Task $task)
    {
        $task->restore();

        return Redirect::back()->with('success', 'Task restored.');
    }

    public function calendar(){
        return Inertia::render('Tasks/Calendar');
    }

}
