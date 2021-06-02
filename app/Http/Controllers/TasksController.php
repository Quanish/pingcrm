<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Event;
use App\Models\Comment;
use App\Models\Subtask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as StaticRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class TasksController extends Controller
{
	public function index(Request $request){
        if (Auth::user()->owner) {
            # code...
            return Inertia::render('Tasks/Index', [
                'filters' => StaticRequest::all('search', 'trashed'),
                'tasks' => Task::with('user','audition')->get(),
                'users' => Auth::user()->account
                    ->tasks()
                    ->orderBy('user')
                    ->get()
                    ->map
                    ->only('id', 'user','deadline','description'),
            ]);
        }else{
    		return Inertia::render('Tasks/Index', [
    			'filters' => StaticRequest::all('search', 'trashed'),
                'tasks' => Task::where('user',Auth::user()->id)->get(),
            ]);
        }
	}

    public function accept(Task $task){
        $task->update([
            'status' => Task::IN_PROGRESS,
        ]);

        return Redirect::route('dashboard')->with('success', 'Задание принято.');
    }

    public function show(Task $task){

        $subtasks = Subtask::where([
            'task_id' => $task->id
        ])->get();
        
        foreach($subtasks as $subtask) {
            $subtask->task = $task;
        }

        return Inertia::render('Tasks/Show',[
            'task' => [
                'id' => $task->id,
                'title' => $task->title,
                'responsible' => User::find($task->user),
                'auditor' => User::find($task->audition),
                'description' => $task->description,
                'deadline' => $task->deadline,
                'progress' => $task->progress,
                'date_created' => $task->date_created,
                'status' => $task->status,
            ],
            'audition' => User::select('first_name')->where('id',$task->audition)->get(),
            'user' => User::select('first_name')->where('id', $task->user)->get(),
            'messages' => Comment::where('task_id',$task->id)->get(),
            'subtasks' => $subtasks
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
        return [
            'users' => User::where('account_id', Auth::user()->account_id)->get()
        ];
    }

    public function getUsers(){
        $data = User::get();
        return $response()->json($data);
    }

	public function store(Request $request)
    {
        
        $task = Task::create([
            'user' => $request->user,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'title' => $request->title,
            'audition' => $request->audition,
            'progress' => 1,
            'type' => $request->type, 
            'status' => 'ожидание', 
            'account_id' => Auth::user()->account_id
        ]);

        $event = new Event();
        $event->user = $request->user;
        $event->description = "Назначил вас ответственным по задаче : ". $request->title;
        $event->responsible = Auth::user()->id;
        $event->save();

        return $this->show($task);    
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
            StaticRequest::validate([
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

    public function dela(){
        return Inertia::render('Tasks/Dela');
    }

}
