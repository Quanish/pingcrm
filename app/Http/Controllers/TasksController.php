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
use DB;

class TasksController extends Controller
{
	public function index(Request $request){

        $tasks = Task::where('user_id', Auth::user()->id)->orderBy('deadline', 'desc')->paginate(10);

        foreach($tasks->items() as $task) {
            $task->user = User::card($task->user_id);
            $task->auditor = User::card($task->auditor_id);
        }
        
       
        return Inertia::render('Tasks/Index', [
            'filters' => StaticRequest::all('search', 'trashed'),
            'tasks' => $tasks
        ]);
       
	}

    public function accept(Task $task){
        if($task->status == 0) $status = 2;
        if($task->status == 2) $status = 3;
        if($task->status == 3) $status = 1;

        $task->update([
            'status' => $status,
        ]);

        return redirect('tasks/' . $task->id)->with('success', 'Задание принято.');
    }

    public function show(Task $task){
            
        if($task->user_id != Auth::user()->id) {
            if($task->auditor_id != Auth::user()->id) {
                return redirect('/')->with(['success' => 'not found']);
            }
        }
        

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
                'description' => $task->description,
                'user' => User::card($task->user_id),
                'auditor' =>User::card($task->auditor_id),
                'start' => $task->start,
                'type' => $task->type ? $task->type : 1,
                'deadline' => $task->deadline,
                'status' => $task->status,
                'urgent' => $task->urgent,
                'account_id' => 1,
            ],
            
            'comments' => $task->comments(),
            'subtasks' => $subtasks
        ]);
    }

    public function comment(Request $request){
        
        $comment = Comment::create([
            'model_id' => $request->id,
            'model_type' => 'task',
            'user_id' => Auth::user()->id,
            'text' => $request->text,
            'type' => Comment::TEXT
        ]);

        $comment->user = User::card($comment->user_id);

        return $comment;
        
    }

    public function create() {
        return [
            'users' =>  User::select(DB::raw("CONCAT(last_name, ' ', first_name)  AS label"), 'id as code')->where('account_id', 1)->get()
        ];
    }

    public function getUsers(){
        $data = User::get();
        return $response()->json($data);
    }

	public function store(Request $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'auditor_id' => Auth::user()->id,
            'start' => $request->start,
            'deadline' => $request->deadline,
            'type' => $request->type ? $request->type : Task::TYPE_TASK,
            'status' => Task::NOT_STARTED, 
            'urgent' => $request->urgent ? 1 : 0, 
            'account_id' => Auth::user()->account_id,
        ]);

        $event = new Event();
        $event->user_id = $request->user_id;
        $event->author_id = Auth::user()->id;
        $event->text = "Назначил вас ответственным по задаче : ". $request->title;
        $event->task_id = $task->id;
        $event->save();

        return $this->show($task);    
    }

    public function edit(Task $task){ 
        return Inertia::render('Tasks/Edit', [
            'task' => [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'user_id' => $task->user_id,
                'auditor_id' => $task->auditor_id,
                'start' => $task->start,
                'type' => $task->type ? $task->type : 1,
                'deadline' => $task->deadline,
            ],
            'current_user' => User::find($task->user_id),
            'users' => User::all(),
        ]);
    }

    public function update(Task $task)
    {
        $task->update(
            StaticRequest::validate([
                'user_id' => ['required', 'max:50'],
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
